<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
        $customers = Customer::all();

        return view('customer/index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->validate([
            'companyname' => 'required|unique:customers',
            'contactname' => 'required',
            'contactmail' => 'required|email',
            'address' => 'required',
            'country' => 'required',
            'memo' => 'nullable',
        ]);

        $customer = Customer::create([
            'companyname' => $request['companyname'],
            'contactname' => $request['contactname'],
            'contactmail' => $request['contactmail'],
            'address' => $request['address'],
            'country' => $request['country'],
            'memo' => $request['memo']
        ]);

        return redirect(route('customer'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customer/show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customer/edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $request = $request->validate([
            'companyname' => 'required',
            'contactname' => 'required',
            'contactmail' => 'required|email',
            'address' => 'required',
            'country' => 'required',
            'memo' => 'nullable',
        ]);

        $customer->companyname = $request['companyname'];
        $customer->contactname = $request['contactname'];
        $customer->contactmail = $request['contactmail'];
        $customer->address = $request['address'];
        $customer->country = $request['country'];
        $customer->memo = $request['memo'];
        
        $customer->save();
        
        return redirect(route('customer-show', [ 'id' => $customer->id ]));
    }

    /**
     * Show the form for deleting the specified resource.
     */
    public function delete(Customer $customer)
    {
        return view('customer/delete', compact('customer'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect(route('customer'));
    }
}
