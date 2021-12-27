<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EmailMessageRequest extends FormRequest
{
  public function rules(): array
  {
    if(request()->isMethod('post'))
    {
      return [
        'name' => 'required | string',
        'email_address' =>  'required | email',
        'message' =>  'required | string',
        'product_id' => 'nullable |numeric'
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
