<?php


namespace App\Repositories;


use App\Models\SocialMediaModel;

class SocialMediaRepository
{
  public function getListSocialMediaRepo()
  {
    return SocialMediaModel::select('id', 'icon', 'link')->get();
  }

  public function getSocialMediaByIdRepo($id)
  {
    return SocialMediaModel::where('id', $id)
            ->select('id', 'icon', 'link')
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
    return SocialMediaModel::where('id', $id)->update([
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