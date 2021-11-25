<?php


namespace App\Repositories;


use App\Models\RegionModel;
use Illuminate\Support\Facades\DB;

class RegionRepository
{
  public function getListRegionRepo()
  {
    return DB::table('ms_region as mr')
            ->select('mr.id', 'mr.region')
            ->get();
  }

  public function getRegionByIdRepo($id)
  {
    return DB::table('ms_region as mr')
            ->where('id', $id)
            ->select('mr.id', 'mr.region')
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