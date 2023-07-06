<?php
namespace App\Http\Controllers\Auth\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            "first_name" => ['required'],
            "last_name" => ['required'],
            "email" => ['required', 'email'],
            "password" => ['required', 'min:6'],
            "confirm_password" => ['required', 'same:password'],
            "mobile" => ['required']
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors()), 422);
    }

}
