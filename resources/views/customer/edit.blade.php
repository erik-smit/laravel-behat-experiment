@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit customer</div>

                <div class="card-body">
                <form method="POST" action="{{ route('customer-patch', [ 'id' => $customer->id ]) }}" aria-label="{{ __('Register') }}">
                        @method('PATCH')
                        @csrf

                        <div class="form-group row">
                            <label for="companyname" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>

                            <div class="col-md-6">
                                <input id="companyname" type="text" class="form-control{{ $errors->has('companyname') ? ' is-invalid' : '' }}" name="companyname" value="{{ $customer->companyname }}" required autofocus>

                                @if ($errors->has('companyname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('companyname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contactname" class="col-md-4 col-form-label text-md-right">{{ __('Contact Name') }}</label>

                            <div class="col-md-6">
                                <input id="contactname" type="text" class="form-control{{ $errors->has('contactname') ? ' is-invalid' : '' }}" name="contactname" value="{{ $customer->contactname }}" required autofocus>

                                @if ($errors->has('contactname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contactname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contactmail" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="contactmail" type="email" class="form-control{{ $errors->has('contactmail') ? ' is-invalid' : '' }}" name="contactmail" value="{{ $customer->contactmail }}" required>

                                @if ($errors->has('contactmail'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contactmail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address">
                                    {{ $customer->address }}
                                </textarea>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <select id="country" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country">
                                    <option name="NL">NL</option>
                                    <option name="BE">BE</option>
                                </select>
                                @if ($errors->has('country'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="memo" class="col-md-4 col-form-label text-md-right">{{ __('Memo') }}</label>

                            <div class="col-md-6">
                                <textarea id="memo" class="form-control{{ $errors->has('memo') ? ' is-invalid' : '' }}" name="memo">
                                    {{ $customer->memo }}
                                </textarea>
                                @if ($errors->has('memo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('memo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Edit customer') }}
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
