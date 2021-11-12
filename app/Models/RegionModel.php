<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionModel extends Model
{
  protected $table = 'ms_region';
  protected $primaryKey = 'id';
  protected $fillable = [
    'region'
  ];
}
