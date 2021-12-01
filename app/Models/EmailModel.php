<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Notifications\Notifiable;

class EmailModel extends Model
{
    protected $table = 'tbl_email';
    protected $primaryKey = 'id';
    protected $fillable = [
      'email_address', 'is_subscribe'
    ];
}
