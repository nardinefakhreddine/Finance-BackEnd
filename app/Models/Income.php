<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{     protected $table      = 'incomes';
    protected $fillable   = ['title','description','amount','status','currency','date','startdate','enddate','source_id'];
    public    $timestamps = false;
    
    public function source(){
        return $this->belongsTo('App\Models\IncomeSource','source_id');
    }
}
