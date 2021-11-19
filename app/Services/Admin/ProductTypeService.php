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
    try {
      $priductType = $this->productTypeRepository->getListProductTypeRepo();
      return $priductType;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function getProductTypeById($id)
  {
    try {
      $this->productTypeRepository->isTypeExist($id);
      return $this->productTypeRepository->getProductTypeByIdRepo($id);
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function storeProductType($request)
  {
    try {
      $this->productTypeRepository->storeProductTypeRepo($request);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function updateProductType($id, $request)
  {
    try {
      $this->productTypeRepository->isTypeExist($id);
      $this->productTypeRepository->updateProductTypeRepo($id, $request);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function deleteProductType($id)
  {
    try {
      $this->productTypeRepository->isTypeExist($id);
      $this->productTypeRepository->deleteProductTypeRepo($id);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

}