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
    Route::post  ('/Addcategory'              , 'CategoryController@addCategory');
    Route::get   ('/categories'              , 'CategoryController@getCategory');
    Route::delete('/deletecategory/{id}'      , 'CategoryController@deleteCategory');
    Route::get   ('/editcategory/{id}'        , 'CategoryController@editCategory');
    Route::put  ('/updatecategory/{id}'      , 'CategoryController@updateCategory');



    //IncomesSource Routes
    Route::post  ('/AddSource'              , 'IncomeSourceController@addSource');
    Route::get   ('/income-sources'              , 'IncomeSourceController@getSource');
    Route::delete('/deleteincome-source/{id}'      , 'IncomeSourceController@deleteSource');
    Route::get   ('/editIncomesource/{id}'        , 'IncomeSourceController@editSource');
    Route::put  ('/updateIncomesource/{id}'      , 'IncomeSourceController@updateSource');

    //Test Route
    Route::get('/test', function () {
        return ['name'=>'nardine'];
        });

   //Expenses Route
    Route::post  ('add/expense'              , 'ExpenseController@addExpense');
    Route::get   ('/Expenses'              , 'ExpenseController@getFixedExpenses');
    Route::get   ('/ReccurentExpenses'              , 'ExpenseController@getReccurentExpenses');
    Route::delete('/deleteExpense/{id}'      , 'ExpenseController@deleteExpense');
    Route::get   ('getCount/expense','ExpenseController@getCount');
    Route::put  ('update/expense/{id}'      , 'ExpenseController@updateExpense');
    Route::get   ('edit/expense/{id}'        , 'ExpenseController@editExpense');

       //Expenses Route
       Route::post  ('/AddExpense'              , 'ExpenseController@add');
       Route::get   ('/GetExpenses'              , 'ExpenseController@get');
       Route::delete('/DeleteExpense/{id}'      , 'ExpenseController@delete');
       Route::get   ('/getCountExpense','ExpenseController@getCount');
       Route::put  ('/UpdateExpense/{id}'      , 'ExpenseController@update');
       Route::get   ('/EditExpense/{id}'        , 'ExpenseController@edit');

});


//login Routes
Route::post('/CreateAdmin', 'AdminsController@CreateAdmin');
Route::post('/login', 'AdminsController@login');
Route::post('/logout', 'AdminsController@logout');
//Get and Manage Admin
Route::get('/Admins', 'AdminsController@index');
Route::get('/getCount','AdminsController@getCount');
Route::get('/editAdmin/{id}','AdminsController@edit');
Route::put('/updateAdmin/{id}','AdminsController@updateAdmin');
Route::delete('/deleteAdmin/{id}','AdminsController@deleteAdmin');


//Test Route
