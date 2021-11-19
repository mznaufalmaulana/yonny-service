<?php

namespace App\Http\Controllers\Master;

use App\Contracts\Admin\Master\ProductTypeInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductTypeRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductTypeController extends Controller
{

  private $productType;

  public function __construct
  (
    ProductTypeInterface $productType
  )
  {
    $this->productType = $productType;
  }

  public function getListProductType(): JsonResponse
  {
    try {
      $productTypes = $this->productType->getListProductType();
      return $this->returnSuccess($productTypes, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail') ;
    }
  }

  public function getProductTypeById($id): JsonResponse
  {
    try {
      $productTypes = $this->productType->getProductTypeById($id);
      return $this->returnSuccess($productTypes, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail') ;
    }
  }

  public function storeProductType(ProductTypeRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $result = $this->productType->storeProductType($request);
      return $this->returnSuccess($result , "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail') ;
    }
  }

  public function updateProductType($id, ProductTypeRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $result = $this->productType->updateProductType($id, $request);
      return $this->returnSuccess($result , "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail') ;
    }
  }

  public function deleteProductType($id): JsonResponse
  {
    try {
      $result = $this->productType->deleteProductType($id);
      return $this->returnSuccess($result , "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail') ;
    }
  }
}
