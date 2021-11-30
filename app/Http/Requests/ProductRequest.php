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
        'product_category_id' =>  'required | array',
        'product_type_id' =>  'required | numeric',
        'product_name'  =>  'required | min:4',
        'description' =>  'required | string | min:4',
        'is_active' =>  'required | numeric',
        'seen_count' =>  'required | numeric | min:0',
        'share_count' =>  'required | numeric | min:0',
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