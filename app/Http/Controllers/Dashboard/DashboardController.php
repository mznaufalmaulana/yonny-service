<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Dashboard\DashboardInterface;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
  private $dashboard;
  public function __construct
  (
    DashboardInterface $dashboard
  )
  {
    $this->dashboard = $dashboard;
  }

  public function getSeenShareTotalCategory(): JsonResponse
  {
    try {
      $total = $this->dashboard->seenShareTotalCategory();
      return $this->returnSuccess($total, "success");
    }
    catch (Exception $ex)
    {
      $this->returnFail("", $ex->getMessage());
    }
  }

  public function getTopProductSeen(): JsonResponse
  {
    try {
      $productSeens = $this->dashboard->topProductSeen();
      return $this->returnSuccess($productSeens, "success");
    }
    catch (Exception $ex)
    {
      $this->returnFail("", $ex->getMessage());
    }
  }

  public function getTopProductShare(): JsonResponse
  {
    try {
      $productShares  = $this->dashboard->topProductShare();
      return $this->returnSuccess($productShares, "success");
    }
    catch (Exception $ex)
    {
      $this->returnFail("", $ex->getMessage());
    }
  }
}
