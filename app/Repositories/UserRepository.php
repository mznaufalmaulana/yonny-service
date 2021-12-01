<?php


namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
  public function getUserListRepo()
  {
    return DB::table('users')
            ->select('id', 'username', 'email')
            ->get();
  }

  public function getUserByIdRepo($id)
  {
    return DB::table('users')
            ->where('id', $id)
            ->select('id', 'username', 'email')
            ->get();
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
    return User::where('id', $id)
            ->update([
              'email' => $user->email,
              'password'  => \Hash::make($user->password),
            ]);
  }

  public function deleteUserRepo($id)
  {
    return User::destroy($id);
  }

}