<?php


namespace App\Repositories;


use App\Models\PromoModel;

class PromoRepository
{
  public function getListPromoRepo()
  {
    return PromoModel::select('photo_name', 'link', 'order', 'is_headline')
            ->where('is_headline', 0)
            ->orderBy('order', 'ASC')
            ->get();
  }

  public function getListPromoHeadlineRepo()
  {
    return PromoModel::select('photo_name', 'link', 'order', 'is_headline')
      ->where('is_headline', 1)
      ->orderBy('order', 'ASC')
      ->get();
  }

  public function getPromoByIdRepo($id)
  {
    return PromoModel::where('id', $id)
            ->select('photo_name', 'link', 'order', 'is_headline')
            ->get();
  }

  public function storePromoRepo($promo)
  {
    return PromoModel::create([
      'photo_name'  =>  $promo->photo_name,
      'link'  =>  $promo->link,
      'order' =>  $promo->order,
      'is_headline' =>  $promo->is_headline
    ]);
  }

  public function updatePromoRepo($id, $promo)
  {
    return PromoModel::where('id', $id)->update([
      'photo_name'  =>  $promo->photo_name,
      'link'  =>  $promo->link,
      'order' =>  $promo->order,
      'is_headline' =>  $promo->is_headline
    ]);
  }

  public function deletePromoRepo($id)
  {
    return PromoModel::destroy($id);
  }

  public function isPromoExist($id)
  {
    return PromoModel::findOrFail($id);
  }
}