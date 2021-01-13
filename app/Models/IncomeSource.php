<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeSource extends Model
{
    protected $table      = 'incomes_source';
    protected $fillable   = ['name','description','photo'];
    public    $timestamps = false;

  public function incomes(){
        return $this->hasMany('App\Models\Income','source_id');
    }
}
