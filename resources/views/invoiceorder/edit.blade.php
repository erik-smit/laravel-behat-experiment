@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit invoice order</div>

                <div class="card-body">
                <form method="POST" action="{{ route('invoiceorder-patch', [ 'id' => $invoiceOrder->id ]) }}" aria-label="{{ __('Register') }}">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row">
                            <label for="customer" class="col-md-4 col-form-label">{{ __('Customer') }}</label>

                            <div class="col-md-12">
                                <select id="customer" class="form-control{{ $errors->has('customer') ? ' is-invalid' : '' }}" name="customer">
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ ( $invoiceOrder->customer->id == $customer->id ? "selected":"") }}>{{ $customer->companyname }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('customer'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('customer') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <label for="product">{{ __('Product') }}</label>
                            </div>
                            <div class="form-group col-md-1">
                                <label for="number">Number</label>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="price">Price</label>
                            </div>
                        </div>
                        @foreach($invoiceOrder->lines as $line)
                        <div class="form-row">
                            <div class="form-group col-md-9">
                                <input id="product" type="text" class="form-control{{ $errors->has('product[]') ? ' is-invalid' : '' }}" name="product[]" value="{{ $line->product }}" autofocus>

                                @if ($errors->has('product[]'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('product') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <div class="form-group col-md-1">
                                <input id="number" type="text" class="form-control{{ $errors->has('number[]') ? ' is-invalid' : '' }}" name="number[]" value="{{ $line->number }}" autofocus>
                            </div>
                            <div class="form-group col-md-2">
                                <input id="price" type="text" class="form-control{{ $errors->has('price[]') ? ' is-invalid' : '' }}" name="price[]" value="{{ $line->price }}" autofocus>
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit invoice order') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
