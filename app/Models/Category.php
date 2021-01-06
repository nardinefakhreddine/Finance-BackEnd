<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table      = 'category';
    protected $fillable   = ['name','description','photo'];
    public    $timestamps = false;

    public function expenses(){
        return $this->hasMany('App\Models\Expense','category_id');
    }
}