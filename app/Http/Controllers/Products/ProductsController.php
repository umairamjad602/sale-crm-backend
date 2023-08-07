<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Products\Models\Product;
use App\Http\Controllers\Products\Requests\CreateProductRequest;
use Exception;
use Illuminate\Http\Request;

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

    public function index(Request $request) {
        try {
            $query = $this->model_->with('category')->where('company_id',  $this->getCompanyId());
            if($request->has('name')) {
                $query->where('name', 'like', '%'.$request->name.'%');
            }
            if($request->has('per_page')) {
                $query->take($request->per_page);
            }
            $results = $query->latest()->get();
            return $this->HttpOk(['products' => $results]);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

}