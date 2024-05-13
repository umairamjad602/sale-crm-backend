<?php

namespace App\Http\Controllers\Products\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateProductRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            "id" => ['required', 'exists:products,id'],
            "name" => ['required'],
            "category_id" => ['required', 'exists:categories,id'],
            "price" => ['required'],
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors()), 422);
    }
}