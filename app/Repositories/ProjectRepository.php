<?php


namespace App\Repositories;


use App\Http\Requests\ProjectRequest;
use App\Models\ProjectModel;
use App\Models\ProjectPhotoModel;
use DB;
use Illuminate\Support\Facades\Config;

class ProjectRepository
{
  //  List project
  public function getListProjectRepo()
  {
    return ProjectModel::select('id', 'project_name', 'share_count')->get();
  }

  // Get project
  public function getProjectByIdRepo($id)
  {
    return ProjectModel::where('id', $id)
            ->select('id','project_name', 'description', 'share_count')
            ->get();
  }

  public function getProjectPhotoByProjectIdRepo($id)
  {
    return ProjectPhotoModel::where('project_id', $id)
            ->select('id', 'photo_name')
            ->get();
  }

  public function getProjectPhotoByIdRepo($photoId)
  {
    return ProjectPhotoModel::where('id', $photoId)
            ->select('id', 'photo_name')
            ->get();
  }

  // Store project
  public function storeProjectRepo($project)
  {
    return ProjectModel::create([
      'project_name' => $project->project_name,
      'project_slug' => \Str::slug($project->project_name, '-'),
      'description' => $project->description,
      'share_count' => Config::get('constants_val.count_start')
    ]);
  }

  public function storeProjectPhotoRepo($projectId, $projectPhoto)
  {
    return ProjectPhotoModel::create([
      'project_id'  =>  $projectId,
      'photo_name'  =>  $projectPhoto,
    ]);
  }

  // Update project
  public function updateProjectRepo($id, $project)
  {
    return ProjectModel::where('id', $id)->update([
      'project_name' => $project->project_name,
      'project_slug' => \Str::slug($project->project_name, '-'),
      'description' =>  $project->description,
      'share_count' =>  $project->share_count
    ]);
  }

  public function updateProjectPhotoRepo($id, $photoName)
  {
    return ProjectPhotoModel::where('id', $id)->update([
      'photo_name'  =>  $photoName
    ]);
  }

  // Delete project
  public function deleteProjectRepo($id)
  {
    return ProjectModel::destroy($id);
  }

  public function deleteProjectPhotoByProjectIdRepo($id)
  {
    return ProjectPhotoModel::where('project_id', $id)->delete();
  }

  public function deleteProjectPhotoByIdRepo($id)
  {
    return ProjectPhotoModel::destroy($id);
  }

  // Check project
  public function isProjectExist($id)
  {
    return ProjectModel::findOrFail($id);
  }
}