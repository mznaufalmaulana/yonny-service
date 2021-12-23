<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductPagingRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'name' => 'nullable | string',
      'category' => 'nullable | numeric | min:0',
      'type' => 'nullable | array',
      'type.*'=> 'numeric | min:0',
      'sort' => 'nullable | string',
      'page' => 'nullable | numeric | min:1',
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