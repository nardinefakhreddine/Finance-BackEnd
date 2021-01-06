<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoalProfit extends Model
{
   
    protected $table      = 'goal_profits';
    protected $fillable   = ['company','amount','currency','startdate','enddate'];
    public    $timestamps = false;
}
