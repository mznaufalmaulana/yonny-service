<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryModel extends Model
{
    protected $table = 'ms_category';
    protected $primaryKey = 'id';
    protected $fillable = [
      'category_parent', 'category_name'
    ];
}
