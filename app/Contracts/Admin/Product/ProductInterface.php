<?php


namespace App\Contracts\Admin\Product;


use App\Http\Requests\PhotoRequest;
use App\Http\Requests\ProductRequest;

interface ProductInterface
{
  public function getListProduct();
  public function getListProductStore($request);
  public function getListLatestProduct();
  public function getListProductByCategoryId($id);
  public function getProductById($id);
  public function storeProduct(ProductRequest $request);
  public function incrementShareProduct($id);
  public function updateProduct($id, $request);
  public function deleteProduct($id);

  public function getListProductPhoto($productId);
  public function storeProductPhoto($productId, $request);
  public function updateProductPhoto($id, $request);
  public function deleteProductPhoto($id);

  public function storeProductPhotoFile($photoFile, $photoName);
  public function deleteProductPhotoFile($photoName);
}