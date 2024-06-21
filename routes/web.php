<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardHighlightController;
use App\Http\Controllers\DashboardFeatureController;
use App\Http\Controllers\DashboardMeasurementController;
use App\Http\Controllers\DashboardLocationController;
use App\Http\Controllers\DashboardMapController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard1Controller;
use App\Http\Controllers\Dashboard2Controller;
use App\Http\Controllers\Dashboard3Controller;
use App\Http\Controllers\Dashboard2LocationController;
use App\Http\Controllers\Dashboard3LocationController;
use App\Http\Controllers\Dashboard2MeasurementController;
use App\Http\Controllers\Dashboard3MeasurementController;
use App\Http\Controllers\TableGuidelineController;
use Illuminate\Routing\Route as RoutingRoute;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware('auth');

// Route::prefix('/dashboard')->group(function () {
//     Route::get('/', function () {
//         return view('dashboard.index');
//     })->name('dashboard')->middleware('auth');
//     Route::get('/getLocationDetails/{idLocation}', [DashboardMeasurementController::class, 'getLocationDetails']);
//     Route::get('/getLocationDetails/{idLocation}', [Dashboard2MeasurementController::class, 'getLocationDetails']);
//     Route::get('/getLocationDetails/{idLocation}', [Dashboard3MeasurementController::class, 'getLocationDetails']);
//     Route::resource('/measurement', DashboardMeasurementController::class)->middleware('admin');
//     Route::resource('/location', DashboardLocationController::class)->middleware('admin');
//     Route::resource('/feature', DashboardFeatureController::class)->middleware('admin');
//     Route::resource('/testimonial', DashboardTestimonialController::class)->middleware('admin');
//     Route::resource('/map', DashboardMapController::class)->middleware('auth');
//     Route::resource('/highlight', DashboardHighlightController::class)->middleware('admin');
//     Route::resource('', DashboardController::class)->middleware('auth');
//     Route::resource('/dashboard-1', Dashboard1Controller::class)->middleware('auth');
//     Route::resource('/dashboard-2', Dashboard2Controller::class)->middleware('auth');
//     Route::resource('/measurement-2', Dashboard2MeasurementController::class)->middleware('admin');
//     Route::resource('/measurement-3', Dashboard3MeasurementController::class)->middleware('admin');
//     Route::resource('/location-2', Dashboard2LocationController::class)->middleware('admin');
//     Route::resource('/location-3', Dashboard3LocationController::class)->middleware('admin');
//     Route::resource('/dashboard-3', Dashboard3Controller::class)->middleware('admin');
//     Route::resource('/table-guideline', TableGuidelineController::class)->middleware('admin');
    
// });

Route::prefix('/dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('dashboard')->middleware('auth');
    Route::get('/getLocationDetails/{idLocation}', [DashboardMeasurementController::class, 'getLocationDetails']);
    Route::get('/getLocationDetails/{idLocation}', [Dashboard2MeasurementController::class, 'getLocationDetails']);
    Route::get('/getLocationDetails/{idLocation}', [Dashboard3MeasurementController::class, 'getLocationDetails']);
    Route::resource('/measurement', DashboardMeasurementController::class)->middleware('guest');
    Route::resource('/location', DashboardLocationController::class)->middleware('guest');
    Route::resource('/map', DashboardMapController::class)->middleware('guest');
    Route::resource('', DashboardController::class)->middleware('guest');
    Route::resource('/dashboard-1', Dashboard1Controller::class)->middleware('guest');
    Route::resource('/dashboard-2', Dashboard2Controller::class)->middleware('guest');
    Route::resource('/measurement-2', Dashboard2MeasurementController::class)->middleware('guest');
    Route::resource('/measurement-3', Dashboard3MeasurementController::class)->middleware('guest');
    Route::resource('/location-2', Dashboard2LocationController::class)->middleware('guest');
    Route::resource('/location-3', Dashboard3LocationController::class)->middleware('guest');
    Route::resource('/dashboard-3', Dashboard3Controller::class)->middleware('guest');
    Route::resource('/table-guideline', TableGuidelineController::class)->middleware('guest');
    
});
