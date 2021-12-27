<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    protected $table = 'tbl_contact';
    protected $primaryKey = 'id';
    protected $fillable = [
      'region_id', 'first_address', 'second_address',
      'phone', 'email', 'is_on_footer'
    ];
}
