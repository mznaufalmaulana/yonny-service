<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    protected $table = 'tbl_project';
    protected $primaryKey = 'id';
    protected $fillable = [
      'project_name', 'project_slug', 'description',
      'seen_count', 'share_count', 'created_at'
    ];
}
