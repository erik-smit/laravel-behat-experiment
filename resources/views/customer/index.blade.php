@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New customer</div>

                <div class="card-body">
                    <a href="{{ route('customer-create') }}" class="btn btn-primary">Create new customer</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Customers</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="list-group">
                    @foreach ($customers as $customer)
                        <li class="list-group-item"><a href="{{ route('customer-show', [ 'id' => $customer->id ]) }}">{{ $customer->companyname }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
