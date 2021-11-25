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
    $this->socialMediaRepository->isSocialMediaExist($id);
    return $this->socialMediaRepository->getSocialMediaByIdRepo($id);
  }

  public function storeSocialMedia($socialMedia)
  {
    $this->socialMediaRepository->storeSocialMediaRepo($socialMedia);
    return true;
  }

  public function updateSocialMedia($id, $socialMedia)
  {
    $this->socialMediaRepository->isSocialMediaExist($id);
    $this->socialMediaRepository->updateSocialMediaRepo($id, $socialMedia);

    return true;
  }

  public function deleteSocialMedia($id)
  {
    $this->socialMediaRepository->isSocialMediaExist($id);
    $this->socialMediaRepository->deleteSocialMediaRepo($id);

    return true;
  }
}