<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMediaModel extends Model
{
    protected $table = 'tbl_social_media';
    protected $primaryKey = 'id';
    protected $fillable = [
      'icon', 'link'
    ];
}
