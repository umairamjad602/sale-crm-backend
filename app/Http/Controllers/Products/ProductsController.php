<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Products\Models\Product;
use App\Http\Controllers\Products\Requests\CreateProductRequest;
use Exception;

class ProductsController extends Controller {

    public function __construct(Product $model)
    {
        $this->model_ = $model;
    }

    public function store(CreateProductRequest $request) {
        try {
            $payload = $request->all();
            $this->model_->fill($payload);
            $this->model_->created_by = $this->getUserID();
            $this->model_->company_id = $this->getCompanyId();
            if($this->model_->save()) {
                return $this->HttpOk(['message' => 'Product created']);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function index() {
        try {
            $results = $this->model_->with('category')->where('company_id',  $this->getCompanyId())->latest()->get();
            return $this->HttpOk(['products' => $results]);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

}