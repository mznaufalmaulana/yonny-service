<?php

namespace App\Services\Admin;

use App\Contracts\Admin\Email\EmailInterface;
use App\Jobs\BroadcastMailJob;
use App\Jobs\SubscribeMailJob;
use App\Mail\BroadcastMail;
use App\Mail\SendMail;
use App\Mail\SubscribeMail;
use App\Repositories\EmailRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

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
      $this->emailRepository->isEmailExistRepo($id);
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
      $this->emailRepository->isEmailExistRepo($id);
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

      SubscribeMailJob::dispatch($email->email_address,$content)->onQueue('subscribe');

      return true;
    }
    catch (Exception $ex)
    {
      throw new Exception("You have subcribed");
    }
  }

  public function broadcastEmail($broadcast)
  {
    try {
      $emails = $this->emailRepository->getEmailByListIdRepo($broadcast->email_id_list);
      $timeCount = 0;
      foreach ($emails as $email)
      {
        $content = new \stdClass();
        $content->title = "Hello From Batu Yonny";
        $content->body = "New collection special for you order now !!!";
        $content->link = "link";
        $content->footer = "Thanks";

        $delaySeconds = $timeCount*5;
        $timeCount++;
        BroadcastMailJob::dispatch($email->email_address,$content)
          ->onQueue('broadcast')
          ->delay(now()->addSeconds($delaySeconds));
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
    try {
      return $this->emailRepository->getEmailMessage();
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

  public function receveEmailMessage($email)
  {
    DB::beginTransaction();
    try {
      $result = $this->emailRepository->isEmailAddressExistRepo($email->email_address);
      if(count($result) != 0)
      {
        $email->email_id = $result[0]->id;
        $this->emailRepository->storeEmailRepo($email);
      }
      else
      {
        $email->is_subscribe = Config::get('constants_val.subscribe_false');
        $emailResult = $this->emailRepository->storeEmailRepo($email);
        $email->email_id = $emailResult->id;
        $this->emailRepository->storeEmailMessageRepo($email);
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
    DB::beginTransaction();
    try {
      $result = $this->emailRepository->isEmailAddressExistRepo($email->email_address);
      if(count($result) != 0) {

        $content = new \stdClass();
        $content->title = "Hello From Batu Yonny";
        $content->body = "You are will be recieve news update from us";
        $content->link = "link";
        $content->footer = "Thanks";

        Mail::to($email->email_address)->send(new SendMail($content));
        DB::commit();
        return true;
      }
      else
      {
        throw new Exception('email not found');
      }
    }
    catch (Exception $ex)
    {
      DB::rollBack();
      throw $ex;
    }
  }

  public function deleteEmailMessage($id)
  {
    try {
      $this->emailRepository->isEmailMessageExistRepo($id);
      $this->emailRepository->deleteEmailMessageRepo($id);
      return true;
    }
    catch (Exception $ex)
    {
      throw $ex;
    }
  }

}