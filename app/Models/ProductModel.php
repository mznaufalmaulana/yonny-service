<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'tbl_product';
    protected $primaryKey = 'id';
    protected $fillable =[
      'product_type_id', 'product_name', 'product_slug',
      'description', 'is_active', 'seen_count',
      'share_count',
    ];
}
