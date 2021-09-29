<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/daily', 'DailyController@showCalendarView');
Route::post('/daily/date', 'DailyController@addDate');

Route::get('/report/{report}', 'DailyController@showReportView');

Route::post('/report/income/{report}', 'DailyController@submitIncome');
Route::post('/report/income/remove/{income}', 'DailyController@removeIncome');

Route::post('/report/expense/{report}', 'DailyController@submitExpense');
Route::post('/report/expense/remove/{expense}', 'DailyController@removeExpense');

Route::get('/debt', 'DebtsController@index');
Route::post('/debt/add', 'DebtsController@addDebt');
Route::post('/debt/remove/{debt}', 'DebtsController@removeDebt');

Route::get('/report', 'ReportingController@protocols');

Route::get('/test', function(){
    $date = \Carbon\Carbon::today()->subMonth();
    for($i = 0; $i < 365*5; $i ++) {
        App\Models\Day::firstOrCreate(['date' => $date]);
        $date = $date->addDay();
    }
});