<?php

namespace App\Http\Controllers\Project;

use App\Contracts\Admin\Project\ProjectInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\PhotoRequest;
use App\Http\Requests\ProjectRequest;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
  private $project;
  public function __construct
  (
    ProjectInterface $project
  )
  {
    $this->project = $project;
  }

  public function getListProject()
  {
    try {
      $projects = $this->project->getListProject();
      return $this->returnSuccess($projects, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail('', $ex->getMessage());
    }
  }

  public function getProjectById($id)
  {
    try {
      $project = $this->project->getProjectById($id);
      return $this->returnSuccess($project, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail('', $ex->getMessage());
    }
  }

  public function getListProjectStore(Request $request)
  {
    try {
      $projects = $this->project->getListProjectStore($request);
      return $this->returnSuccess($projects, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail('', $ex->getMessage());
    }
  }

  public function getListPupolarProjectStore()
  {
    try {
      $projects = $this->project->getListPopularProject();
      return $this->returnSuccess($projects, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail('', $ex->getMessage());
    }
  }

  public function storeProject(ProjectRequest $request)
  {
    try {
      $project = $this->project->storeProject($request);
      return $this->returnSuccess($project, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail('', $ex->getMessage());
    }
  }

  public function incrementShareProject($id)
  {
    try {
      $product = $this->project->incrementShareProject($id);
      return $this->returnSuccess($product, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function updateProject($id, ProjectRequest $request)
  {
    try {
      $project = $this->project->updateProject($id, $request);
      return $this->returnSuccess($project, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail('', $ex->getMessage());
    }
  }

  public function deleteProject($id)
  {
    try {
      $project = $this->project->deleteProject($id);
      return $this->returnSuccess($project, 'success');
    }
    catch (Exception $ex)
    {
      return $this->returnFail('', $ex->getMessage());
    }
  }

  public function getListProjectPhoto($projectId)
  {
    try {
      $photos = $this->project->getListProjectPhoto($projectId);
      return $this->returnSuccess($photos, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function storeProjectPhoto($photoId, PhotoRequest $request)
  {
    try {
      $result = $this->project->storeProjectPhoto($photoId, $request);
      return $this->returnSuccess($result, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function updateProjectPhoto($photoId, PhotoRequest $request)
  {
    try {
      $request->validated();
      $result = $this->project->updateProjectPhoto($photoId, $request);
      return $this->returnSuccess($result, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }

  public function deleteProjectPhoto($photoId)
  {
    try {
      $result = $this->project->deleteProjectPhoto($photoId);
      return $this->returnSuccess($result, "success");
    }
    catch (Exception $ex)
    {
      return $this->returnFail("", $ex->getMessage()) ;
    }
  }
}
