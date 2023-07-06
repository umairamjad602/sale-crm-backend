<?php

use App\Http\Controllers\RemoteAreas\RemoteAreasController;
use App\Http\Controllers\OPS\OPSController;
use App\Http\Controllers\Clients\ClientsController;
use App\Http\Controllers\Permissions\PermissionsController;
use App\Http\Controllers\Shipments\ShipmentsController;
use App\Http\Controllers\Tracking\TrackingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
