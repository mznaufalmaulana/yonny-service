<?php


namespace App\Contracts\Admin\SocialMedia;


interface SocialMediaInterface
{
  public function getListSocialMedia();
  public function getSocialMediaById($id);
  public function storeSocialMedia($socialMedia);
  public function updateSocialMedia($id, $socialMedia);
  public function deleteSocialMedia($id);
}