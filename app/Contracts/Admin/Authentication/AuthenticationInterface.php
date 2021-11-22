<?php


namespace App\Contracts\Admin\Authentication;


use App\User;

interface AuthenticationInterface
{
  public function doRegis($user);
  public function doAuth($user);
  public function doLogout();
  public function forgetPassword($email);
  public function updatePassword($id, $password);
}