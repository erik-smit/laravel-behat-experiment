@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Customer</div>

                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Companyname</dt>
                        <dd class="col-sm-10" id="companynamefield">{{ $customer->companyname }}</dd>
                        <dt class="col-sm-4">Contact name</dt>
                        <dd class="col-sm-10" id="contactnamefield">{{ $customer->contactname }}</dd>
                        <dt class="col-sm-4">Contact mail</dt>
                        <dd class="col-sm-10" id="contactmailfield">{{ $customer->contactmail }}</dd>
                        <dt class="col-sm-4">Address</dt>
                        <dd class="col-sm-10" id="addressfield">{{ $customer->address }}</dd>
                        <dt class="col-sm-4">Country</dt>
                        <dd class="col-sm-10" id="countryfield">{{ $customer->country }}</dd>
                        <dt class="col-sm-4">Memo</dt>
                        <dd class="col-sm-10" id="memofield">{{ $customer->memo }}</dd>
                    </dl>

                    <a href="{{ route('customer-edit', [ 'id' => $customer->id ]) }}" class="btn btn-primary">Edit customer</a>
                    <a href="{{ route('customer-delete', [ 'id' => $customer->id ]) }}" class="btn btn-primary">Delete customer</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
