<?php


namespace App\Contracts\Admin\Promo;


interface PromoInterface
{
  public function getListPromo();
  public function getListPromoHeadline();
  public function getPromoById($id);
  public function storePromo($promo);
  public function updatePromo($id, $promo);
  public function deletePromo($id);
}