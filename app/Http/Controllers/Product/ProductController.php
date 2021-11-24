<?php

namespace App\Http\Controllers\Product;

use App\Contracts\Admin\Product\ProductInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoRequest;
use App\Http\Requests\ProductPagingRequest;
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
      return $this->returnSuccess($products, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function getListProductStore(ProductPagingRequest $request)
  {
    try {
      $products = $this->product->getListProductStore($request);
      return $this->returnSuccess($products, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function getListLatestProduct(): JsonResponse
  {
    try {
      $products = $this->product->getListLatestProduct();
      return $this->returnSuccess($products, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function getProductById($id): JsonResponse
  {
    try {
      $product = $this->product->getProductById($id);
      return $this->returnSuccess($product, "success");
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
      return $this->returnSuccess($result, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function incrementShareProduct($id): JsonResponse
  {
    try {
      $product = $this->product->incrementShareProduct($id);
      return $this->returnSuccess($product, "success");
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
      return $this->returnSuccess($result, "success");
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
      return $this->returnSuccess($result , "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function getListProductPhoto($productId): JsonResponse
  {
    try {
      $photos = $this->product->getListProductPhoto($productId);
      return $this->returnSuccess($photos, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function storeProductPhoto($productId, PhotoRequest $request): JsonResponse
  {
    try {
      $result = $this->product->storeProductPhoto($productId, $request);
      return $this->returnSuccess($result, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function updatePhotoProduct($photoId, PhotoRequest $request): JsonResponse
  {
    try {
      $result = $this->product->updateProductPhoto($photoId, $request);
      return $this->returnSuccess($result, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function deletePhotoProduct($photoId): JsonResponse
  {
    try {
      $result = $this->product->deleteProductPhoto($photoId);
      return $this->returnSuccess($result, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }
}
