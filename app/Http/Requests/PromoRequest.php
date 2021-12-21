<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PromoRequest extends FormRequest
{
  public function rules(): array
  {
    if(request()->isMethod('post'))
    {
      return [
        'photo_name'  =>  'nullable | image | mimetypes:image/jpeg,image/png,image/jpg | max:5000',
        'link' =>  'required | string',
        'order' =>  'required | numeric | min:0',
        'is_headline' =>  'required | numeric | digits_between: 0,1',
      ];
    }
    else if (request()->isMethod('put'))
    {
      return [
        'photo_name'  =>  'nullable | image | mimetypes:image/jpeg,image/png,image/jpg | max:5000',
        'link' =>  'required | string',
        'order' =>  'required | numeric | min:0',
        'is_headline' =>  'required | numeric |digits_between: 0,1',
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