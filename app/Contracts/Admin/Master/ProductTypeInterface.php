<?php

namespace App\Contracts\Admin\Master;

use App\Http\Requests\ProductTypeRequest;

interface ProductTypeInterface
{
  public function getListProductType();
  public function getProductTypeById($id);
  public function storeProductType(ProductTypeRequest $request);
  public function updateProductType($id, ProductTypeRequest $request);
  public function deleteProductType($id);

}