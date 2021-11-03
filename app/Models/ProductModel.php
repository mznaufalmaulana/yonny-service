<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'tbl_product';
    protected $primaryKey = 'id';
    protected $fillable =[
      'category_id', 'product_type_id', 'product_photo_id',
      'product_name', 'description', 'id_active',
      'share_count',
    ];
}
