<?php


namespace App\Repositories;


use App\Http\Requests\ProductTypeRequest;
use App\Models\ProductTypeModel;
use Illuminate\Support\Facades\DB;

class ProductTypeRepository
{
  public function getListProductTypeRepo()
  {
    return DB::table('ms_product_type as mpt')
            ->leftJoin('tbl_product as tp', 'mpt.id', '=', 'tp.product_type_id')
            ->select('mpt.id', 'mpt.type_name',
              DB::raw("(select count(*) from tbl_product tpi where mpt.id = tpi.product_type_id) as total_product")
            )->distinct()
            ->get();
  }

  public function getProductTypeByIdRepo($id)
  {
    return DB::table('ms_product_type as mpt')
            ->where('mpt.id', $id)
            ->select('mpt.id', 'mpt.type_name')
            ->get();
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