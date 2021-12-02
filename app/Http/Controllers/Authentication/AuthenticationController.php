<?php

namespace App\Http\Controllers\Authentication;

use App\Contracts\Admin\Authentication\authenticationInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use Exception;


class AuthenticationController extends Controller
{
  private $authentication;
  public function __construct(authenticationInterface $authentication)
  {
    $this->authentication = $authentication;
  }

  public function doRegister(RegisterRequest $request): JsonResponse
  {
    try {
      $result = $this->authentication->doRegis($request);
      return $this->returnSuccess($result, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage());
    }
  }

  public function doAuth(LoginRequest $request): JsonResponse
  {
    try {
      $result = $this->authentication->doAuth($request);
      return response()->json([
        'message' => 'success',
        'data' =>  $result['user'],
        'token'  =>  $result['token'],
      ])->withCookie($result['cookie']);
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage());
    }
  }

  public function doLogout(): JsonResponse
  {
    try {
      $result =  $this->authentication->doLogout();
      return $this->returnSuccess($result, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage());
    }
  }

  public function forgetPassword()
  {

  }
}
