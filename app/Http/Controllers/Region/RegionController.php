<?php

namespace App\Http\Controllers\Region;

use App\Contracts\Admin\Region\RegionInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegionRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class RegionController extends Controller
{
  private $region;
  public function __construct
  (
    RegionInterface $region
  )
  {
    $this->region = $region;
  }

  public function getListRegion(): JsonResponse
  {
    try {
      $regions = $this->region->getListRegion();
      return $this->returnSuccess($regions, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function getRegionById($id): JsonResponse
  {
    try {
      $region = $this->region->getRegionById($id);
      return $this->returnSuccess($region, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function storeRegion(RegionRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $region = $this->region->storeRegion($request);
      return $this->returnSuccess($region, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function updateRegion($id, RegionRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $region = $this->region->updateRegion($id, $request);
      return $this->returnSuccess($region, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function deleteRegion($id): JsonResponse
  {
    try {
      $region = $this->region->deleteRegion($id);
      return $this->returnSuccess($region, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }
}
