<?php


namespace App\Repositories;


use App\Http\Requests\ProductTypeRequest;
use App\Models\ProductTypeModel;

class ProductTypeRepository
{
  public function getListProductTypeRepo()
  {
    return ProductTypeModel::select('id', 'type_name')->get();
  }

  public function getProductTypeByIdRepo($id)
  {
    return ProductTypeModel::findOrFail($id, ['id', 'type_name']);
  }

  public function storeProductTypeRepo(ProductTypeRequest $request)
  {
    return ProductTypeModel::create($request->validationData());
  }

  public function updateProductTypeRepo($id, ProductTypeRequest $request)
  {
    return ProductTypeModel::where('id', $id)->update($request->validationData());
  }

  public function deleteProductTypeRepo($id)
  {
    return ProductTypeModel::destroy($id);
  }
}