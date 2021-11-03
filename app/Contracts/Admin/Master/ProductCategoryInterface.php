<?php

namespace App\Contracts\Admin\Master;

use App\Http\Requests\ProductCategoryRequest;

interface ProductCategoryInterface
{
  public function getListCategory();
  public function getCategoryById($id);
  public function storeCategory(ProductCategoryRequest $request);
  public function updateCategory($id, ProductCategoryRequest $request);
  public function deleteCategory($id);
}