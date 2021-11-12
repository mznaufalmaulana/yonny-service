<?php


namespace App\Contracts\Admin\Region;


interface RegionInterface
{
  public function getListRegion();
  public function getRegionById($id);
  public function storeRegion($region);
  public function updateRegion($id, $region);
  public function deleteRegion($id);
}