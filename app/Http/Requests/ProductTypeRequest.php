<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type_name' => 'required|min:4'
        ];
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
