<?php


namespace App\Contracts\Admin\Product;


use App\Http\Requests\ProductRequest;

interface ProductInterface
{
  public function getListProduct();
  public function getProductById($id);
  public function storeProduct(ProductRequest $request);
  public function updateProduct($id, ProductRequest $request);
  public function deleteProduct($id);
  public function storeProductPhoto($photoFile, $photoName);
}