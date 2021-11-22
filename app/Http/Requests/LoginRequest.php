<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'email' =>  'required | email',
      'password'  =>  'required',
    ];
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