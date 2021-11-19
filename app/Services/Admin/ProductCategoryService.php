<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Master\ProductCategoryInterface;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\CategorytoProductModel;
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
    try {
      $category = $this->categoryRepository->getListCategoryRepo();
      return $category;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function getCategoryById($id)
  {
    try {
      $category = $this->categoryRepository->getCategoryByIdRepo($id);
      return $category;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }

  }

  public function storeCategory($category)
  {
    try {
      $this->categoryRepository->storeCategoryRepo($category);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function updateCategory($id, $category)
  {
    try {
      $this->categoryRepository->isCategoryExistRepo($id);
      $this->categoryRepository->updateCategoryRepo($id, $category);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function deleteCategory($id)
  {
    try {
      $this->categoryRepository->deleteCategoryRepo($id);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }
}