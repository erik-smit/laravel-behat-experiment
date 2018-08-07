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
                        <dd class="col-sm-10">{{ $user->name }}</dd>
                        <dt class="col-sm-2">E-mail</dt>
                        <dd class="col-sm-10">{{ $user->email }}</dd>
                        <dt class="col-sm-2">Role</dt>
                        <dd class="col-sm-10">{{ $user->role }}</dd>
                    </dl>

                    <a href="{{ route('user-edit', [ 'id' => $user->id ]) }}" class="btn btn-primary">Edit user</a>
                    <a href="{{ route('user-delete', [ 'id' => $user->id ]) }}" class="btn btn-primary">Delete user</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
