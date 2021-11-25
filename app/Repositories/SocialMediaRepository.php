<?php


namespace App\Repositories;


use App\Models\SocialMediaModel;
use Illuminate\Support\Facades\DB;

class SocialMediaRepository
{
  public function getListSocialMediaRepo()
  {
    return DB::table('tbl_social_media as sm')
            ->select('sm.id', 'sm.icon', 'sm.link')
            ->get();
  }

  public function getSocialMediaByIdRepo($id)
  {
    return DB::table('tbl_social_media as sm')
            ->where('id', $id)
            ->select('sm.id', 'sm.icon', 'sm.link')
            ->get();
  }

  public function storeSocialMediaRepo($socialMedia)
  {
    return SocialMediaModel::create([
              'icon' => $socialMedia->icon,
              'link'  => $socialMedia->link,
            ]);
  }

  public function updateSocialMediaRepo($id, $socialMedia)
  {
    return SocialMediaModel::where('id', $id)
            ->update([
              'icon' => $socialMedia->icon,
              'link' => $socialMedia->link,
            ]);
  }

  public function deleteSocialMediaRepo($id)
  {
    return SocialMediaModel::destroy($id);
  }

  public function isSocialMediaExist($id)
  {
    return SocialMediaModel::findOrFail($id);
  }
}