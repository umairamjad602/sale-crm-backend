<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{

    const DATA_ADDED = 'Data added successfully';
    const DATA_ADDED_FAILED = 'Data added unsuccessfully';
    const DATA_UPDATED = 'Data updated successfully';
    const DATA_UPDATED_FAILED = 'Data updated unsuccessfully';
    const DATA_DELETED = 'Data deleted successfully';
    const DATA_DELETED_FAILED = 'Data deleted unsuccessfully';
    const DATA_NOT_FOUND = 'Data not found';

    protected $model_;

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function serverError(Exception $ex, int $code = Response::HTTP_INTERNAL_SERVER_ERROR) {
        return response()->json([
            'error' => $ex->getMessage()
        ], $code);
    }

    protected function SQLServerError(Exception $ex, int $code = Response::HTTP_INTERNAL_SERVER_ERROR) {
        return response()->json([
            'error_state' => $ex->errorInfo[0],
            'error_code' => $ex->errorInfo[1],
            'error' => $this->GetDatabseErrorCodeInfo($ex)
        ], $code);
    }

    protected function GetDatabseErrorCodeInfo(Exception $ex) {
        $message = 'Database error';
        switch ($ex->errorInfo[1]) {
            case 1451:
                $message = 'Unable to delete data,  related data to this record needs to be removed first';
            break;
            case 1452:
                $message = 'Unable to to add or update a child row: a foreign key constraint fails';
            break;
        }
    }

    protected function HttpOk(array $data, int $code = Response::HTTP_OK) {
        return response()->json($data, $code);
    }

    protected function HttpDataNotFound(array $data, int $code = Response::HTTP_NOT_FOUND) {
        return Response()->json($data, $code);
    }

    protected function HttpFailed(array $data, int $code =  Response::HTTP_EXPECTATION_FAILED) {
        return response()->date($data, $code);
    }

    protected function HttpNotAllowd(array $data, int $code = Response::HTTP_UNAUTHORIZED) {
        return response()->json($data, $code);
    }

    protected function CurrentUserData() {
        return auth()->user();
    }
    protected function getUserID() {
        return auth()->user()->id;
    }

    protected function getWebUser($request) {
        return $request->user()->id;
    }
}
