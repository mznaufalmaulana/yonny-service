<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Master\ProductCategoryInterface;
use App\Http\Requests\ProductCategoryRequest;
use App\Repositories\ProductCategoryRepository;
use Exception;

class ProductCategoryService implements ProductCategoryInterface
{

  private $categoryRepository;

  public function __construct
  (
    ProductCategoryRepository $categoryRepository
  )
  {
    $this->categoryRepository = $categoryRepository;
  }

  public function getListCategory()
  {
    $category = $this->categoryRepository->getListCategoryRepo();
    return $category;
  }

  public function getCategoryById($id)
  {
    $category = $this->categoryRepository->getCategoryByIdRepo($id);
    return $category;
  }

  public function storeCategory(ProductCategoryRequest $request)
  {
    $result = $this->categoryRepository->storeCategoryRepo($request);
    return $result;
  }

  public function updateCategory($id, ProductCategoryRequest $request)
  {
    $result = $this->categoryRepository->updateCategoryRepo($id, $request);
    return $result;
  }

  public function deleteCategory($id)
  {
    $result = $this->categoryRepository->deleteCategoryRepo($id);
    return $result;
  }
}