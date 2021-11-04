<?php


namespace App\Repositories;


use App\Http\Requests\ProductRequest;
use App\Models\CategorytoProductModel;
use App\Models\ProductModel;
use App\Models\ProductPhotoModel;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\True_;

class ProductRepository
{
  public function getListProductRepo()
  {
    return ProductModel::select(
      'id', 'product_type_id', 'product_name',
      'share_count', 'is_active'
    )->get();
  }

  public function getProductByIdRepo($id)
  {
    return ProductModel::findOrFail($id, [
      'id', 'category_id', 'product_type_id', 'product_photo_id',
      'product_name', 'share_count', 'is_active']);
  }

  public function storeProductRepo(ProductRequest $request)
  {
      $product = ProductModel::create([
        'product_type_id' =>  $request->product_type_id,
        'product_name' => $request->product_name,
        'description' => $request->description,
        'is_active' =>  $request->is_active,
        'share_count' =>  $request->share_count
      ]);
      return $product;
  }

  public function storeCategoryOfProduct($category_id, $product_id)
  {
    $result = CategorytoProductModel::create([
      'category_id' =>  $category_id,
      'product_id'  =>  $product_id,
    ]);
    return $result;
  }

  public function updateProductRepo($id, ProductRequest $request)
  {
    return ProductModel::where('id', $id)->update($request->validationData());
  }

  public function deleteProductRepo($id)
  {
    return ProductModel::destroy($id);
  }

  public function getProductPhotoByProductId($id)
  {
    return ProductPhotoModel::where('product_id', $id)->select(
      'id', 'product_name'
    )->get();
  }

  public function getProductPhotoById($id)
  {
    return ProductPhotoModel::where('id', $id)->select(
      'id', 'product_name'
    )->get();
  }

  public function storeProductPhoto($productId, $productPhotoName)
  {
    return ProductPhotoModel::create([
      'product_id'  =>  $productId,
      'photo_name'  =>  $productPhotoName
    ]);
  }

  public function updateProductPhoto($id)
  {

  }

  public function deleteProductPhoto($id)
  {

  }

}