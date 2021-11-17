<?php

namespace App\Http\Controllers\Email;

use App\Contracts\Admin\Email\EmailInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\BroadcastRequest;
use App\Http\Requests\EmailMessageRequest;
use App\Http\Requests\EmailRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class EmailController extends Controller
{
  private $email;
  public function __construct
  (
    EmailInterface $email
  )
  {
    $this->email = $email;
  }

  public function getListEmail(): JsonResponse
  {
    try {
      $emails = $this->email->getListEmail();
      return $this->returnSuccess($emails, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function getEmailById($id): JsonResponse
  {
    try {
      $email = $this->email->getEmailById($id);
      return $this->returnSuccess($email, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function storeEmail(EmailRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $result = $this->email->storeEmail($request);
      return $this->returnSuccess($result, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function updateEmail($id, EmailRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $result = $this->email->updateEmail($id, $request);
      return $this->returnSuccess($result, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function deleteEmail($id): JsonResponse
  {
    try {
      $result = $this->email->deleteEmail($id);
      return $this->returnSuccess($result, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function subscribeEmail(EmailRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $result = $this->email->subscribeEmail($request);
      return $this->returnSuccess($result, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function broadcastEmail(BroadcastRequest $request): JsonResponse
  {
    try {
      $request->validated();
      $result = $this->email->broadcastEmail($request);
      return $this->returnSuccess($result, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function getEmailMessage()
  {
    try {
      $result = $this->email->getEmailMessage();
      return $this->returnSuccess($result, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function receiveEmailMessage(EmailMessageRequest $request)
  {
    try {
      $request->validated();
      $result = $this->email->receiveEmailMessage($request);
      return $this->returnSuccess($result, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }

  public function sendEmailMessage(EmailMessageRequest $request)
  {
    try {
      $request->validated();
      $result = $this->email->sendEmailMessage($request);
      return $this->returnSuccess($result, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail($ex->getMessage(), 'fail');
    }
  }
}
