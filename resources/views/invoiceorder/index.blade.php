@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New invoice order</div>

                <div class="card-body">
                    <a href="{{ route('invoiceorder-create') }}" class="btn btn-primary">Create new invoice order</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Invoice orders</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="list-group">
                    @foreach ($invoiceorders as $invoiceorder)
                        <li class="list-group-item"><a href="{{ route('invoiceorder-show', [ 'id' => $invoiceorder->id ]) }}">{{ $invoiceorder->id }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
