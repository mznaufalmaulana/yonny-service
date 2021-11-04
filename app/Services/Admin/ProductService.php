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
    $product = $this->productRepository->getProductByIdRepo($id);
    return $product;
  }

  public function storeProduct(ProductRequest $request)
  {
    DB::beginTransaction();
    try {
      $product = $this->productRepository->storeProductRepo($request);
      $this->productRepository->storeCategoryOfProduct($request->product_category_id, $product->id);

      $photoName = time().'_'.$request->file('product_photo')->getClientOriginalName();
      $this->productRepository->storeProductPhoto($product->id, $photoName);

      $this->storeProductPhoto($request->file('product_photo'), $photoName);
      DB::commit();
      return $product;
    }
    catch (\Exception $ex)
    {
      DB::rollBack();
      throw $ex;
    }
  }

  public function updateProduct($id, ProductRequest $request)
  {
    $product = $this->productRepository->updateProductRepo($id, $request);
    return $product;
  }

  public function deleteProduct($id)
  {
    $product = $this->productRepository->deleteProductRepo($id);
    return $product;
  }

  public function storeProductPhoto($photoFile, $photoName)
  {
    Storage::putFileAs('public/product', $photoFile, $photoName);
  }
}