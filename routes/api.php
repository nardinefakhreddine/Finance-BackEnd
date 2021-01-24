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
    Route::get   ('/category'              , 'CategoryController@index');
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
    Route::get('/getexp','ExpenseController@get');
    Route::get('/expenseRec','ExpenseController@indexRec');
    Route::post  ('/AddExpense'              , 'ExpenseController@addExpense');
    Route::get   ('/Expenses'              , 'ExpenseController@getFixedExpenses');
    Route::get   ('/ReccurentExpenses'              , 'ExpenseController@getReccurentExpenses');
    Route::delete('/deleteExpense/{id}'      , 'ExpenseController@deleteExpense');
    Route::get   ('/getCountExpense','ExpenseController@getCount');
    Route::put  ('/updateExpense/{id}'      , 'ExpenseController@updateExpense');
    Route::get   ('/editExpense/{id}'        , 'ExpenseController@editExpense');

       //IncomesRoute
       Route::post  ('/AddIncome'              , 'IncomeController@addIncome');

});
Route::get('/income','IncomeController@index');
Route::get('/getinc','IncomeController@get');
Route::get('/incomeRec','IncomeController@indexRec');
Route::post  ('/AddIncome'              , 'IncomeController@addIncome');
Route::get   ('/Expenses'              , 'IncomeController@getFixedExpenses');
Route::get   ('/ReccurentExpenses'              , 'IncomeController@getReccurentExpenses');
Route::delete('/deleteIncome/{id}'      , 'IncomeController@deleteIncome');
Route::get   ('/getCountExpense','IncomeController@getCount');
Route::put  ('/updateExpense/{id}'      , 'IncomeController@updateExpense');
Route::get   ('/editIncome/{id}'        , 'IncomeController@editExpense');

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
Route::get('/yearly','ChartController@ExpensesbyYear');
Route::post('/monthly','ChartController@ExpensesbyMonth');

Route::post('/weekly','ChartController@ExpensesbyWeek');
Route::get('/test','ChartController@yearly');