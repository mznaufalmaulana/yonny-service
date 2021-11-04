<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'tbl_product';
    protected $primaryKey = 'id';
    protected $fillable =[
      'product_type_id', 'product_name', 'description',
      'is_active', 'share_count',
    ];
}
