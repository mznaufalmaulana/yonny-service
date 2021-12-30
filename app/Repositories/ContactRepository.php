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
            ->select('tc.id', 'mr.region', 'tc.first_address', 'tc.second_address', 'tc.phone', 'tc.email', 'tc.is_on_footer')
            ->get();
  }

  public function getContactByIdRepo($id)
  {
    return DB::table('tbl_contact as tc')
            ->join('ms_region as mr', 'tc.region_id', '=', 'mr.id')
            ->where('tc.id', $id)
            ->select('tc.id', 'mr.id as region_id', 'mr.region', 'tc.first_address', 'tc.second_address', 'tc.phone', 'tc.email', 'tc.is_on_footer')
            ->get();
  }

  public function getContactByRegionId($regionId)
  {
    return DB::table('tbl_contact as tc')
            ->where('tc.region_id', $regionId)
            ->select( 'tc.first_address', 'tc.second_address', 'tc.phone', 'tc.email')
            ->get();
  }

  public function getContactIsOnfooter()
  {
    return DB::table('tbl_contact as tc')
      ->where('tc.is_on_footer', 1)
      ->select( 'tc.first_address', 'tc.second_address', 'tc.phone', 'tc.email')
      ->get();
  }

  public function storeContactRepo($contact)
  {
    return ContactModel::create([
              'region_id' => $contact->region_id,
              'first_address' =>  $contact->first_address,
              'second_address' =>  $contact->second_address,
              'phone' =>  $contact->phone,
              'email' =>  $contact->email,
              'is_on_footer' =>  $contact->is_on_footer
            ]);
  }

  public function updateContactRepo($id, $contact)
  {
    return ContactModel::where('id', $id)
            ->update([
              'region_id' => $contact->region_id,
              'first_address' =>  $contact->first_address,
              'second_address' =>  $contact->second_address,
              'phone' =>  $contact->phone,
              'email' =>  $contact->email,
            ]);
  }

  public function updateContactIsOnFooter($id)
  {
    ContactModel::query()->update(['is_on_footer' =>  0]);
    return ContactModel::where('id', $id)
            ->update([
              'is_on_footer' =>  1
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