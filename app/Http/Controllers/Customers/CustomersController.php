<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Customers\Models\Customer;
use App\Http\Controllers\Customers\Requests\CreateCustomerRequest;
use Exception;

class CustomersController extends Controller {

    public function __construct (Customer $model) {
        $this->model_ = $model;
    }

    public function store(CreateCustomerRequest $request) {
        try {
            $this->model_->fill($request->all());
            $this->model_->created_by = $this->getUserID();
            $this->model_->company_id = $this->getCompanyId();
            if($this->model_->save()) {
                return $this->HttpOk(['message' => 'Customer created.']);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function index() {
        try {
            $results = $this->model_->where('company_id', $this->getCompanyId())->latest()->get();
            return $this->HttpOk(['customers' => $results]);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

}