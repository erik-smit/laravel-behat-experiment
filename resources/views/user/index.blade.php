@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New user</div>

                <div class="card-body">
                    <a href="{{ route('user-create') }}" class="btn btn-primary">Create new user</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="list-group">
                    @foreach ($users as $user)
                        <li class="list-group-item"><a href="{{ route('user-show', [ 'id' => $user->id ]) }}">{{ $user->name }}</a></li>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
