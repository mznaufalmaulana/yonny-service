<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContactRequest extends FormRequest
{

  public function rules(): array
  {
    if(request()->isMethod('post'))
    {
      return [
        'region_id'  =>  'required |numeric',
        'first_address' =>  'required | string',
        'second_address' =>  'required | string',
        'phone' =>  'required | numeric | digits_between:4,14',
        'email' =>  'required | email',
        'is_on_footer' => 'required | numeric'
      ];
    }
    else if (request()->isMethod('put'))
    {
      return [
        'region_id'  =>  'required |numeric',
        'first_address' =>  'required | string',
        'second_address' =>  'required | string',
        'phone' =>  'required | numeric | digits_between:4,14',
        'email' =>  'required | email',
        'is_on_footer' => 'required | numeric'
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
