<?php


namespace App\Repositories;


use App\Models\ContactModel;

class ContactRepository
{
  public function getListContactRepo()
  {
    return ContactModel::select(
            'id', 'region_id', 'address',
            'phone', 'email')
            ->get();
  }

  public function getContactByIdRepo($id)
  {
    return ContactModel::where('id',$id)
            ->select(
              'id', 'region_id', 'address',
              'phone', 'email')
            ->get();
  }

  public function getContactByRegionId($regionId)
  {
    return ContactModel::where('region_id',$regionId)
      ->select('address','phone', 'email')
      ->get();
  }

  public function storeContactRepo($contact)
  {
    return ContactModel::create([
              'region_id' => $contact->region_id,
              'address' =>  $contact->address,
              'phone' =>  $contact->phone,
              'email' =>  $contact->email
            ]);
  }

  public function updateContactRepo($id, $contact)
  {
    return ContactModel::where('id', $id)
            ->update([
              'region_id' => $contact->region_id,
              'address' =>  $contact->address,
              'phone' =>  $contact->phone,
              'email' =>  $contact->email
            ]);
  }

  public function deleteContactRepo($id)
  {
    return ContactModel::destroy($id);
  }

  public function isContactExist($id)
  {
    return ContactModel::findOrFail($id);
  }
}