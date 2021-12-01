<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
  public function rules(): array
  {
    if($this->isMethod('post'))
    {
      return [
        'username' => 'required',
        'email' => 'required | email | unique:App\User,email',
        'password' => 'required | confirmed | min:6',
      ];
    }
    elseif ($this->isMethod('put'))
    {
      return [
        'email' =>  'sometimes | required | email',
        'password' => 'required | confirmed | min:6',
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