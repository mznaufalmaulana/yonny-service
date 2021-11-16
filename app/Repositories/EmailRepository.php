<?php


namespace App\Repositories;

use App\Models\EmailMessageModel;
use App\Models\EmailModel;

class EmailRepository
{
  public function getListEmailRepo()
  {
    return EmailModel::select('id', 'email_address', 'is_subscribe')->get();
  }

  public function getEmailByIdRepo($id)
  {
    return EmailModel::where('id', $id)
            ->select('id', 'email_address', 'is_subscribe')
            ->get();
  }

  public function getEmailByListIdRepo($listId)
  {
    return EmailModel::whereIn('id', $listId)
          ->select('email_address')
          ->get();
  }

  public function storeEmailRepo($email)
  {
    return EmailModel::create([
      'email_address' =>  $email->email_address,
      'is_subscribe'  =>  $email->is_subscribe,
    ]);
  }

  public function updateEmailRepo($id, $email)
  {
    return EmailModel::where('id', $id)
            ->update([
              'email_address' =>  $email->email_address,
              'is_subscribe'  =>  $email->is_subscribe
            ]);
  }

  public function deleteEmailRepo($id)
  {
    return EmailModel::destroy($id);
  }

  public function storeEmailMessageRepo($email)
  {
    return EmailMessageModel::create([
      'email_id' => $email->email_id,
      'message' => $email->message
    ]);
  }

  public function isEmailExistRepo($id)
  {
    return EmailModel::findOrFail($id);
  }

  public function isEmailAddressExistRepo($address)
  {
    return EmailModel::where('email_address', $address)
      ->select('id', 'email_address')
      ->get();
  }
}