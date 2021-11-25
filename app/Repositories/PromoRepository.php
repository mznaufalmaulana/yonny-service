<?php


namespace App\Repositories;


use App\Models\PromoModel;
use Illuminate\Support\Facades\DB;

class PromoRepository
{
  public function getListPromoRepo()
  {
    return DB::table('tbl_promo as tpm')
              ->where('tpm.is_headline', '=', 0)
              ->select('tpm.id','tpm.photo_name', 'tpm.link', 'tpm.order', 'tpm.is_headline')
              ->orderBy('order', 'ASC')
              ->get();
  }

  public function getListPromoHeadlineRepo()
  {
    return DB::table('tbl_promo as tpm')
      ->where('tpm.is_headline', '=', 1)
      ->select('tpm.id','tpm.photo_name', 'tpm.link', 'tpm.order', 'tpm.is_headline')
      ->orderBy('order', 'ASC')
      ->get();
  }

  public function getPromoByIdRepo($id)
  {
    return DB::table('tbl_promo as tpm')
      ->where('tpm.id', '=', $id)
      ->select('tpm.id','tpm.photo_name', 'tpm.link', 'tpm.order', 'tpm.is_headline')
      ->orderBy('order', 'ASC')
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