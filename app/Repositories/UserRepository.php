<?php


namespace App\Repositories;

use App\User;

class UserRepository
{
  public function getUserListRepo()
  {

  }

  public function getUserByIdRepo($id)
  {

  }

  public function storeUserRepo($user)
  {
    return User::create([
      'username'  => $user->username,
      'email' => $user->email,
      'password'  => \Hash::make($user->password),
    ]);
  }

  public function updateUserRepo($id, $user)
  {

  }

  public function deleteUserRepo($id)
  {

  }

  public function isUserExistRepo($id)
  {

  }
}