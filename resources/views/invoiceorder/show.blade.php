@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invoice Order</div>

                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-2">Company</dt>
                        <dd class="col-sm-10" id="companyfield">{{ $invoiceOrder->customer->companyname }}</dd>
                        <dt class="col-sm-8">Product</dt>
                        <dt class="col-sm-2">Number</dt>
                        <dt class="col-sm-2">Price</dt>
                        @foreach($invoiceOrder->lines as $line)
                        <dd class="col-sm-8" id="companyfield">{{ $line->product }}</dd>
                        <dd class="col-sm-2" id="companyfield">{{ $line->number }}</dd>
                        <dd class="col-sm-2" id="companyfield">{{ $line->price }}</dd>
                        @endforeach
                    </dl>

                    <a href="{{ route('invoiceorder-edit', [ 'id' => $invoiceOrder->id ]) }}" class="btn btn-primary">Edit invoice order</a>
                    <a href="{{ route('invoiceorder-delete', [ 'id' => $invoiceOrder->id ]) }}" class="btn btn-primary">Delete invoice order</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
