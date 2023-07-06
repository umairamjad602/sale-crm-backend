<?php

namespace App\Http\Controllers\Options;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Options\Requests\CreateOptionRequest as CreateRequest;
use App\Http\Controllers\Options\Requests\UpdateOptionRequest as UpdateRequest;
use App\Http\Controllers\Options\Requests\CreateFieldOptionTypeRequest;
use App\Http\Controllers\Options\Models\FieldOptionType;
use App\Http\Controllers\Options\Models\FieldOption as ThisModel;

class FieldOptionsController extends Controller
{
    const MODULE = 'FieldOptions';
    const MODULE_NAME = 'field_option';
    const COLLECTION_NAME = 'field_options';
    const FIELD_OPTION_TYPE = 'field_option_type';
    const GET_FIELD_OPTIONS_FOR_COMPANY = 'Get Field Options For Company';
    const CREATE_TYPE = 'Create Type';
    const UPDATE_TYPE = 'Update Type';
    const DELETE_TYPE = 'Delete Type';

    // public function __construct(
    //     ThisModel $model
    // ) {
    //     // parent::__construct($model);
    //     $this->model_ = $model;
    // }

    // public function __construct(ThisModel $model) {
    //     parent::__construct($model);
    //     $this->model_ = $model;
    // }

    public function index()
    {
        try {
            $records = $this->model->toDigest();
            return $this->created([FieldOptionsController::COLLECTION_NAME => $records]);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function store(CreateRequest $request)
    {
        try {
            $this->model->fill($request->all());
            if ($this->model->save()) {
                return $this->created([FieldOptionsController::MODULE_NAME => $this->model]);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function show($id)
    {
        try {
            $record = $this->findOneById($id);
            return $this->created([FieldOptionsController::MODULE_NAME => $record]);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $record = $this->findOneById($id);
            if ($record) {
                $fillables = $this->model->getOnlyFillables($request->all());
                $record->fill($request->all());
                if ($record->save()) {
                    return $this->created([FieldOptionsController::MODULE_NAME => $record]);
                }
            } else {
                // return $this->created(['message' => FieldOptionsController::RECORD_NOT_FOUND], 404);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function destroy($id)
    {
        try {
            $record = $this->findOneById($id);
            if ($record->delete()) {
                // return $this->created(['message' => FieldOptionsController::RECORD_DELETED]);
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return $this->serverSQLError($ex);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function retrieveFieldOptionsByTypeId(int $typeId)
    {
        return $this->fieldOptionService_->retrieveFieldOptionsByTypeId($typeId);
    }


    public function retrieveFieldOptions() {
        $fieldOptions =  FieldOptionType::whereNotIn('id', [70])
                                        ->select(['id','type_description','comment'])
                                        ->with('fieldOptions')
                                        ->orderBy($this->getSortBy(), $this->getSort())
                                        ->paginate($this->getPerPage());
                                        return $this->created([FieldOptionsController::FIELD_OPTION_TYPE => $fieldOptions]);

        // $options = []; // in case of issue of ids order, uncomment this
        // foreach($fieldOptions as $fieldOption) {
        //     $options[$fieldOption->id] = $fieldOption;
        // }
        // return $options;
    }

    public function retrieveOnlySpecificFieldOptions()
    {
        $data = request()->get('ids', []);
        return $this->fieldOptionService_->retrieveOnlySpecificFieldOptions($data);
    }

    // public function getFieldOptionsForCompany() {
    //     try {
    //         if(!$this->userService->isUserAllowedTo($this->userId(),FieldOptionsController::MODULE.'.'.FieldOptionsController::GET_FIELD_OPTIONS_FOR_COMPANY))
    //             return $this->notAllowed(["message" => FieldOptionsController::UNAUTHORIZED]);
    //         $filter = [];
    //         $filter['company_id'] = $this->companyId();
    //         if(request()->has('id')) {
    //             $filter['id'] = request()->id;
    //         }
    //         $fieldOptions = $this->fieldOptionService_->getCompanyFieldOptions($filter)
    //                                                   ->orderBy($this->getSortBy(), $this->getSort())
    //                                                   ->paginate($this->getPerPage());
    //         return $this->created([FieldOptionsController::COMPANY_MAP => $fieldOptions]);
    //     } catch (\Illuminate\Database\QueryException $ex) {
    //         return $this->serverSQLError($ex);
    //     } catch (Exception $ex) {
    //         return $this->serverError($ex);
    //     }
    // }

    public function createFieldOptionType(CreateFieldOptionTypeRequest $request) {
        try {
            $comment = ($request->comment == null)? '': $request->comment;
            if($fieldOptionType = $this->fieldOptionService_->createFieldOptionType($request->description, $comment)) {
                return $this->created(['field_option_type' => $fieldOptionType]);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function updateFieldOptionType(CreateFieldOptionTypeRequest $request)
    {
        try {
            $fieldOptionType = $this->fieldOptionService_->getFieldOptionsTypeById($request->id);
            $fieldOptionTypeUpdatedData = ['type_description' => $request->description, 'comment' => $request->comment];
            if ($fieldOptionType->update($fieldOptionTypeUpdatedData)) {
                $fieldOptions = $request->fieldOptions;
                $collection = collect($fieldOptions);

                $collection->filter(function ($value, $key) {
                    return $value['record_state'] == 1;
                })->each(function ($fieldOption) {
                    $onlyFillables = $this->model->getOnlyFillables($fieldOption);
                    $this->model->where('id', $fieldOption['id'])->update($onlyFillables);
                });

                $collection->filter(function ($value, $key) {
                    return $value['record_state'] == 0;
                })->each(function ($fieldOption) {
                    $onlyFillables = $this->model->getOnlyFillables($fieldOption);
                    $this->model->create($onlyFillables);
                });

                return $this->created(['field_option_type' => $fieldOptionType]);
            }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function deleteFieldOptionType(int $id) {
        // This will also delete the relation field options & other associations.
        // Delete functionality is inside boot function of the model
        try {
                $record = FieldOptionType::where('id', $id)->first();
                if($record->delete()){
                    // return $this->created(['message'=> FieldOptionsController::RECORD_DELETED]);
                }
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }

    public function getFieldOptionsByType(int $typeId)
    {
        try {
            $fieldOptions = ThisModel::where('type_id', $typeId)->select(['id', 'name', 'type_id'])->get();
            return response()->json($fieldOptions);
        } catch (Exception $ex) {
            return $this->serverError($ex);
        }
    }
}
