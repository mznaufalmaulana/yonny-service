<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
  protected $table = 'tbl_photo';
  protected $primaryKey = 'id';
  protected $fillable = [
    'photo_name'
  ];
}
