<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Categories\CategoriesController;
use App\Http\Controllers\Geo\PostalCodes\PostalCodeController;
use App\Http\Controllers\leads\LeadsController;
use App\Http\Controllers\Options\FieldOptionsController;
use App\Http\Controllers\RemoteAreas\RemoteAreasController;
use App\Http\Controllers\Shipments\Models\Shipment;
use App\Http\Controllers\Shipments\ShipmentsController;
use App\Http\Controllers\Tracking\TrackingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);
});

// Catergory
Route::group(['prefix' => 'categories'] ,function ($router) {
    Route::get('fetch', [CategoriesController::class, 'index']);
    Route::post('store', [CategoriesController::class, 'store']);
    Route::post('update', [CategoriesController::class, 'update']);
    Route::get('show/{id}', [CategoriesController::class, 'show']);
});

// Leads
Route::group(['prefix' => 'leads'] ,function ($router) {
    Route::get('fetch', [LeadsController::class, 'index']);
    Route::post('create', [LeadsController::class, 'store']);
    Route::post('update', [LeadsController::class, 'update']);
    Route::get('show', [LeadsController::class, 'show']);
    Route::get('delete', [LeadsController::class, 'destroy']);
});

// Shipments
Route::group(['prefix' => 'shipment'], function ($router) {
    Route::post('create', [ShipmentsController::class, 'store']);
    Route::get('pdf/{id}', [ShipmentsController::class, 'getPDF']);
    Route::get('', [ShipmentsController::class, 'index']);
    Route::get('get-serial-number', [ShipmentsController::class, 'getSerialNumber']);
});

// Lookup
Route::group((['prefix' => 'lookup']), function ($router) {
    Route::get('postal-code', [PostalCodeController::class, 'postalcodeLookup']);
    Route::get('countries', [PostalCodeController::class, 'fetchCountries']);
});

// Field Options
Route::group((['prefix' => 'field-options']), function ($router) {
    Route::get('by-type/{typeId}', [FieldOptionsController::class, 'getFieldOptionsByType']);
});

//Media
Route::group(['prefix' => 'media'], function ($router) {
    Route::post('upload', 'Medias\MediasController@upload');
    Route::delete('delete/{id}', 'Medias\MediasController@destroyMedia');
    Route::post('directories', 'Medias\MediasController@storeDirectory');
    Route::get('directories', 'Medias\MediasController@listDirectories');
    Route::delete('directories/delete/{id}', 'Medias\MediasController@destroyDirectory');
    Route::get('entity/{module_id}/{relation_id}', 'Medias\MediasController@getMediaForEntity');
    Route::get('list', 'Medias\MediasController@getMedia');
    Route::get('serve/{filename}', 'Medias\MediasController@serve');
});

Route::group(['prefix' => 'products'], function ($router) {
    // Route::post('create', )
});

Route::group(['prefix' => 'tracking'], function ($router) {
    Route::post('create', [TrackingController::class, 'store']);
    Route::get('delete/{id}', [TrackingController::class, 'deleteTracking']);
});

Route::post('validate-remote-area', [RemoteAreasController::class, 'validateRemoteArea']);
Route::get('services', [RemoteAreasController::class, 'getServiceAPI']);
Route::get('open/tracking/{serialNumber}', [TrackingController::class, 'getTracking']);