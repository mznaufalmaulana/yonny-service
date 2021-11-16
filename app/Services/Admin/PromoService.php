<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Promo\PromoInterface;
use App\Repositories\PromoRepository;
use DB;
use Exception;
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

  public function getListPromo()
  {
    try {
      return $this->promoRepository->getListPromoRepo();
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function getListPromoHeadline()
  {
    try {
      return $this->promoRepository->getListPromoHeadlineRepo();
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function getPromoById($id)
  {
    try {
      $this->promoRepository->isPromoExist($id);
      return $this->promoRepository->getPromoByIdRepo($id);
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function storePromo($promo)
  {
    try {
      if($promo->hasFile('photo_name') && $promo->file('photo_name')->isValid())
      {
        $photoName = time().'_'.$promo->file('photo_name')->getClientOriginalName();
        $photoNameWithPath = 'public/promo/'.$photoName;
        $this->storePromoPhotoFile($promo->file('photo_name'), $photoName);
        $promo->photo_name = $photoNameWithPath;
        $this->promoRepository->storePromoRepo($promo);
        return true;
      }
      throw new Exception();
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
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
        $photoNameWithPath = 'public/promo/'.$photoName;
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
    try {
      $this->promoRepository->isPromoExist($id);
      $result = $this->promoRepository->getPromoByIdRepo($id);
      $this->deletePromoPhotoFile($result[0]->photo_name);
      $this->promoRepository->deletePromoRepo($id);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function storePromoPhotoFile($photoFile, $photoName)
  {
    Storage::putFileAs('public/promo', $photoFile, $photoName);
  }

  public function deletePromoPhotoFile($photoName)
  {
    Storage::disk('local')->delete($photoName);
  }
}