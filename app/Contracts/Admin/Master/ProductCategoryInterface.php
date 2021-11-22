<?php

namespace App\Contracts\Admin\Master;


interface ProductCategoryInterface
{
  public function getListCategoryParent();
  public function getListCategory();
  public function getCategoryById($id);
  public function storeCategory($category);
  public function updateCategory($id, $category);
  public function deleteCategory($id);
}