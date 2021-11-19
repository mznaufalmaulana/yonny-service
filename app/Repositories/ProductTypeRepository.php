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
    return ProductTypeModel::find($id, ['id', 'type_name']);
  }

  public function storeProductTypeRepo($type)
  {
    return ProductTypeModel::create([
              'type_name' => $type->type_name
            ]);
  }

  public function updateProductTypeRepo($id, $type)
  {
    return ProductTypeModel::where('id', $id)
            ->update([
              'type_name' => $type->type_name
            ]);
  }

  public function deleteProductTypeRepo($id)
  {
    return ProductTypeModel::destroy($id);
  }

  public function isTypeExist($id)
  {
    return ProductTypeModel::findOrFail($id);
  }
}