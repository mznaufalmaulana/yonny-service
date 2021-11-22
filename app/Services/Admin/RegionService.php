<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Master\RegionInterface;
use App\Repositories\RegionRepository;
use Exception;

class RegionService implements RegionInterface
{
  private $regionRepository;
  public function __construct
  (
    RegionRepository $regionRepository
  )
  {
    $this->regionRepository = $regionRepository;
  }

  public function getListRegion()
  {
    try {
      return $this->regionRepository->getListRegionRepo();
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function getRegionById($id)
  {
    try {
      $this->regionRepository->isRegionExist($id);
      return $this->regionRepository->getRegionByIdRepo($id);
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function storeRegion($region)
  {
    try {
      $this->regionRepository->storeRegionRepo($region);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function updateRegion($id, $region)
  {
    try {
      $this->regionRepository->isRegionExist($id);
      $this->regionRepository->updateRegionRepo($id, $region);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function deleteRegion($id)
  {
    try {
      $this->regionRepository->isRegionExist($id);
      $this->regionRepository->deleteRegionRepo($id);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }
}