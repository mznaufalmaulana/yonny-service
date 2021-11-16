<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmailRequest extends FormRequest
{
  public function rules(): array
    {
      if(request()->isMethod('post'))
      {
        return [
          'email_address' =>  'required | email',
        ];
      }
      else if (request()->isMethod('put'))
      {
        return [
          'email_address' =>  'required | email',
          'is_subscribe' => 'required | numeric | between:0,1'
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
