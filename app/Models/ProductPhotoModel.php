<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPhotoModel extends Model
{
  protected $table = 'tbl_product_photo';
  protected $primaryKey = 'id';
  protected $fillable = [
    'product_id', 'photo_name'
  ];
}
