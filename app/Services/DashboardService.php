<?php


namespace App\Services;


use App\Contracts\Dashboard\DashboardInterface;
use App\Repositories\ProductCategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Cache;

class DashboardService implements DashboardInterface
{
  private $productRepository;
  private $productCategoryRepository;
  public function __construct
  (
    ProductRepository $productRepository,
    ProductCategoryRepository $productCategoryRepository
  )
  {
    $this->productRepository = $productRepository;
    $this->productCategoryRepository = $productCategoryRepository;
  }

  public function seenShareTotalCategory($parentId = 0)
  {
    $categories = $this->productCategoryRepository->getListCategoryParentRepo($parentId);
    $total = array();
    foreach ($categories as $category)
    {
      $childs = $this->productCategoryRepository->getListCategoryParentRepo($category->id);
      $totalSeen = 0;
      $totalShare = 0;
      foreach ($childs as $child)
      {
        $temp = $this->productRepository->getTotalSeenShareProductByCategoryIdRepo($child->id);
        $totalSeen += $temp[0]->total_seen;
        $totalShare += $temp[0]->total_share;
      }
      $result = $this->productRepository->getTotalSeenShareProductByCategoryIdRepo($category->id);
      $category->total_seen = $totalSeen+$result[0]->total_seen;
      $category->total_share = $totalShare+$result[0]->total_share;
      array_push($total, $category);
    }

    return $total;
  }

  public function topProductSeen()
  {
    $productQuery = $this->productRepository->getTopProductRepo();
    return $this->productRepository->queryTopSeenRepo($productQuery);
  }

  public function topProductShare()
  {
    $productQuery = $this->productRepository->getTopProductRepo();
    return $this->productRepository->queryTopShareRepo($productQuery);
  }
}