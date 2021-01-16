<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Models\Expense;

class ChartController extends Controller
{
   public function sumFixedExpenses(){

$fixed=DB::select('SELECT sum(amount)as totalExpenses , category.name from expenses INNER JOIN category on(expenses.category_id=category.id and expenses.status=1) GROUP by(category_id)');

 return $fixed;
}
}
/*
SELECT sum(amount)as totalExpenses , category.name from expenses INNER JOIN category on(expenses.category_id=category.id and expenses.status=1) GROUP by(category_id)
*/ 