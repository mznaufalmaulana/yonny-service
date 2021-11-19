<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailMessageModel extends Model
{
    protected $table = 'tbl_email_message';
    protected $primaryKey = 'id';
    protected $fillable = [
      'email_id', 'message'
    ];
}
