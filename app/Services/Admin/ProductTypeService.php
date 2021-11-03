<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Master\ProductTypeInterface;
use App\Http\Requests\ProductTypeRequest;
use App\Repositories\ProductTypeRepository;

class ProductTypeService implements ProductTypeInterface
{

  private $productTypeRepository;

  public function __construct
  (
      ProductTypeRepository $productTypeRepository
  )
  {
      $this->productTypeRepository = $productTypeRepository;
  }

  public function getListProductType()
  {
    $priductType = $this->productTypeRepository->getListProductTypeRepo();
    return $priductType;
  }

  public function getProductTypeById($id)
  {
    $priductType = $this->productTypeRepository->getProductTypeByIdRepo($id);
    return $priductType;
  }

  public function storeProductType(ProductTypeRequest $request)
  {
    $result = $this->productTypeRepository->storeProductTypeRepo($request);
    return $result;
  }

  public function updateProductType($id, ProductTypeRequest $request)
  {
    $result = $this->productTypeRepository->updateProductTypeRepo($id, $request);
    return $result;
  }

  public function deleteProductType($id)
  {
    $result = $this->productTypeRepository->deleteProductTypeRepo($id);
    return $result;
  }

}