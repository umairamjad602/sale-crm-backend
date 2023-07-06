<?php

namespace App\Http\Controllers\Options;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Options\Models\Option as ThisModel;
use App\Http\Controllers\Options\Requests\CreateOptionRequest as CreateRequest;
use App\Http\Controllers\Options\Requests\UpdateOptionRequest as UpdateRequest;
use App\Http\Controllers\Options\Models\FieldOptionType;
use App\Http\Controllers\Options\Models\FieldOption;

class OptionsController extends Controller
{
    const MODULE_NAME = 'option';
    const COLLECTION_NAME = 'options';

    public function __construct(ThisModel $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        try {
            $records = $this->retrieveRecords();
            return $this->created([OptionsController::COLLECTION_NAME => $records]);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function create()
    {
        return;
    }

    public function store(CreateRequest $request)
    {
        try {
            $this->model->fill($request->all());
            if($this->model->save()) {
                return $this->created([OptionsController::MODULE_NAME => $this->model, 'message'=> OptionsController::RECORD_CREATED]);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function show($id)
    {
        try {
            $record = $this->findOneById($id);
            return $this->created([OptionsController::MODULE_NAME => $record]);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function edit($id)
    {
        return;
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $auth = auth()->user();
            $record = $this->findOneById($id);
            $record->fill($request->all());
            if($record->save()) {
                return $this->created([OptionsController::MODULE_NAME => $record, 'message'=> OptionsController::RECORD_UPDATED]);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function destroy($id)
    {
        try {
            $record = $this->findOneById($id);
            if($record->delete()) {
                return $this->created(['message'=> OptionsController::RECORD_DELETED]);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->serverSQLError($ex);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function retrieveFieldOptionsByTypeId(int $typeId) {
        return FieldOptionType::where('id', $typeId)->select(['id','type_description','comment'])->with('options')->get();
    }

    public function retrieveFieldOptions() {
        $fieldOptions =  FieldOptionType::select(['id','type_description','comment'])->with('options')->get();
        $options = [];
        foreach($fieldOptions as $fieldOption) {
            $options[$fieldOption->id] = $fieldOption;
        }
        return $options;
    }


}
