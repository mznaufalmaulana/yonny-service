<?php


namespace App\Contracts\Admin\User;


interface UserInterface
{
  public function getListUser();
  public function getUserById($id);
  public function storeUser($user);
  public function updateUser($id, $user);
  public function deleteUser($id);
}