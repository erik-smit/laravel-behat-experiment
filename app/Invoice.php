<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    protected $fillable = [ 
        //'customer'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function lines()
    {
        return $this->hasMany('App\InvoiceLine');
    }
}
