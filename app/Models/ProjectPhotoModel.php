<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPhotoModel extends Model
{
    protected $table = 'tbl_project_photo';
    protected $primaryKey = 'id';
    protected $fillable = [
      'project_id', 'photo_name'
    ];
}
