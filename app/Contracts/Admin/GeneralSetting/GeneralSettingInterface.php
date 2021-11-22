<?php


namespace App\Contracts\Admin\GeneralSetting;


interface GeneralSettingInterface
{
  public function getListGenset();
  public function updateGenset($id, $genset);
}