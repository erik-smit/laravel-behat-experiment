@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invoices</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="list-group">
                    @foreach ($invoices as $invoice)
                        <li class="list-group-item"><a href="{{ route('invoice-show', [ 'id' => $invoice->id ]) }}">{{ $invoice->id }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
