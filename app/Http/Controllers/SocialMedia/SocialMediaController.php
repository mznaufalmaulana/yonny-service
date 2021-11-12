<?php

namespace App\Http\Controllers\SocialMedia;

use App\Contracts\Admin\SocialMedia\SocialMediaInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMediaRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class SocialMediaController extends Controller
{
  protected $socialMedia;

  public function __construct
  (
    SocialMediaInterface $socialMedia
  )
  {
    $this->socialMedia = $socialMedia;
  }

  public function getListSocialMedia(): JsonResponse
  {
    try {
      $socialMedias = $this->socialMedia->getListSocialMedia();
      return $this->returnSuccess($socialMedias, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function getSocialMediaById($id): JsonResponse
  {
    try {
      $socialMedia = $this->socialMedia->getSocialMediaById($id);
      return $this->returnSuccess($socialMedia, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function storeSocialMedia(SocialMediaRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $socialMedia = $this->socialMedia->storeSocialMedia($request);
      return $this->returnSuccess($socialMedia, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function updateSocialMedia($id, SocialMediaRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $socialMedia = $this->socialMedia->updateSocialMedia($id, $request);
      return $this->returnSuccess($socialMedia, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function deleteSocialMedia($id): JsonResponse
  {
    try {
      $socialMedia = $this->socialMedia->deleteSocialMedia($id);
      return $this->returnSuccess($socialMedia, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }
}
