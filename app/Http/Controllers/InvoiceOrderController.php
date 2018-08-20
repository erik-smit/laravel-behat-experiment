<?php

namespace App\Http\Controllers;

use App\Customer;
use App\InvoiceOrder;
use App\InvoiceOrderLine;
use Illuminate\Http\Request;

class InvoiceOrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoiceorders = InvoiceOrder::all();

        return view('invoiceorder/index', compact('invoiceorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::get();
        return view('invoiceorder/create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoiceOrder = new InvoiceOrder;
       
        $customer = Customer::find($request['customer']);
        $invoiceOrder->customer()->associate($customer);
        $invoiceOrder->save();

        foreach($request['product'] as $index => $product) {
            if ($product == "")
                continue;
            $invoiceOrderLine = new InvoiceOrderLine;
            
            $invoiceOrderLine->invoiceOrder()->associate($invoiceOrder);
            $invoiceOrderLine->product = $request['product'][$index];
            $invoiceOrderLine->number = $request['number'][$index];
            $invoiceOrderLine->price = $request['price'][$index];

            $invoiceOrderLine->save();
        }

        return redirect(route('invoiceorder-show', [ 'invoiceOrder' => $invoiceOrder->id ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvoiceOrder  $invoiceOrder
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceOrder $invoiceOrder)
    {
        return view('invoiceorder/show', compact('invoiceOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoiceOrder  $invoiceOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceOrder $invoiceOrder)
    {
        $customers = Customer::get();
        return view('invoiceorder/edit', compact('customers', 'invoiceOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceOrder  $invoiceOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceOrder $invoiceOrder)
    {
        $customer = Customer::find($request['customer']);
        $invoiceOrder->customer()->associate($customer);
        $invoiceOrder->save();

        $invoiceOrder->lines()->delete();
        
        foreach($request['product'] as $index => $product) {
            if ($product == "")
                continue;
            $invoiceOrderLine = new InvoiceOrderLine;
            
            $invoiceOrderLine->invoiceOrder()->associate($invoiceOrder);
            $invoiceOrderLine->product = $request['product'][$index];
            $invoiceOrderLine->number = $request['number'][$index];
            $invoiceOrderLine->price = $request['price'][$index];

            $invoiceOrderLine->save();
        }

        return redirect(route('invoiceorder-show', [ 'invoiceOrder' => $invoiceOrder->id ]));
    }

    /**
     * Process Invoice Order into Invoice
     */
    public function process(Request $request)
    {
        $invoiceOrder = InvoiceOrder::find($request['invoiceOrder']);
        $invoice = $invoiceOrder->processOrder();

        return redirect(route('invoice-show', [ 'invoice' => $invoice->id ]));
    }


    /**
     * Show the form for deleting the specified resource.
     */
    public function delete(InvoiceOrder $invoiceOrder)
    {
        return view('invoiceorder/delete', compact('invoiceOrder'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceOrder  $invoiceOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceOrder $invoiceOrder)
    {
        $invoiceOrder->delete();
        return redirect(route('invoiceorder'));
    }
}
