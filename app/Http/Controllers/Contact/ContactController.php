<?php

namespace App\Http\Controllers\Contact;

use App\Contracts\Admin\Contact\ContactInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Exception;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    private $contact;
    public function __construct
    (
      ContactInterface $contact
    )
    {
      $this->contact = $contact;
    }

    public function getListContact(): JsonResponse
    {
      try {
        $contacts = $this->contact->getListContact();
        return $this->returnSuccess($contacts, 'success');
      }
      catch (Exception $ex)
      {
        return $this->returnFail($ex->getMessage(), 'fail');
      }
    }

    public function getContactById($id): JsonResponse
    {
      try {
        $contact = $this->contact->getContactById($id);
        return $this->returnSuccess($contact, 'success');
      }
      catch (Exception $ex)
      {
        return $this->returnFail($ex->getMessage(), 'fail');
      }
    }

    public function storeContact(ContactRequest $request): JsonResponse
    {
      try {
        $request->validated();
        $contact = $this->contact->storeContact($request);
        return $this->returnSuccess($contact, 'success');
      }
      catch (Exception $ex)
      {
        return $this->returnFail($ex->getMessage(), 'fail');
      }
    }

    public function updateContact($id, ContactRequest $request): JsonResponse
    {
      try {
        $request->validated();
        $contact = $this->contact->updateContact($id, $request);
        return $this->returnSuccess($contact, 'success');
      }
      catch (Exception $ex)
      {
        return $this->returnFail($ex->getMessage(), 'fail');
      }
    }

    public function deleteContact($id): JsonResponse
    {
      try {
        $contact = $this->contact->deleteContact($id);
        return $this->returnSuccess($contact, 'success');
      }
      catch (Exception $ex)
      {
        return $this->returnFail($ex->getMessage(), 'fail');
      }
    }
}
