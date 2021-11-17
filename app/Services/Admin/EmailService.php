<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Email\EmailInterface;
use App\Mail\BroadcastMail;
use App\Mail\SubscribeMail;
use App\Repositories\EmailRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Header\MailboxListHeader;

class EmailService implements EmailInterface
{
  private $emailRepository;
  public function __construct
  (
    EmailRepository $emailRepository
  )
  {
    $this->emailRepository = $emailRepository;
  }

  public function getListEmail()
  {
    return $this->emailRepository->getListEmailRepo();
  }

  public function getEmailById($id)
  {
    try {
      $this->emailRepository->isEmailExist($id);
      return $this->emailRepository->getEmailByIdRepo($id);
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function storeEmail($email)
  {
    try {
      $email->is_subscribe = Config::get('constants_val.subscribe_false');
      $this->emailRepository->storeEmailRepo($email);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function updateEmail($id, $email)
  {
    try {
      $this->emailRepository->isEmailExist($id);
      $this->emailRepository->updateEmailRepo($id, $email);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function deleteEmail($id)
  {
    try {
      $this->emailRepository->isEmailExistRepo($id);
      $this->emailRepository->deleteEmailRepo($id);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function subscribeEmail($email)
  {
    try {
      $email->is_subscribe = Config::get('constants_val.subscribe_true');
      $this->emailRepository->storeEmailRepo($email);
      $content = new \stdClass();
      $content->title = "Hello From Batu Yonny";
      $content->body = "You are will be recieve news update from us";
      $content->link = "link";
      $content->footer = "Thanks";

      Mail::to($email->email_address)->send(new SubscribeMail($content));
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function broadcastEmail($broadcast)
  {
    try {
      $emails = $this->emailRepository->getEmailByListIdRepo($broadcast->email_id_list);
      foreach ($emails as $email)
      {
        $content = new \stdClass();
        $content->title = "Hello From Batu Yonny";
        $content->body = "New collection special for you order now !!!";
        $content->link = "link";
        $content->footer = "Thanks";
        Mail::to($email->email_address)->send(new BroadcastMail($content));
      }
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function getEmailMessage()
  {
    // TODO: Implement getEmailMessage() method.
  }

  public function receveEmailMessage($email)
  {
    DB::beginTransaction();
    try {
      $result = $this->emailRepository->isEmailAddressExistRepo($email->email_address);
      if($result)
      {
        $email->email_id = $result[0]->id;
        $this->emailRepository->storeEmailRepo($email);
      }
      else
      {
        $email->is_subscribe = Config::get('constants_val.subscribe_false');
        $result = $this->storeEmail($email);
        $this->emailRepository->storeEmailRepo($email);
      }

      DB::commit();
      return true;
    }
    catch (Exception $ex)
    {
      DB::rollBack();
      throw $ex;
    }
  }

  public function sendEmailMessage($email)
  {
    // TODO: Implement sendEmailMessage() method.
  }
}