<?php

namespace App\Http\Controllers\Promo;

use App\Contracts\Admin\Promo\PromoInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PromoRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class PromoController extends Controller
{
  private $promo;
  public function __construct
  (
    PromoInterface $promo
  )
  {
    $this->promo = $promo;
  }

  public function getListPromoAll(): JsonResponse
  {
    try {
      $promos = $this->promo->getListPromoAll();
      return $this->returnSuccess($promos, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function getListPromo(): JsonResponse
  {
    try {
      $promos = $this->promo->getListPromo();
      return $this->returnSuccess($promos, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function getListPromoHeadline(): JsonResponse
  {
    try {
      $promos = $this->promo->getListPromoHeadline();
      return $this->returnSuccess($promos, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

    public function getPromoById($id): JsonResponse
    {
      try {
        $promos = $this->promo->getPromoById($id);
        return $this->returnSuccess($promos, 'success');
      }
      catch (Exception $ex)
      {
        return $this->returnFail($ex->getMessage(), 'fail');
      }
    }

    public function storePromo(PromoRequest $request): JsonResponse
    {
      try {
        $result = $this->promo->storePromo($request);
        return $this->returnSuccess($result, 'success');
      }
      catch (Exception $ex)
      {
        return $this->returnFail($ex->getMessage(), 'fail');
      }
    }

    public function updatePromo($id, PromoRequest $request): JsonResponse
    {
      try {
        $request->validated();
        $result = $this->promo->updatePromo($id, $request);
        return $this->returnSuccess($result, 'success');
      }
      catch (Exception $ex)
      {
        return $this->returnFail($ex->getMessage(), 'fail');
      }
    }

    public function deletePromo($id): JsonResponse
    {
      try {
        $result = $this->promo->deletePromo($id);
        return $this->returnSuccess($result, 'success');
      }
      catch (Exception $ex)
      {
        return $this->returnFail($ex->getMessage(), 'fail');
      }
    }

}
