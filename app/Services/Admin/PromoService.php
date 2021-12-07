<?php

namespace App\Services\Admin;

use App\Contracts\Admin\Promo\PromoInterface;
use App\Repositories\PromoRepository;
use DB;
use Exception;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class PromoService implements PromoInterface
{
  private $promoRepository;
  public function __construct
  (
    PromoRepository $promoRepository
  )
  {
    $this->promoRepository = $promoRepository;
  }

  public function getListPromoAll()
  {
    return $this->promoRepository->getListPromoAllRepo();
  }

  public function getListPromo()
  {
    return $this->promoRepository->getListPromoRepo();
  }

  public function getListPromoHeadline()
  {
    return $this->promoRepository->getListPromoHeadlineRepo();
  }

  public function getPromoById($id)
  {
    $this->promoRepository->isPromoExist($id);
    return $this->promoRepository->getPromoByIdRepo($id);
  }

  public function storePromo($promo)
  {
    if($promo->hasFile('photo_name') && $promo->file('photo_name')->isValid())
    {
      $photoName = time().'_'.$promo->file('photo_name')->getClientOriginalName();
      $photoNameWithPath = Config::get('constants_val.path_photo_promo').$photoName;
      $this->storePromoPhotoFile($promo->file('photo_name'), $photoName);
      $promo->photo_name = $photoNameWithPath;
      $this->promoRepository->storePromoRepo($promo);

      return true;
    }
    throw new Exception();
  }

  public function updatePromo($id, $promo)
  {
    DB::beginTransaction();
    try {
      $this->promoRepository->isPromoExist($id);
      $photoPath = $this->promoRepository->getPromoByIdRepo($id);
      if ($promo->hasFile('photo_name'))
      {
        $photoName = time().'_'.$promo->file('photo_name')->getClientOriginalName();
        $photoNameWithPath = Config::get('constants_val.path_photo_promo').$photoName;
        $this->deletePromoPhotoFile($photoPath[0]->photo_name);
        $this->storePromoPhotoFile($promo->file('photo_name'), $photoPath[0]->photo_name);
        $promo->photo_name = $photoNameWithPath;
      }
      else
      {
        $promo->photo_name =$photoPath[0]->photo_name;
      }

      $this->promoRepository->updatePromoRepo($id, $promo);

      DB::commit();
      return true;
    }
    catch (Exception $ex)
    {
      DB::rollBack();
      throw $ex;
    }
  }

  public function deletePromo($id)
  {
    $this->promoRepository->isPromoExist($id);
    $result = $this->promoRepository->getPromoByIdRepo($id);
    $this->deletePromoPhotoFile($result[0]->photo_name);
    $this->promoRepository->deletePromoRepo($id);

    return true;
  }

  public function storePromoPhotoFile($photoFile, $photoName)
  {
    Storage::putFileAs('public/'.Config::get('constants_val.path_photo_promo'), $photoFile, $photoName);
  }

  public function deletePromoPhotoFile($photoName)
  {
    Storage::disk(Config::get('constants_val.storage_location'))->delete('public/'.$photoName);
  }
}