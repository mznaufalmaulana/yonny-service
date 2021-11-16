<?php


namespace App\Contracts\Admin\Email;

interface EmailInterface
{
    public function getListEmail();
    public function getEmailById($id);
    public function storeEmail($email);
    public function subscribeEmail($email);
    public function updateEmail($id, $email);
    public function deleteEmail($id);
    public function broadcastEmail($broadcast);
}