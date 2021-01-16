<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Models\Expense;

class ChartController extends Controller
{
public function sumFixedExpenses(){
$year = ['2020','2021'];
$data = [];
foreach ($year as $key => $value) {
$data[]=DB::select('SELECT DATE_FORMAT(date, "%Y") AS year, SUM(amount)As TotalsExpenses,category.name 
from expenses inner JOIN category on(expenses.category_id=category.id)
where expenses.status=1 and DATE_FORMAT(date, "%Y")='.$value.'
GROUP BY DATE_FORMAT(date, "%Y"),category_id');
}
 return $data;
}
}
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

*/