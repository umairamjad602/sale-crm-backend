<?php

namespace App\Http\Services;

use App\Http\Controllers\Geo\PostalCodes\Models\PostalCode;
use Illuminate\Support\Facades\Request;

class PostalCodesServices {
    public $model_;

    public function __construct(PostalCode $model)
    {
        $this->model_ = $model;
    }

    public function postalCode(array $data) {
        return $this->model_->where('country_code', '=',$data['country_code'])->where('postal_code', 'LIKE', '%'.$data['postal_code'].'%')->select('id', 'postal_code', 'city', 'state')->get();
    }
    public function postalCodeByCity(array $data) {
        return $this->model_->where('country_code', '=',$data['country_code'])->where('city', 'LIKE', '%'.$data['city'].'%')->get();
    }
}