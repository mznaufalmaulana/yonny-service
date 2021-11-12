<?php


namespace App\Services\Admin;


use App\Contracts\Admin\SocialMedia\SocialMediaInterface;
use App\Repositories\SocialMediaRepository;
use Exception;

class SocialMediaService implements SocialMediaInterface
{
  private $socialMediaRepository;
  public function __construct
  (
    SocialMediaRepository $socialMediaRepository
  )
  {
    $this->socialMediaRepository = $socialMediaRepository;
  }

  public function getListSocialMedia()
  {
    return $this->socialMediaRepository->getListSocialMediaRepo();
  }

  public function getSocialMediaById($id)
  {
    try {
      $this->socialMediaRepository->isSocialMediaExist($id);
      return $this->socialMediaRepository->getSocialMediaByIdRepo($id);
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function storeSocialMedia($socialMedia)
  {
    try {
      $this->socialMediaRepository->storeSocialMediaRepo($socialMedia);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function updateSocialMedia($id, $socialMedia)
  {
    try {
      $this->socialMediaRepository->isSocialMediaExist($id);
      $this->socialMediaRepository->updateSocialMediaRepo($id, $socialMedia);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function deleteSocialMedia($id)
  {
    try {
      $this->socialMediaRepository->isSocialMediaExist($id);
      $this->socialMediaRepository->deleteSocialMediaRepo($id);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }
}