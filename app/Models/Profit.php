<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    protected $table      = 'profits';
    protected $fillable   = ['company','amount','currency','startdate','enddate'];
    public    $timestamps = false;
}
