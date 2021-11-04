<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'product_category_id' =>  'required | numeric',
      'product_type_id' =>  'required | numeric',
      'product_name'  =>  'required | min:4',
      'description' =>  'required | string | min:4',
      'is_active' =>  'required | numeric',
      'share_count' =>  'required | numeric | min:0',
      'product_photo' =>  'required | mimes:jpeg,jpg,png | max:3000'
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