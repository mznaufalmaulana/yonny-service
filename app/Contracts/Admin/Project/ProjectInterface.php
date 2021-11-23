<?php


namespace App\Contracts\Admin\Project;


use App\Http\Requests\ProjectRequest;
use App\Models\ProjectModel;
use App\Models\ProjectPhotoModel;

interface ProjectInterface
{
  public function getListProject();
  public function getProjectById($id);
  public function storeProject($project);
  public function incrementShareProject($id);
  public function updateProject($id, $request);
  public function deleteProject($id);

  public function getListProjectPhoto($projectId);
  public function storeProjectPhoto($projectId, $projectPhoto);
  public function updateProjectPhoto($id, $projectPhoto);
  public function deleteProjectPhoto($photoId);

  public function storeProjectPhotoFile($photoFile, $photoName);
  public function deleteProjectPhotoFile($photoName);
}