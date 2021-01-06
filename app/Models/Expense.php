<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{       protected $table      = 'expenses';
    protected $fillable   = ['title','description','amount','status','currency','date','startdate','enddate','category_id'];
    public    $timestamps = false;
    
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
}
