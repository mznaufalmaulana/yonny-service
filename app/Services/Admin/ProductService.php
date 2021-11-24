<?php


namespace App\Services\Admin;

use App\Contracts\Admin\Product\ProductInterface;
use App\Http\Requests\PhotoRequest;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
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
    try {
      $products = $this->productRepository->getListProductRepo();
      foreach ($products as $product)
      {
        $categories = $this->productCategoryRepository->getCategoryProductByProductId($product->id);
        $product->product_category = $categories;
      }
      return $products;
    }
    catch (\Exception $ex)
    {
      throw $ex;
    }
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
    try {
      $this->productRepository->isProductExist($id);
      $product = $this->productRepository->getProductByIdRepo($id);
      $photos = $this->productRepository->getProductPhotoByProductIdRepo($id);
      $categories = $this->productCategoryRepository->getCategoryProductByProductId($id);
      $product[0]->product_category = $categories;
      $product[0]->photo = $photos;
      return $product;
    }
    catch (\Exception $ex)
    {
      throw $ex;
    }
  }

  public function getListLatestProduct()
  {
    try {
      return $this->productRepository->getListLatestProductRepo();
    }
    catch (\Exception $ex)
    {
      throw $ex;
    }
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
    try {
      $this->productRepository->isProductExist($productId);
      return $this->productRepository->getProductPhotoByProductIdRepo($productId);
    }
    catch (\Exception $ex)
    {
      throw $ex;
    }
  }

  public function storeProductPhoto($productId, PhotoRequest $request)
  {
    try {
      $this->productRepository->isProductExist($productId);
      $photoName = time().'_'.$request->file('photo')->getClientOriginalName();
      $photoNameWithPath = 'public/product/'.$photoName;
      $this->productRepository->storeProductPhotoRepo($productId, $photoNameWithPath);
      $this->storeProductPhotoFile($request->file('photo'), $photoName);

      return true;
    }
    catch (\Exception $ex)
    {
      throw $ex;
    }
  }

  public function updateProductPhoto($id, PhotoRequest $request)
  {
    try {
      $photoPath = $this->productRepository->getProductPhotoByIdRepo($id);
      $photoName = time().'_'.$request->file('photo')->getClientOriginalName();
      $photoNameWithPath = 'public/product/'.$photoName;
      $this->deleteProductPhotoFile($photoPath[0]->photo_name);
      $this->productRepository->updateProductPhotoRepo($id, $photoNameWithPath);
      $this->storeProductPhotoFile($request->file('photo'), $photoName);

      return true;
    }
    catch (\Exception $ex)
    {
      throw $ex;
    }
  }

  public function deleteProductPhoto($id)
  {
    try {
      $photoPath = $this->productRepository->getProductPhotoByIdRepo($id);
      $this->deleteProductPhotoFile($photoPath[0]->photo_name);
      $this->productRepository->deleteProductPhotoByIdRepo($id);

      return true;
    }
    catch (\Exception $ex)
    {
      throw $ex;
    }
  }

  public function storeProductPhotoFile($photoFile, $photoName)
  {
    Storage::putFileAs('public/product', $photoFile, $photoName);
  }

  public function deleteProductPhotoFile($photoName)
  {
    Storage::disk('local')->delete($photoName);
  }
}