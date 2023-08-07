<?php

namespace App\Http\Controllers\Customers\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class CreateCustomerRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            "name" => ['required'],
            "email" => ['required'],
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors()), 422);
    }
}