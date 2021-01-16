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

   

   //Expenses Route
    Route::get('/expense','ExpenseController@index');
    Route::get('/expenseRec','ExpenseController@indexRec');
    Route::post  ('/AddExpense'              , 'ExpenseController@addExpense');
    Route::get   ('/Expenses'              , 'ExpenseController@getFixedExpenses');
    Route::get   ('/ReccurentExpenses'              , 'ExpenseController@getReccurentExpenses');
    Route::delete('/deleteExpense/{id}'      , 'ExpenseController@deleteExpense');
    Route::get   ('/getCountExpense','ExpenseController@getCount');
    Route::put  ('/updateExpense/{id}'      , 'ExpenseController@updateExpense');
    Route::get   ('/editExpense/{id}'        , 'ExpenseController@editExpense');

       //IncomesRoute
       Route::post  ('/AddIncome'              , 'IncomeController@add');
       Route::get   ('/GetIncome'              , 'IncomeController@get');
       Route::delete('/DeleteIncome/{id}'      , 'IncomeController@delete');
       Route::get   ('/getCountIncome','IncomeController@getCount');
       Route::put  ('/UpdateIncome/{id}'      , 'IncomeController@update');
       Route::get   ('/EditIncome/{id}'        , 'IncomeController@edit');

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




//Goal profit
Route::get('/profitGoal','GoalProfitController@index');
Route::post('/InsertProfit','GoalProfitController@store');
Route::delete('/delete/{id}','GoalProfitController@destroy');
//Chart Route
Route::get('/Sum','ChartController@ExpensesbyYear');
