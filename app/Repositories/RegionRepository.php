<?php


namespace App\Repositories;


use App\Models\RegionModel;

class RegionRepository
{
  public function getListRegionRepo()
  {
    return RegionModel::select('id', 'region')
            ->get();
  }

  public function getRegionByIdRepo($id)
  {
    return RegionModel::where('id',$id)
            ->select('id', 'region')
            ->get();
  }

  public function storeRegionRepo($region)
  {
    return RegionModel::create([
      'region' => $region->region,
    ]);
  }

  public function updateRegionRepo($id, $region)
  {
    return RegionModel::where('id', $id)
      ->update([
        'region' => $region->region,
      ]);
  }

  public function deleteRegionRepo($id)
  {
    return RegionModel::destroy($id);
  }

  public function isRegionExist($id)
  {
    return RegionModel::findOrFail($id);
  }
}