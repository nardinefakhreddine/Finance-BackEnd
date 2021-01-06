<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
 use App\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{
    public function addExpense(ExpenseRequest $request){

        $expense=Expense::create([
            'title'        => $request->get('title'),
            'description' => $request->get('description'),
            'status'      => $request->get('status'),//fixed or reccurent
            'amount'       => $request->get('amount'),
            'date'        => now(),
            'currency'     => $request->get('currency'),
            'startdate'=>$request->get('startdate'),
            'enddate'=>$request->get('enddate'),
            'category_id' => $request->get('category_id'),
        ]
        );


        return response()->json(compact('expense'));
    }

    public function getExpenses(){
        $expenses=Expense::orderBy('id','desc')->paginate(5);
        return response()->json(compact('expenses'));
    }
    public function editExpense($id){
        $expense=Expense::find($id);
        return response()->json(compact('expense'));
    }

    public function updateExpense(ExpenseRequest  $request,$id){
        
        $expense=Expense::find($id);

        $expense->title        = $request->title;
        $expense->description = $request->description;
        $expense->status      = $request->status;
        $expense->amount       = $request->amount;
        $expense->currency      = $request->currency;
        $expense->category_id = $request->category_id;
        

        $expense->save();
        
        return response()->json(compact('expense'));
    }

  public function getCount(){
      $expense=Expense::all();
      $expenseCount=$expense->count();
      return response()->json(compact('expenseCount'));
  }
    public function deleteExpense($id){
        $expense=Expense::find($id);
        $expense->delete();
    }

}
