<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Master\ProductCategoryInterface;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\CategorytoProductModel;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use Exception;

class ProductCategoryService implements ProductCategoryInterface
{

  private $categoryRepository;
  private $productRepository;
  public function __construct
  (
    ProductCategoryRepository $categoryRepository,
    ProductRepository $productRepository
  )
  {
    $this->categoryRepository = $categoryRepository;
    $this->productRepository = $productRepository;
  }

  public function getListCategory()
  {
    $category = $this->categoryRepository->getListCategoryRepo();
    return $category;
  }

  public function getListCategoryParent($parentId = 0)
  {
    $categories = $this->categoryRepository->getListCategoryParentRepo($parentId);
    $menu = array();
    foreach ($categories as $category)
    {
      $childs = $this->categoryRepository->getListCategoryParentRepo($category->id);
      $total = 0;
      foreach ($childs as $child)
      {
        $temp = $this->productRepository->getListProductByCategoryIdRepo($child->id);
        $total += count($temp);
      }
      $result = $this->productRepository->getListProductByCategoryIdRepo($category->id);
      $category->tatal_product = $total+count($result);
      array_push($menu, $category);
    }

    return $menu;
  }

  public function getListMenuProductCategory($parentId = 0)
  {
    $categories = $this->categoryRepository->getListCategoryParentRepo($parentId);
    $menu = array();
    foreach ($categories as $category)
    {
      if($result = $this->getListMenuProductCategory($category->id))
      {
        $category->child = $result;
      }
      array_push($menu, $category);
    }

    return $menu;
  }

  public function getCategoryById($id)
  {
    $this->categoryRepository->isCategoryExistRepo($id);
    $category = $this->categoryRepository->getCategoryByIdRepo($id);

    return $category;
  }

  public function storeCategory($category)
  {
    $this->categoryRepository->storeCategoryRepo($category);

    return true;
  }

  public function updateCategory($id, $category)
  {
    $this->categoryRepository->isCategoryExistRepo($id);
    $this->categoryRepository->updateCategoryRepo($id, $category);

    return true;
  }

  public function deleteCategory($id)
  {
    $this->categoryRepository->isCategoryExistRepo($id);
    $this->categoryRepository->deleteCategoryRepo($id);

    return true;
  }
}