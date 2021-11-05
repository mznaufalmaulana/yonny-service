<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Product\ProductInterface;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService implements ProductInterface
{

  private $productRepository;

  public function __construct
  (
    ProductRepository $productRepository
  )
  {
    $this->productRepository = $productRepository;
  }

  public function getListProduct()
  {
    $product = $this->productRepository->getListProductRepo();
    return $product;
  }

  public function getProductById($id)
  {
    try {
      $this->productRepository->isProductExist($id);
      return $this->productRepository->getProductByIdRepo($id);
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
      $this->productRepository->storeCategoryOfProductRepo($request->product_category_id, $product->id);

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

  public function updateProduct($id, ProductRequest $request)
  {
    DB::beginTransaction();
    try {
      $product = $this->productRepository->updateProductRepo($id, $request);
      $this->productRepository->storeCategoryOfProduct($request->product_category_id, $product->id);

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

  public function storeProductPhotoFile($photoFile, $photoName)
  {
    Storage::putFileAs('public/product', $photoFile, $photoName);
  }

  public function deleteProductPhotoFile($photoName)
  {
    Storage::disk('local')->delete($photoName);
  }

}