<?php


namespace App\Services\Admin;

use App\Contracts\Admin\Product\ProductInterface;
use App\Http\Requests\PhotoRequest;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService implements ProductInterface
{

  private $productRepository;
  private $productCategoryRepository;

  public function __construct
  (
    ProductRepository $productRepository,
    ProductCategoryRepository $productCategoryRepository
  )
  {
    $this->productRepository = $productRepository;
    $this->productCategoryRepository = $productCategoryRepository;
  }

  public function getListProduct()
  {
    $products = $this->productRepository->getListProductRepo();
    foreach ($products as $product)
    {
      $categories = $this->productCategoryRepository->getCategoryProductByProductId($product->id);
      $product->product_category = $categories;
    }

    return $products;
  }

  public function getListProductStore($request)
  {
    $productQuery = $this->productRepository->getListProductStoreRepo();
    if ($request->category)
    {
      $productQuery = $this->productRepository->queryCategory($productQuery, $request->category);
    }
    if ($request->type)
    {
      $productQuery = $this->productRepository->queryType($productQuery, $request->type);
    }
    if ($request->sort && in_array($request->sort, ['asc','desc']))
    {
      $productQuery = $this->productRepository->querySort($productQuery, $request->sort);
    }
    $productQuery = $this->productRepository->queryPaging($productQuery);

    return $productQuery->appends($request->input())->toArray();
    //$productQuery->toArray()['current_page']
  }

  public function getProductById($id)
  {
    $this->productRepository->isProductExist($id);
    $product = $this->productRepository->getProductByIdRepo($id);
    $photos = $this->productRepository->getProductPhotoByProductIdRepo($id);
    $categories = $this->productCategoryRepository->getCategoryProductByProductId($id);
    $product[0]->product_category = $categories;
    $product[0]->photo = $photos;

    return $product;
  }

  public function getListLatestProduct()
  {
    return $this->productRepository->getListLatestProductRepo();
  }

  public function getListProductByCategoryId($id)
  {
    return $this->productRepository->getListProductByCategoryIdRepo($id);
  }

  public function storeProduct(ProductRequest $request)
  {
    DB::beginTransaction();
    try {
      $product = $this->productRepository->storeProductRepo($request);

      foreach ($request->product_category_id as $category)
      {
        $this->productRepository->storeCategoryOfProductRepo($category, $product->id);
      }

      foreach ($request->file('product_photo') as $file)
      {
        $photoName = time().'_'.$file->getClientOriginalName();
        $photoNameWithPath = 'public/product/'.$photoName;
        $this->productRepository->storeProductPhotoRepo($product->id, $photoNameWithPath);
        $this->storeProductPhotoFile($file, $photoName);
      }

      DB::commit();
      return true;
    }
    catch (\Exception $ex)
    {
      DB::rollBack();
      throw $ex;
    }
  }

  public function incrementShareProduct($id)
  {
    $product = $this->productRepository->isProductExist($id);
    $product->share_count +=1;
    $this->productRepository->updateProductRepo($id, $product);

    return true;
  }

  public function updateProduct($id, $request)
  {
    DB::beginTransaction();
    try {
      $this->productRepository->isProductExist($id);
      $this->productRepository->updateProductRepo($id, $request);
      $this->productRepository->deleteCategoryOfProductByProductRepo($id);
      foreach ($request->product_category_id as $category)
      {
        $this->productRepository->storeCategoryOfProductRepo($category, $id);
      }

      DB::commit();
      return true;
    }
    catch (\Exception $ex)
    {
      DB::rollBack();
      throw $ex;
    }
  }

  public function deleteProduct($id)
  {
    DB::beginTransaction();
    try {
      $this->productRepository->isProductExist($id);
      $this->productRepository->deleteProductRepo($id);
      $this->productRepository->deleteCategoryOfProductByProductRepo($id);

      $photos = $this->productRepository->getProductPhotoByProductIdRepo($id);
      foreach ($photos as $photo)
      {
        $this->deleteProductPhotoFile($photo->photo_name);
      }
      $this->productRepository->deleteProductPhotoByProductRepo($id);

      DB::commit();
      return true;
    }
    catch (\Exception $ex)
    {
      DB::rollBack();
      throw $ex;
    }
  }

  public function getListProductPhoto($productId)
  {
    $this->productRepository->isProductExist($productId);
    return $this->productRepository->getProductPhotoByProductIdRepo($productId);
  }

  public function storeProductPhoto($productId, $request)
  {
    $this->productRepository->isProductExist($productId);
    $photoName = time().'_'.$request->file('photo')->getClientOriginalName();
    $photoNameWithPath = Config::get('constants_val.path_photo_product').$photoName;
    $this->productRepository->storeProductPhotoRepo($productId, $photoNameWithPath);
    $this->storeProductPhotoFile($request->file('photo'), $photoName);

    return true;
  }

  public function updateProductPhoto($id, $request)
  {
    DB::beginTransaction();
    try {
      $photoPath = $this->productRepository->getProductPhotoByIdRepo($id);
      $photoName = time().'_'.$request->file('photo')->getClientOriginalName();
      $photoNameWithPath = Config::get('constants_val.path_photo_product').$photoName;
      $this->deleteProductPhotoFile($photoPath[0]->photo_name);
      $this->productRepository->updateProductPhotoRepo($id, $photoNameWithPath);
      $this->storeProductPhotoFile($request->file('photo'), $photoName);

      DB::commit();
      return true;
    }
    catch (\Exception $ex)
    {
      DB::rollBack();
      throw $ex;
    }
  }

  public function deleteProductPhoto($id)
  {
    $photoPath = $this->productRepository->getProductPhotoByIdRepo($id);
    $this->deleteProductPhotoFile($photoPath[0]->photo_name);
    $this->productRepository->deleteProductPhotoByIdRepo($id);

    return true;
  }

  public function storeProductPhotoFile($photoFile, $photoName)
  {
    Storage::putFileAs(Config::get('constants_val.path_photo_product'), $photoFile, $photoName);
  }

  public function deleteProductPhotoFile($photoName)
  {
    Storage::disk(Config::get('constants_val.storage_location'))->delete($photoName);
  }
}