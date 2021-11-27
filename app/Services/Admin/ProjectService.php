<?php


namespace App\Services\Admin;


use App\Contracts\Admin\Project\ProjectInterface;
use App\Http\Requests\ProjectRequest;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProjectService implements ProjectInterface
{

  private $projectRepository;
  public function __construct
  (
    ProjectRepository $projectRepository
  )
  {
    $this->projectRepository = $projectRepository;
  }

  public function getListProject()
  {
    return $this->projectRepository->getListProjectRepo();
  }

  public function getProjectById($id)
  {
    $this->projectRepository->isProjectExist($id);
    $project = $this->projectRepository->getProjectByIdRepo($id);
    $photos = $this->projectRepository->getProjectPhotoByProjectIdRepo($id);
    $project[0]->photo = $photos;

    return $project;
  }

  public function getListProjectStore($request)
  {
    $projectQuery =  $this->projectRepository->getListProjectStoreRepo();
    if ($request->sort && in_array($request->sort, ['asc','desc']))
    {
      $projectQuery = $this->projectRepository->querySort($projectQuery, $request->sort);
    }
    $projectQuery = $this->projectRepository->queryPaging($projectQuery);

    return  $projectQuery->appends($request->input())->toArray();
  }

  public function storeProject($project)
  {
    DB::beginTransaction();
    try {
      $proj = $this->projectRepository->storeProjectRepo($project);
//      foreach ($project->file('project_photo') as $file)
//      {
//        $photoName = time().'_'.$file->getClientOriginalName();
//        $photoNameWithPath = Config::get('constants_val.path_photo_project').$photoName;
//        $this->projectRepository->storeProjectPhotoRepo($result->id, $photoNameWithPath);
//        $this->storeProjectPhotoFile($file, $photoName);
//      }

      DB::commit();
      $result = new \stdClass();
      $result->project_id = $proj->id;
      return $result;
    }
    catch (\Exception $ex)
    {
      DB::rollBack();
      throw $ex;
    }
  }

  public function incrementShareProject($id)
  {
    $project = $this->projectRepository->isProjectExist($id);
    $project->share_count +=1;
    $this->projectRepository->updateProjectRepo($id, $project);

    return true;
  }

  public function updateProject($id, $request)
  {
    $this->projectRepository->isProjectExist($id);
    $this->projectRepository->updateProjectRepo($id, $request);

    return true;
  }

  public function deleteProject($id)
  {
    DB::beginTransaction();
    try {
      $this->projectRepository->isProjectExist($id);
      $this->projectRepository->deleteProjectRepo($id);
      $photos = $this->projectRepository->getProjectPhotoByProjectIdRepo($id);
      foreach ($photos as $photo)
      {
        $this->deleteProjectPhotoFile($photo->photo_name);
      }
      $this->projectRepository->deleteProjectPhotoByProjectIdRepo($id);

      DB::commit();
      return true;
    }
    catch (\Exception $ex)
    {
      DB::rollBack();
      throw $ex;
    }
  }

  public function getListProjectPhoto($projectId)
  {
    $this->projectRepository->isProjectExist($projectId);
    return $this->projectRepository->getProjectPhotoByProjectIdRepo($projectId);
  }

  public function storeProjectPhoto($projectId, $projectPhoto)
  {
    try {
      $this->projectRepository->isProjectExist($projectId);
      $photoName = time().'_'.$projectPhoto->file('photo')->getClientOriginalName();
      $photoNameWithPath = Config::get('constants_val.path_photo_project').$photoName;
      $this->projectRepository->storeProjectPhotoRepo($projectId, $photoNameWithPath);
      $this->storeProjectPhotoFile($projectPhoto->file('photo'), $photoName);

      return true;
    }
    catch (\Exception $ex)
    {
      throw $ex;
    }
  }

  public function updateProjectPhoto($id, $projectPhoto)
  {
    try {
      $photoPath = $this->projectRepository->getProjectPhotoByIdRepo($id);
      $photoName = time().'_'.$projectPhoto->file('photo')->getClientOriginalName();
      $photoNameWithPath = Config::get('constants_val.path_photo_project').$photoName;
      $this->deleteProjectPhotoFile($photoPath[0]->photo_name);
      $this->projectRepository->updateProjectPhotoRepo($id, $photoNameWithPath);
      $this->storeProjectPhotoFile($projectPhoto->file('photo'),  $photoName);

      return true;
    }
    catch (\Exception $ex)
    {
      throw $ex;
    }
  }

  public function deleteProjectPhoto($photoId)
  {
    try {
      $photo = $this->projectRepository->getProjectPhotoByIdRepo($photoId);
      $this->deleteProjectPhotoFile($photo[0]->photo_name);
      $this->projectRepository->deleteProjectPhotoByIdRepo($photoId);

      return true;
    }
    catch (\Exception $ex)
    {
      throw $ex;
    }

  }

  public function storeProjectPhotoFile($photoFile, $photoName)
  {
    Storage::putFileAs(Config::get('constants_val.path_photo_project'), $photoFile, $photoName);
  }

  public function deleteProjectPhotoFile($photoName)
  {
    Storage::disk(Config::get('constants_val.storage_location'))->delete($photoName);
  }
}