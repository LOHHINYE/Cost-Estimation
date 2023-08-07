<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\manageRolesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/roles', manageRolesController::class);

Route::get('/services/store', 'App\Http\Controllers\manageRolesController@service_store')->name('service_store');
Route::get('/events/store', 'App\Http\Controllers\manageRolesController@event_store')->name('event_store');
Route::get('/hotels/store', 'App\Http\Controllers\manageRolesController@hotel_store')->name('hotel_store');
Route::get('/infrastructures/store', 'App\Http\Controllers\manageRolesController@infrastructure_store')->name('infrastructure_store');
Route::get('/transportations/store', 'App\Http\Controllers\manageRolesController@transportation_store')->name('transportation_store');
Route::get('/marketings/store', 'App\Http\Controllers\manageRolesController@marketing_store')->name('marketing_store');

Route::get('/services/{id}/edit', 'App\Http\Controllers\manageRolesController@edit_services')->name('edit_services');
Route::get('/events/{id}/edit', 'App\Http\Controllers\manageRolesController@edit_event')->name('edit_event');
Route::get('/hotels/{id}/edit', 'App\Http\Controllers\manageRolesController@edit_hotel')->name('edit_hotel');
Route::get('/infrastructures/{id}/edit', 'App\Http\Controllers\manageRolesController@edit_infrastructures')->name('edit_infrastructures');
Route::get('/transportations/{id}/edit', 'App\Http\Controllers\manageRolesController@edit_transportation')->name('edit_transportation');
Route::get('/marketings/{id}/edit', 'App\Http\Controllers\manageRolesController@edit_market')->name('edit_market');

Route::get('/services/{id}/update', 'App\Http\Controllers\manageRolesController@update_services')->name('update_services');
Route::get('/events/{id}/update', 'App\Http\Controllers\manageRolesController@update_event')->name('update_event');
Route::get('/hotels/{id}/update', 'App\Http\Controllers\manageRolesController@update_hotel')->name('update_hotel');
Route::get('/infrastructures/{id}/update', 'App\Http\Controllers\manageRolesController@update_infrastructures')->name('update_infrastructures');
Route::get('/transportations/{id}/update', 'App\Http\Controllers\manageRolesController@update_transportation')->name('update_transportation');
Route::get('/marketings/{id}/update', 'App\Http\Controllers\manageRolesController@update_market')->name('update_market');

Route::delete('/services/destroy/{id}', 'App\Http\Controllers\manageRolesController@service_destroy')->name('service_destroy');
Route::delete('/events/destroy/{id}', 'App\Http\Controllers\manageRolesController@event_destroy')->name('event_destroy');
Route::delete('/hotels/destroy/{id}', 'App\Http\Controllers\manageRolesController@hotel_destroy')->name('hotel_destroy');
Route::delete('/infrastructures/destroy/{id}', 'App\Http\Controllers\manageRolesController@infrastructure_destroy')->name('infrastructure_destroy');
Route::delete('/transportations/destroy/{id}', 'App\Http\Controllers\manageRolesController@transportation_destroy')->name('transportation_destroy');
Route::delete('/marketings/destroy/{id}', 'App\Http\Controllers\manageRolesController@marketing_destroy')->name('marketing_destroy');

Route::post('company/update', 'App\Http\Controllers\manageRolesController@update_company_profit')->name('company.update');

Route::get('/costestimation', 'App\Http\Controllers\QuotationController@costestimation')->name('costestimation');
Route::post('/cost-estimation', [QuotationController::class, 'cost_estimation_save'])->name('cost-estimation-save');
Route::post('/cost-estimation/update/{id}', [QuotationController::class, 'cost_estimation_update'])->name('cost-estimation-update');
Route::get('/cost/{id}/edit', 'App\Http\Controllers\QuotationController@edit')->name('cost-estimation-edit');
Route::get('/search', 'App\Http\Controllers\QuotationController@search_company')->name('search_quotation');


Route::delete('/cost/{id}', 'App\Http\Controllers\QuotationController@destroy')->name('cost-estimation-destroy');
