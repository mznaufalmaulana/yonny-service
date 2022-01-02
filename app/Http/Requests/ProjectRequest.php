<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProjectRequest extends FormRequest
{
  public function rules(): array
  {
    if(request()->isMethod('post'))
    {
      return [
        'project_name'  =>  'required | string',
        'description' =>  'required | string',
//        'project_photo' =>  'required | array',
//        'project_photo.*' =>  'mimetypes:image/jpeg,image/png,image/jpg | max:5000',
      ];
    }
    else if (request()->isMethod('put'))
    {
      return [
        'project_name'  =>  'required | string',
        'description' =>  'required | string',
        'seen_count' =>  'sometimes | required | numeric | min:0',
        'share_count' =>  'sometimes | required | numeric | min:0',
      ];
    }
    return [];
  }

  public function authorize(): bool
  {
    return true;
  }

  protected function failedValidation(Validator $validator)
  {
    $errors = $validator->errors();
    $response = response()->json([
      'message' => 'Invalid data send',
      'data' => $errors->messages(),
    ], 422);

    throw new HttpResponseException($response);
  }
}