<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
  public function rules(): array
  {
    if(request()->isMethod('post'))
    {
      return [
        'product_category_id' =>  'required | array',
        'product_type_id' =>  'required | numeric',
        'product_name'  =>  'required | min:4',
        'description' =>  'required | string | min:4',
        'is_active' =>  'required | numeric',
        'product_photo' =>  'required | max:5000'
      ];
    }
    else if (request()->isMethod('put'))
    {
      return [
        'product_category_id' =>  'sometimes | required | array',
        'product_type_id' =>  'sometimes | required | numeric',
        'product_name'  =>  'sometimes | required | min:4',
        'description' =>  'sometimes | required | string | min:4',
        'is_active' =>  'sometimes | required | numeric',
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