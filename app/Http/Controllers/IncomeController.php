<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
 use App\Http\Requests\ExpenseRequest;

class IncomeController extends Controller
{
    public function get(){
        return Income::with('source')->get();
    }
    public function index(){
        return Income::with('source')->where('status',1)->paginate(5);
    }
    public function indexRec(){
        return Income::with('source')->where('status',0)->paginate(5);
    }

    public function addIncome(Request $request){

        $income=Income::create([
            'title'        => $request->get('title'),
            'description' => $request->get('description'),
            'status'      => $request->get('status'),//fixed or reccurent
            'amount'       => $request->get('amount'),
            'date'        => $request->get('date'),
            'currency'     => $request->get('currency'),
            'reccurence'=>$request->get('reccurence'),
            'startdate'=>$request->get('startdate'),
            'enddate'=>$request->get('enddate'),
            'source_id' => $request->get('source_id'),
        ]
        );


        return response()->json($income);
    }

    public function getFixedIncomes(){
        $$income=Income::where('status',1)->paginate(4);
        return response()->json($income);
    }
    public function getReccurentIncomes(){
        $income=Income::where('status',0)->paginate(4);
        return response()->json($income);
    }
    public function editIncome($id){
        $income=Income::with('category')->find($id);
        return response()->json($income);
    }

    public function updateIncome(ExpenseRequest  $request,$id){
        
        $income=Income::find($id);

        $income->title        = $request->title;
        $income->description = $request->description;
        $income->status      = $request->status;
        $income->amount       = $request->amount;
        $income->currency      = $request->currency;
        $income->category_id = $request->category_id;
        

        $income->save();
        
        return response()->json($income);
    }

  public function getCount(){
      $income=Income::all();
      $incomeCount=$expense->count();
      return response()->json($incomeCount);
  }
    public function deleteIncome($id){
        $income=Income::find($id);
        $income->delete();
    }


}
