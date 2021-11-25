<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Master\ProductTypeInterface;
use App\Http\Requests\ProductTypeRequest;
use App\Repositories\ProductTypeRepository;
use Exception;

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
    $this->productTypeRepository->isTypeExist($id);
    return $this->productTypeRepository->getProductTypeByIdRepo($id);
  }

  public function storeProductType($request)
  {
    $this->productTypeRepository->storeProductTypeRepo($request);

    return true;
  }

  public function updateProductType($id, $request)
  {
    $this->productTypeRepository->isTypeExist($id);
    $this->productTypeRepository->updateProductTypeRepo($id, $request);

    return true;
  }

  public function deleteProductType($id)
  {
    $this->productTypeRepository->isTypeExist($id);
    $this->productTypeRepository->deleteProductTypeRepo($id);

    return true;
  }

}