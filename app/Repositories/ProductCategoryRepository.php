<?php


namespace App\Repositories;


use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategoryModel;

class ProductCategoryRepository
{
  public function getListCategoryRepo()
  {
    return ProductCategoryModel::select('id', 'category_parent', 'category_name')->get();
  }

  public function getCategoryByIdRepo($id)
  {
    return ProductCategoryModel::findOrFail($id, ['id', 'category_parent', 'category_name']);
  }

  public function storeCategoryRepo(ProductCategoryRequest $request)
  {
    return ProductCategoryModel::create($request->validationData());
  }

  public function updateCategoryRepo($id, ProductCategoryRequest $request)
  {
    return ProductCategoryModel::where('id', $id)->update($request->validationData());
  }

  public function deleteCategoryRepo($id)
  {
    return ProductCategoryModel::destroy($id);
  }
}