<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Contact\ContactInterface;
use App\Repositories\ContactRepository;
use Exception;

class ContactService implements ContactInterface
{
  private $contactRepository;
  public function __construct
  (
    ContactRepository $contactRepository
  )
  {
    $this->contactRepository = $contactRepository;
  }

  public function getListContact()
  {
    return $this->contactRepository->getListContactRepo();
  }

  public function getContactById($id)
  {
    try {
      $this->contactRepository->isContactExist($id);
      return $this->contactRepository->getContactByIdRepo($id);
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function storeContact($contact)
  {
    try {
      $this->contactRepository->storeContactRepo($contact);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function updateContact($id, $contact)
  {
    try {
      $this->contactRepository->isContactExist($id);
      $this->contactRepository->updateContactRepo($id, $contact);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function deleteContact($id)
  {
    try {
      $this->contactRepository->isContactExist($id);
      $this->contactRepository->deleteContactRepo($id);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }
}