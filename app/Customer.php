<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [ 
        'companyname',
        'contactname',
        'contactmail',
        'address',
        'country',
        'memo'
    ];

}
