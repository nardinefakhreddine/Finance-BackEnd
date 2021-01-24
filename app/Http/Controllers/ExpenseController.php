<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
 use App\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{

    public function get(){
        return Expense::with('category')->get();
    }
    public function index(){
        return Expense::with('category')->where('status',1)->paginate(5);
    }
    public function indexRec(){
        return Expense::with('category')->where('status',0)->paginate(5);
    }

    public function addExpense(ExpenseRequest $request){

        $expense=Expense::create([
            'title'        => $request->get('title'),
            'description' => $request->get('description'),
            'status'      => $request->get('status'),//fixed or reccurent
            'amount'       => $request->get('amount'),
            'date'        => $request->get('date'),
            'currency'     => $request->get('currency'),
            'reccurence'=>$request->get('reccurence'),
            'startdate'=>$request->get('startdate'),
            'enddate'=>$request->get('enddate'),
            'category_id' => $request->get('category_id'),
        ]
        );


        return response()->json(compact('expense'));
    }

    public function getFixedExpenses(){
        $expenses=Expense::where('status',1)->paginate(4);
        return response()->json($expenses);
    }
    public function getReccurentExpenses(){
        $expenses=Expense::where('status',0)->paginate(4);
        return response()->json($expenses);
    }
    public function editExpense($id){
        $expense=Expense::with('category')->find($id);
        return response()->json($expense);
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
