<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SocialMediaRequest extends FormRequest
{

    public function rules(): array
    {
      if(request()->isMethod('post'))
      {
        return [
          'icon'  =>  'required',
          'link'  =>  'required'
        ];
      }
      elseif (request()->isMethod('put'))
      {
        return [
          'icon'  =>  'required',
          'link'  =>  'required'
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
