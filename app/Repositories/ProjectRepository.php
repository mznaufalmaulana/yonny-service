<?php


namespace App\Repositories;


use App\Http\Requests\ProjectRequest;
use App\Models\ProjectModel;
use App\Models\ProjectPhotoModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class ProjectRepository
{
  //  List project
  public function getListProjectRepo()
  {
    return DB::table('tbl_project as tp')
            ->select('tp.id','tp.project_name', 'tp.project_slug', 'tp.created_at as project_due',
              'tp.seen_count', 'tp.share_count')
            ->get();
  }

  public function getListProjectStoreRepo()
  {
    return DB::table('tbl_project as tp')
            ->select('tp.id','tp.project_name', 'tp.project_slug',
              'tp.description', 'tp.created_at as project_due','tp.seen_count',
              'tp.share_count',
              DB::raw('(select tpp.photo_name from tbl_project_photo tpp where tp.id = tpp.project_id limit 1) as photo_name')
            );
  }

  public function querySort($query, $sort)
  {
    return $query->orderBy('tp.id', $sort);
  }

  public function queryPaging($query)
  {
    return $query->paginate(Config::get('constants_val.project_paging_limit'));
  }

  // Get project
  public function getProjectByIdRepo($id)
  {
    return DB::table('tbl_project as tpj')
            ->where('id', $id)
            ->select('tpj.id','tpj.project_name', 'tpj.project_slug', 'tpj.description',
              'tpj.created_at as project_due','tpj.seen_count', 'tpj.share_count')
            ->get();
  }

  public function getProjectPhotoByProjectIdRepo($id)
  {
    return DB::table('tbl_project_photo as tpjp')
            ->where('project_id', $id)
            ->select('tpjp.id', 'tpjp.photo_name')
            ->get();
  }

  public function getProjectPhotoByIdRepo($photoId)
  {
    return DB::table('tbl_project_photo as tpjp')
            ->where('id', $photoId)
            ->select('tpjp.id', 'tpjp.photo_name')
            ->get();
  }

  // Store project
  public function storeProjectRepo($project)
  {
    return ProjectModel::create([
      'project_name' => $project->project_name,
      'project_slug' => \Str::slug($project->project_name, '-'),
      'description' => $project->description,
      'seen_count' => Config::get('constants_val.count_start'),
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
      'seen_count' =>  $project->seen_count,
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