<?php

namespace App\Http\Controllers\leads;

use App\Http\Controllers\Controller;
use App\Http\Controllers\leads\models\Lead;
use App\Http\Controllers\leads\Requests\CreateLeadRequest;
use App\Http\Controllers\leads\Requests\UpdateLeadRequest;
use Exception;
use Illuminate\Http\Request;

class LeadsController extends Controller {
    
    public function __construct(Lead $model)
    {
        $this->model_ = $model;        
    }


    public function store(CreateLeadRequest $request) {
        try {
            $this->model_->fill($request->all());
            $this->model_->created_by = $this->getUserID();
            if($this->model_->save()) {
                return $this->HttpOk(['message' => LeadsController::DATA_ADDED]);
            } else {
                return $this->HttpFailed(['message' => LeadsController::DATA_ADDED_FAILED]);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function Update(UpdateLeadRequest $request) {
        try {
            if($this->model_->where('id', $request->id)->Update($request->all())) {
                return $this->HttpOk(['message' => LeadsController::DATA_UPDATED]);
            } else {
                return $this->HttpFailed(['message' => LeadsController::DATA_UPDATED_FAILED]);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function index() {
        try {
            $data = $this->model_->orderBy('id', 'DESC')->get();
            return $this->HttpOk(['leads' => $data]);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function destroy(Request $request) {
        try {
            if($this->model_->where('id', $request->id)->delete()) {
                return $this->HttpOk(['message' => LeadsController::DATA_DELETED]);
            } else {
                return $this->HttpFailed(['message' => LeadsController::DATA_DELETED_FAILED]);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }
}