<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Product\ProductInterface;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;

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
    $product = $this->productRepository->storeProductRepo($request);
    return $product;
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
}