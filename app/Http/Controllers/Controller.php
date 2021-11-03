<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function returnSuccess($data="", $message = "") : JsonResponse
    {
      return response()->json([
        'message'  => $message,
        'data'  => $data
      ], 200);
    }

  public function returnFail($data="", $message = "") : JsonResponse
  {
    return response()->json([
      'message'  => $message,
      'data'  => $data
    ], 500);
  }
}
