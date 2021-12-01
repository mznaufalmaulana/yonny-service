<?php


namespace App\Services\Admin;


use App\Contracts\Admin\User\UserInterface;
use App\Repositories\UserRepository;

class UserService implements UserInterface
{
  private $userRepository;
  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function getListUser()
  {
    return $this->userRepository->getUserListRepo();
  }

  public function getUserById($id)
  {
    return $this->userRepository->getUserByIdRepo($id);
  }

  public function storeUser($user)
  {
    $this->userRepository->storeUserRepo($user);
    return true;
  }

  public function updateUser($id, $user)
  {
    $this->userRepository->getUserByIdRepo($id);
    $this->userRepository->updateUserRepo($id, $user);
    return true;
  }

  public function deleteUser($id)
  {
    $this->userRepository->getUserByIdRepo($id);
    $this->userRepository->deleteUserRepo($id);
    return true;
  }
}