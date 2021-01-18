<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Models\Expense;

class ChartController extends Controller
{
public function ExpensesbyYear(Request $request){
    $year=['2018','2019','2020','2021','2022'];
  
    $data=[];
    foreach ($year as $key => $value) {
    $data[]=DB::select('SELECT SUM(amount)As TotalsExpenses,category.name 
    from expenses
    inner JOIN category on(expenses.category_id=category.id)
    where (expenses.status=1 and DATE_FORMAT(date, "%Y")='.$value.')
    or (expenses.status=0 and   expenses.reccurence="yearly"  and '.$value.' between DATE_FORMAT(startdate, "%Y") and DATE_FORMAT(enddate, "%Y"))
    GROUP BY category_id
    
   
    ');
    }

 return response()->json(compact('data'));
}
public function ExpensesbyMonth(Request $year){
    $month=[1,2,3,4,5,6,7,8,9,10,11,12];
     $year=2020;
    $data=[];
    foreach ($month as $key => $value) {
    $data[]=DB::select('SELECT SUM(amount)As TotalsExpenses,category.name 
    from expenses
    inner JOIN category on(expenses.category_id=category.id)
    where (expenses.status=1 and Month(date)='.$value.' and Year(date)='.$year.')
    or (expenses.status=0 and   expenses.reccurence="monthly"  and '.$value.' between Month(startdate) and Month(enddate)
    and '.$year.' between Year(startdate) and Year(enddate)
    
    )
    GROUP BY category_id
    
   
    ');
    }

 return response()->json(compact('data'));
}





}

//SELECT amount*DATEDIFF(enddate,startdate)AS amount, FROM `expenses`
/*
SELECT DATE_FORMAT(date, "%Y-%M") AS Month , SUM(amount)As TotalsExpenses from expenses where expenses.status=1 GROUP BY DATE_FORMAT(date, "%Y-%M")

*/ /*
SELECT DATE_FORMAT(date, "%Y-%M") AS Month, SUM(column name) as column name
FROM <table name>
WHERE inverter = "1" AND DATE_FORMAT(date, "%Y-%M") BETWEEN "2017-February" AND 
"2017-March"
GROUP BY DATE_FORMAT(date, "%Y-%M");

DATE_FORMAT(date, "%Y-%m") BETWEEN "2017-02" AND "2017-03"

use case
SELECT OrderID, Quantity,
CASE
    WHEN Quantity > 30 THEN 'The quantity is greater than 30'
    WHEN Quantity = 30 THEN 'The quantity is 30'
    ELSE 'The quantity is under 30'
END AS QuantityText
FROM OrderDetails;


SELECT DATE_FORMAT(date, "%Y") AS year,SUM(amount)As TotalsExpenses,category.name 
from expenses
inner JOIN category on(expenses.category_id=category.id)
where DATE_FORMAT(date, "%Y") in('2020','2021') 
or DATE_FORMAT(date, "%Y") BETWEEN DATE_FORMAT(enddate, "%Y") AND DATE_FORMAT(startdate, "%Y")
and DATE_FORMAT(enddate, "%Y") IN('2020','2021') 
and DATE_FORMAT(startdate,"%Y") IN('2020','2021')
GROUP BY DATE_FORMAT(date, "%Y"),category_id


/*$year = ['2020','2021'];
$data = [];
foreach ($year as $key => $value) {
$data[]=DB::select('SELECT DATE_FORMAT(date, "%Y") AS year, SUM(amount)As TotalsExpenses,category.name 
from expenses inner JOIN category on(expenses.category_id=category.id)
where expenses.status=1 and DATE_FORMAT(date, "%Y")='.$value.'
GROUP BY DATE_FORMAT(date, "%Y"),category_id');
}*/


