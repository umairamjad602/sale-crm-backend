<?php
namespace App\Http\Controllers\leads\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateLeadRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            "title" => ['required'],
            "first_name" => ['required'],
            "last_name" => ['required'],
            "primary_email" => ['required'],
        ];
    }

    public function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors()), 422);
    }

}
