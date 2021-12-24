<?php


namespace App\Contracts\Admin\Contact;


interface ContactInterface
{

  public function getListContact();
  public function getContactById($id);
  public function getContactArea();
  public function getContactIsOnFooter();
  public function storeContact($contact);
  public function updateContact($id, $contact);
  public function deleteContact($id);

}