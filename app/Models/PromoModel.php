<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromoModel extends Model
{
    protected $table = 'tbl_promo';
    protected $primaryKey = 'id';
    protected $fillable = [
      'name', 'photo_name', 'link',
      'order', 'is_headline'
    ];
}
