@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Are you sure you which to delete user "{{ $user->name }}"?</div>

                <div class="card-body">
                <form method="POST" action="{{ route('user-destroy', [ 'id' => $user->id ]) }}" aria-label="{{ __('Destroy') }}">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Delete user') }}
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
