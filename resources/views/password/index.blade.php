@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User</div>

                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-2">Name</dt>
                        <dd class="col-sm-10" id="namefield">{{ $user->name }}</dd>
                        <dt class="col-sm-2">E-mail</dt>
                        <dd class="col-sm-10" id="emailfield">{{ $user->email }}</dd>
                        <dt class="col-sm-2">Role</dt>
                        <dd class="col-sm-10" id="rolefield">{{ $user->role }}</dd>
                    </dl>

                    <a href="{{ route('password-edit') }}" class="btn btn-primary">Change password</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
