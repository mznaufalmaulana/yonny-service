<?php


namespace App\Repositories;


use App\Models\ContactModel;
use Illuminate\Support\Facades\DB;

class ContactRepository
{
  public function getListContactRepo()
  {
    return DB::table('tbl_contact as tc')
            ->join('ms_region as mr', 'tc.region_id', '=', 'mr.id')
            ->select('tc.id', 'mr.region', 'tc.address', 'tc.phone', 'tc.email')
            ->get();
  }

  public function getContactByIdRepo($id)
  {
    return DB::table('tbl_contact as tc')
            ->join('ms_region as mr', 'tc.region_id', '=', 'mr.id')
            ->where('tc.id', $id)
            ->select('tc.id', 'mr.region', 'tc.address', 'tc.phone', 'tc.email')
            ->get();
  }

  public function getContactByRegionId($regionId)
  {
    return DB::table('tbl_contact as tc')
            ->where('tc.region_id', $regionId)
            ->select( 'tc.address', 'tc.phone', 'tc.email')
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