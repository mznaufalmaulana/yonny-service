<?php


namespace App\Repositories;


use App\Http\Requests\ProductRequest;
use App\Models\ProductModel;

class ProductRepository
{
  public function getListProductRepo()
  {
    return ProductModel::select(
      'id', 'category_id', 'product_type_id', 'product_photo_id',
      'product_name', 'share_count', 'is_active'
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
    return ProductModel::create($request->validationData());
  }

  public function updateProductRepo($id, ProductRequest $request)
  {
    return ProductModel::where('id', $id)->update($request->validationData());
  }

  public function deleteProductRepo($id)
  {
    return ProductModel::destroy($id);
  }
}