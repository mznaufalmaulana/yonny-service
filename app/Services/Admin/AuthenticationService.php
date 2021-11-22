<?php


namespace App\Services\Admin;



use App\Contracts\Admin\Authentication\AuthenticationInterface;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthenticationService implements AuthenticationInterface
{
  private $userRepository;
  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function doRegis($user)
  {
    return $this->userRepository->storeUserRepo($user);
;  }

  public function doAuth($user)
  {
    if (Auth::attempt($user->validationData()))
    {
      $user = Auth::user();
      $token = $user->createToken('token')->plainTextToken;
      $cookie = cookie('jwt', $token, 60*24*3);
      return ['user'=>$user,'token'=>$token, 'cookie'=>$cookie];
    }
    throw new \Exception('Invalid credentials');
  }

  public function doLogout()
  {
    Auth::user()->tokens()->delete();
    return Cookie::forget('jwt');

  }

  public function forgetPassword($email)
  {
    // TODO: Implement forgetPassword() method.
  }

  public function updatePassword($id, $password)
  {
    // TODO: Implement updatePassword() method.
  }
}