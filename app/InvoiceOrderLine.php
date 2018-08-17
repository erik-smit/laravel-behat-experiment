<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceOrderLine extends Model
{
    protected $fillable =[
        'product',
        'number',
        'price',
    ];

    public function invoiceOrder()
    {
        return $this->belongsTo('App\InvoiceOrder');
    }
}
