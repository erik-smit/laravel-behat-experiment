<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\InvoiceLine;

class InvoiceOrder extends Model
{
    protected $fillable = [ 
        'customer'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function lines()
    {
        return $this->hasMany('App\InvoiceOrderLine');
    }

    public function processOrder()
    {
        $invoice = new Invoice;

        $invoice->customer()->associate($this->customer);
        $invoice->save();

        foreach($this->lines as $line) {
            $invoiceLine = new InvoiceLine;
            
            $invoiceLine->invoice()->associate($invoice);
            $invoiceLine->product = $line->product;
            $invoiceLine->number = $line->number;
            $invoiceLine->price = $line->price;

            $invoiceLine->save();
        }

        $this->delete();

        return $invoice;
    }
}