<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
 use App\Http\Requests\ExpenseRequest;

class IncomeController extends Controller
{
   
    public function add(ExpenseRequest $request){

        $income=Income::create([
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


        return response()->json(compact('income'));
    }

    public function get(){
        $incomes=Income::orderBy('id','desc')->paginate(5);
        return response()->json(compact('incomes'));
    }
    public function edit($id){
        $income=Income::find($id);
        return response()->json(compact('income'));
    }

    public function update(ExpenseRequest  $request,$id){
        
        $income=Income::find($id);

        $income->title        = $request->title;
        $income->description = $request->description;
        $income->status      = $request->status;
        $income->amount       = $request->amount;
        $income->currency      = $request->currency;
        $income->category_id = $request->category_id;
        

        $income->save();
        
        return response()->json(compact('income'));
    }

  public function getCount(){
      $income=Income::all();
      $incomesCount=$income->count();
      return response()->json(compact('incomesCount'));
  }
    public function delete($id){
        $income=Income::find($id);
        $income->delete();
    }

}
