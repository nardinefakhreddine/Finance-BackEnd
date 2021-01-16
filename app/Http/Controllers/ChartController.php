<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Models\Expense;

class ChartController extends Controller
{
   public function sumFixedExpenses(){

$fixed=DB::select('SELECT DATE_FORMAT(date, "%Y") AS year, SUM(amount)As TotalsExpenses,category.name from expenses inner JOIN category on(expenses.category_id=category.id)where expenses.status=1 GROUP BY DATE_FORMAT(date, "%Y"),category_id');

 return response()->json($fixed);
}
}
/*
SELECT DATE_FORMAT(date, "%Y-%M") AS Month , SUM(amount)As TotalsExpenses from expenses where expenses.status=1 GROUP BY DATE_FORMAT(date, "%Y-%M")

*/ 