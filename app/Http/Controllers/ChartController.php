<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Models\Expense;

class ChartController extends Controller
{
public function ExpensesbyYear(Request $request){
    $year=['2019','2020','2021','2022','2023'];
    $data=[];
    foreach ($year as $key => $value) {    
    $data[]=DB::select('SELECT SUM(amount)As TotalsExpenses,category.name,'.$value.' as year
    from expenses
    inner JOIN category on(expenses.category_id=category.id)
    where (expenses.status=1 and DATE_FORMAT(date, "%Y")='.$value.')
    or (expenses.status=0    and '.$value.' between DATE_FORMAT(startdate, "%Y") and DATE_FORMAT(enddate, "%Y"))
    GROUP BY category_id
    order by category.name desc
    ');
    }
    /*
    $data = Income::where('status', 1)->where('date',  '>', $year . ' /01/01')->where('date',  '<', $year . ' /12/31')
    ->with('category')->get();
    $data = Income::where('status', 1)->where('date',  '>', $year . ' /01/01')
    ->where('date',  '<', $year . ' /12/31')->with('category')->get() 
    Document::Where('some_condition',true)
   ->select([DB::raw("SUM(debit) as total_debit"), DB::raw("SUM(credit) as total_credit")])
   ->groupBy('id')
   ->get() */
  /*$years=array();
   $categories=array();
   $total=array();
   for ($i=0;$i<count($data);$i++){
    for ($j=0;$j<count($data[$i]);$j++){
     array_push($years,$data[$i][$j]->year);
     array_push($categories,$data[$i][$j]->name);
     array_push($total,$data[$i][$j]->TotalsExpenses);
    }
}
return response()->json([
    'Years'=>$years,
    'category'=>$categories,
    'total'=>$total

]);*/
return $data;
}



 

public function ExpensesbyMonth(Request $request){
     $month=[1,2,3,4,5,6,7,8,9,10,11,12];
     $year=$request->year;
    $data=[];
    foreach ($month as $key => $value) {
    $data[]=DB::select('SELECT SUM(amount)As TotalsExpenses,category.name,'.$value.' as month
    from expenses
    inner JOIN category on(expenses.category_id=category.id)
    where (expenses.status=1 and Month(date)='.$value.' and Year(date)='.$year.')
    or
    (expenses.status=0 and '.$value.' between Month(startdate) and Month(enddate)   and '.$year.'  between DATE_FORMAT(startdate, "%Y") and DATE_FORMAT(enddate, "%Y"))
    
    
    
    GROUP BY category_id
    
   
    ');

    }
   

 return response()->json($data);
}


public function ExpensesbyWeek(Request $request){
   
        
    $year = $request->year;
   $month = $request->month;

    $date = Carbon::createFromDate($year,$month);
    $numberOfWeeks = floor($date->daysInMonth / Carbon::DAYS_PER_WEEK);
    
    $data=[];
    $j=1;
    for ($i=1; $i <= $date->daysInMonth ; $i++) {
        Carbon::createFromDate($year,$month,$i); 
        $start= Carbon::createFromDate($year,$month,$i)->startOfWeek()->toDateString();
        $end= Carbon::createFromDate($year,$month,$i)->endOfweek()->toDateString();
//SQL QUERY using the start date and the end date
            $data[]=DB::select('SELECT SUM(amount)As TotalsExpenses,category.name 
            from expenses
            inner JOIN category on(expenses.category_id=category.id)
            where (expenses.status=1  and expenses.date between "'.$start.'" and "'.$end.'")
            or (expenses.status=0 and ("'.$start.'" between expenses.startdate and  expenses.enddate  or "'.$end.'" between expenses.startdate  and expenses.enddate))
            GROUP BY category_id ');
        
        $i+=7;
        $j++; 
    }

    return  response()->json($data);

    
   

}

public function yearly(){
    $category = DB::table('category')->get();
    $categories=[];
    foreach ($category as $cat) {
       array_push($categories,$cat->id);
    }
    $data=[];
    $year=['2019','2020','2021','2022','2023'];
    
        foreach($year as $value){
            $data[]=DB::select('SELECT SUM(amount)As TotalsExpenses
    from expenses
    where(status=1 and category_id=1 and Year(date)='.$value.')
      or 
      (status=0 and category_id= 1 and '.$value.' between Year(startdate) and Year(enddate))
 
    ');
           
        }
    
   return $data;

}


}


//SELECT amount*DATEDIFF(enddate,startdate)AS amount, FROM `expenses`
/*
SELECT DATE_FORMAT(date, "%Y-%M") AS Month , SUM(amount)As TotalsExpenses from expenses where expenses.status=1 GROUP BY DATE_FORMAT(date, "%Y-%M")

*/ /*


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


/*
https://www.digitalocean.com/community/tutorials/easier-datetime-in-laravel-and-php-with-carbon
$now = Carbon::now();
$weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
$weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');

$data = Income::where('status', 1)->where('date',  '>', $weekStartDate )->
where('date',  '<', weekEndDate )->with('category')->get()

 $current = new Carbon();
    $today = Carbon::today();
    $newYear = new Carbon('first day of January 2016');

    $date = Carbon::createFromDate(2020,12);
    $numberOfWeeks = floor($date->daysInMonth / Carbon::DAYS_PER_WEEK);
    $dayofmonth=$date->daysInMonth ;
    $start= Carbon::createFromDate(2020,12,1)->startOfWeek()->toDateString();
    $end= Carbon::createFromDate(2020,12,1)->endOfweek()->format('Y-m-d');
    $now = Carbon::now();
    return $now;


*/