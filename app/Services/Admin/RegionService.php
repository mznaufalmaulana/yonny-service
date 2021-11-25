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
    return $this->regionRepository->getListRegionRepo();
  }

  public function getRegionById($id)
  {
    $this->regionRepository->isRegionExist($id);
    return $this->regionRepository->getRegionByIdRepo($id);
  }

  public function storeRegion($region)
  {
    $this->regionRepository->storeRegionRepo($region);
    return true;
  }

  public function updateRegion($id, $region)
  {
    $this->regionRepository->isRegionExist($id);
    $this->regionRepository->updateRegionRepo($id, $region);
    return true;
  }

  public function deleteRegion($id)
  {
    $this->regionRepository->isRegionExist($id);
    $this->regionRepository->deleteRegionRepo($id);
    return true;
  }
}