<?php


namespace App\Repositories;


use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategoryModel;
use Illuminate\Support\Facades\DB;

class ProductCategoryRepository
{

  public function getListCategoryParentRepo($parentId = 0)
  {
    return DB::table('ms_category as mc')
            ->where('mc.category_parent', $parentId)
            ->select('mc.id', 'mc.category_parent', 'mc.category_name')
            ->get();
  }

  public function getListCategoryRepo()
  {
    return DB::table('ms_category as mc')
            ->select('mc.id', 'mc.category_parent', 'mc.category_name')
            ->get();
  }

  public function getCategoryByIdRepo($id)
  {
    return DB::table('ms_category as mc')
            ->where('mc.id', $id)
            ->select('mc.id', 'mc.category_parent', 'mc.category_name')
            ->get();
  }

  public function getCategoryProductByProductId($id)
  {
    return DB::table('brg_product_category as bpc')
      ->join('ms_category as mc', 'mc.id', 'bpc.category_id')
      ->where('bpc.product_id', $id)
      ->select('mc.id', 'mc.category_name')
      ->get();
  }

  public function storeCategoryRepo($category)
  {
    return ProductCategoryModel::create([
              'category_parent' =>  $category->category_parent,
              'category_name' => $category->category_name,
            ]);
  }

  public function updateCategoryRepo($id, $category)
  {
    return ProductCategoryModel::where('id', $id)
            ->update([
              'category_parent' =>  $category->category_parent,
              'category_name' => $category->category_name,
            ]);
  }

  public function deleteCategoryRepo($id)
  {
    return ProductCategoryModel::destroy($id);
  }

  public function isCategoryExistRepo($id)
  {
    return ProductCategoryModel::findOrFail($id);
  }
}