<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Master\ProductTypeInterface;
use App\Http\Requests\ProductTypeRequest;
use App\Repositories\ProductTypeRepository;
use function PHPUnit\Framework\throwException;

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
    if($priductType){
      return $priductType;
    }
    throw new \Exception('Data not found');
  }

  public function getProductTypeById($id)
  {
    $priductType = $this->productTypeRepository->getProductTypeByIdRepo($id);
    if($priductType){
      return $priductType;
    }
    throw new \Exception('Data not found');
  }

  public function storeProductType(ProductTypeRequest $request)
  {
    if ($request->validated()){
      $result = $this->productTypeRepository->storeProductTypeRepo($request);
      return $result;
    }
    throw new \Exception('Failed Store');
  }

  public function updateProductType($id, ProductTypeRequest $request)
  {
    if ($request->validated() && $id){
      $result = $this->productTypeRepository->updateProductTypeRepo($id, $request);
      return $result;
    }
    throw new \Exception('Failed update');

  }

  public function deleteProductType($id)
  {
    if($id){
      $result = $this->productTypeRepository->deleteProductTypeRepo($id);
      return $result;
    }
    throw new \Exception('Failed delete');
  }

}