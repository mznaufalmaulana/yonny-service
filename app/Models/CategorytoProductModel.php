<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorytoProductModel extends Model
{
    protected $table = 'brg_product_category';
    protected $primaryKey = 'id';
    protected $fillable = [
      'category_id', 'product_id'
    ];
}
