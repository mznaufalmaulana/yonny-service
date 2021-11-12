<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegionRequest extends FormRequest
{
  public function rules(): array
  {
    if(request()->isMethod('post'))
    {
      return [
        'region'  =>  'required | string',
      ];
    }
    else if (request()->isMethod('put'))
    {
      return [
        'region'  =>  'required | string',
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