<?php


namespace App\Contracts\Admin\Email;

interface EmailInterface
{
    public function getListEmail();
    public function getEmailById($id);
    public function getSubscriber();
    public function storeEmail($email);
    public function subscribeEmail($email);
    public function updateEmail($id, $email);
    public function deleteEmail($id);
    public function broadcastEmail($broadcast);
    public function getEmailMessage();
    public function getEmailMessageById($id);
    public function receveEmailMessage($email);
    public function sendEmailMessage($email);
    public function deleteEmailMessage($id);
}