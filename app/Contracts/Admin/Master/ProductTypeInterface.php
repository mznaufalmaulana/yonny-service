<?php

namespace App\Contracts\Admin\Master;

interface ProductTypeInterface
{
  public function getListProductType();
  public function getProductTypeById($id);
  public function storeProductType($type);
  public function updateProductType($id, $type);
  public function deleteProductType($id);

}