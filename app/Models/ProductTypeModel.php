<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTypeModel extends Model
{
  protected $table = 'ms_product_type';
  protected $primaryKey = 'id';
  protected $fillable = [
    'type_name'
  ];
}
