<?php


namespace App\Repositories;


use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategoryModel;

class ProductCategoryRepository
{

  public function getListCategoryParentRepo($parentId = 0)
  {
    return ProductCategoryModel::where('category_parent', $parentId)->select('id', 'category_parent', 'category_name')->get();
  }

  public function getListCategoryRepo()
  {
    return ProductCategoryModel::select('id', 'category_parent', 'category_name')->get();
  }

  public function getCategoryByIdRepo($id)
  {
    return ProductCategoryModel::find($id, ['id', 'category_parent', 'category_name']);
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