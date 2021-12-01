<?php

namespace App\Http\Controllers\User;

use App\Contracts\Admin\User\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
  private $user;
  public function __construct
  (
    UserInterface $user
  )
  {
    $this->user = $user;
  }

  public function getListUser(): JsonResponse
  {
    try {
      $users = $this->user->getListUser();
      return $this->returnSuccess($users, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function getUserById($id): JsonResponse
  {
    try {
      $user = $this->user->getUserById($id);
      return $this->returnSuccess($user, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function storeUser(UserRequest $request): JsonResponse
  {
    try {
      $result = $this->user->storeUser($request);
      return $this->returnSuccess($result, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function updateUser($id, UserRequest $request): JsonResponse
  {
    try {
      $result = $this->user->updateUser($id, $request);
      return $this->returnSuccess($result, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function deleteUser($id): JsonResponse
  {
    try {
      $result = $this->user->deleteUser($id);
      return $this->returnSuccess($result, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }
}
