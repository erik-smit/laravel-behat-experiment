@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User</div>

                <div class="card-body">
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{ $user->name }}</dd>
                        <dt>E-mail</dt>
                        <dd>{{ $user->email }}</dd>
                        <dt>Role</dt>
                        <dd>{{ $user->role }}</dd>
                    </dl>

                    <a href="{{ route('user-edit', [ 'id' => $user->id ]) }}" class="btn btn-primary">Edit user</a>
                    <a href="{{ route('user-delete', [ 'id' => $user->id ]) }}" class="btn btn-primary">Delete user</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
