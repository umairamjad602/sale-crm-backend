<?php
    namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait GetFieldOptionsWithNameTrait{
        public function getFieldOptionsWithName(Model $model, $request, array $columns){
            foreach ($columns as $key => $column) {
                if (isset($request[$column]) && is_numeric($request[$column])) {
                    $columnId = $column.'_id';
                    $model->$columnId = $request[$column];
                    $model->$column = fieldOptionIdToName($request[$column]);
                }
            }
            return $model;
        }
    }
