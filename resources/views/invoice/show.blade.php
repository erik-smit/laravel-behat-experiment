@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invoice</div>

                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-2">Company</dt>
                        <dd class="col-sm-10" id="companyfield">{{ $invoice->customer->companyname }}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-8">Product</dt>
                        <dt class="col-sm-2">Number</dt>
                        <dt class="col-sm-2">Price</dt>
                    </dl>
                    @foreach($invoice->lines as $line)
                    <dl class="row">
                        <dd class="col-sm-8" id="companyfield">{{ $line->product }}</dd>
                        <dd class="col-sm-2" id="companyfield">{{ $line->number }}</dd>
                        <dd class="col-sm-2" id="companyfield">{{ $line->price }}</dd>
                    </dl>
                    @endforeach

                    <a href="{{ route('invoice-showPDF', [ 'invoice' => $invoice->id ]) }}" class="btn btn-primary">Download invoice as PDF</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
