<?php

namespace App\Http\Controllers;

use App\GoalProfit;
use Illuminate\Http\Request;
use App\Models\Profit;
class GoalProfitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profit=Profit::get();
        return $profit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $profit=Profit::create([
        'company'        => $request->get('company'),
        'amount' => $request->get('amount'),
        'currency'      => $request->get('currency'),//fixed or reccurent
        'amount'       => $request->get('amount'),
        'startdate'=>$request->get('startdate'),
        'enddate'=>$request->get('enddate'),
       ]);
       return response()->json($profit);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GoalProfit  $goalProfit
     * @return \Illuminate\Http\Response
     */
    public function show(GoalProfit $goalProfit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GoalProfit  $goalProfit
     * @return \Illuminate\Http\Response
     */
    public function edit(GoalProfit $goalProfit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GoalProfit  $goalProfit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoalProfit $goalProfit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GoalProfit  $goalProfit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $profit=Profit::find($id)->delete();
         return response()->json(['succesDelete']);
    }
}
