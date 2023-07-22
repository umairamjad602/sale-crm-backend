<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Categories\Models\Category;
use App\Http\Controllers\Categories\Requests\CreateCategoryRequest;
use App\Http\Controllers\Categories\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use Exception;

class CategoriesController extends Controller {
    public function __construct(Category $model)
    {
        $this->model_ = $model;
    }

    public function index() {
        try {
            $results = $this->model_->where('company_id', $this->getCompanyId())->latest()->get();
            return $this->HttpOk(['categories' => $results]);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function store(CreateCategoryRequest $request) {
        try {
            $this->model_->fill($request->all());
            $this->model_->company_id = $this->getCompanyId();
            $this->model_->created_by = $this->getUserID();
            if($this->model_->save()) {
                return $this->HttpOk(['message' => 'Category Created']);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function destory($id) {
        try {
            $category = $this->model_->where('id', $id)->first();
            if($category) {
                if($category->delete()) {
                    return $this->HttpOk(['message' => 'Category deleted']);
                }
            }
            return $this->HttpDataNotFound(['message' => 'Category not found.']);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function update(UpdateCategoryRequest $request) {
        try {
            $category = $this->model_->where('id', $request->id)->first();
            if($category) {
                $category->fill($request->all());
                if($category->save()) {
                    return $this->HttpOk(['message' => 'Category Updated.']);
                }
            }
            return $this->HttpDataNotFound(['message' => 'Category not found']);
            // Not Emplement
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

}