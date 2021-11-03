<?php

namespace App\Http\Controllers\Product;

use App\Contracts\Admin\Product\ProductInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{

  private $product;

  public function __construct
  (
    ProductInterface $product
  )
  {
    $this->product = $product;
  }

  public function getListProduct(): JsonResponse
  {
    try {
      $products = $this->product->getListProduct();
      return $this->returnSuccess($products, "ok");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function getProductById($id): JsonResponse
  {
    try {
      $products = $this->product->getProductById($id);
      return $this->returnSuccess($products, "ok");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function storeProduct(ProductRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $result = $this->product->storeProduct($request);
      return $this->returnSuccess($result , "ok");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function updateProduct($id, ProductRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $result = $this->product->updateProduct($id, $request);
      return $this->returnSuccess($result , "ok");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function deleteProduct($id): JsonResponse
  {
    try {
      $result = $this->product->deleteProduct($id);
      return $this->returnSuccess($result , "ok");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }
}
