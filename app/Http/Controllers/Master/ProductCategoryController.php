<?php

namespace App\Http\Controllers\Master;

use App\Contracts\Admin\Master\ProductCategoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class ProductCategoryController extends Controller
{
  private $category;

  public function __construct
  (
    ProductCategoryInterface $category
  )
  {
    $this->category = $category;
  }

  public function getListCategory(): JsonResponse
  {
    try {
      $categories = $this->category->getListCategory();
      return $this->returnSuccess($categories, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail') ;
    }
  }

  public function getCategoryById($id): JsonResponse
  {
    try {
      $categories = $this->category->getCategoryById($id);
      return $this->returnSuccess($categories, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail') ;
    }
  }

  public function storeCategory(ProductCategoryRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $result = $this->category->storeCategory($request);
      return $this->returnSuccess($result , "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail') ;
    }
  }

  public function updateCategory($id, ProductCategoryRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $result = $this->category->updateCategory($id, $request);
      return $this->returnSuccess($result , "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail') ;
    }
  }

  public function deleteCategory($id): JsonResponse
  {
    try {
      $result = $this->category->deleteCategory($id);
      return $this->returnSuccess($result , "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail') ;
    }
  }
}
