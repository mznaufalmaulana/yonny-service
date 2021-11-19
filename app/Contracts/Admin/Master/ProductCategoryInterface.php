<?php

namespace App\Contracts\Admin\Master;


interface ProductCategoryInterface
{
  public function getListCategory();
  public function getCategoryById($id);
  public function storeCategory($category);
  public function updateCategory($id, $category);
  public function deleteCategory($id);
}