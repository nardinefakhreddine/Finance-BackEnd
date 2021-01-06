<?php

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


Route::group(['middleware'=>['jwt']],function(){
    //Categories Routes
    Route::post  ('add/category'              , 'CategoryController@addCategory');
    Route::get   ('get/category'              , 'CategoryController@getCategory');
    Route::delete('delete/category/{id}'      , 'CategoryController@deleteCategory');
    Route::get   ('edit/category/{id}'        , 'CategoryController@editCategory');
    Route::put  ('update/category/{id}'      , 'CategoryController@updateCategory');



    //IncomesSource Routes
    Route::post  ('add/income-source'              , 'IncomeSourceController@addSource');
    Route::get   ('get/income-source'              , 'IncomeSourceController@getSource');
    Route::delete('delete/income-source/{id}'      , 'IncomeSourceController@deleteSource');
    Route::get   ('edit/income-source/{id}'        , 'IncomeSourceController@editSource');
    Route::put  ('update/income-source/{id}'      , 'IncomeSourceController@updateSource');

    //Test Route
    Route::get('/test', function () {
        return ['name'=>'nardine'];
        });

   //Expenses Route
    Route::post  ('add/expense'              , 'ExpenseController@addExpense');
    Route::get   ('get/expense'              , 'ExpenseController@getExpenses');
    Route::delete('delete/expense/{id}'      , 'ExpenseController@deleteExpense');
    Route::get   ('getCount/expense','ExpenseController@getCount');
    Route::put  ('update/expense/{id}'      , 'ExpenseController@updateExpense');
    Route::get   ('edit/expense/{id}'        , 'ExpenseController@editExpense');

});


//login Routes
Route::post('/CreateAdmin', 'AdminsController@CreateAdmin');
Route::post('/login', 'AdminsController@login');
Route::post('/logout', 'AdminsController@logout');
Route::get('/getAdmin', 'AdminsController@getAdmin');
Route::get('/getCount','AdminsController@getCount');
Route::delete('/deleteAdmin/{id}','AdminsController@deleteAdmin');
Route::put('/updateAdmin/{id}','AdminsController@updateAdmin');

//Test Route
