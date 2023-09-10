@extends('layouts.backoffice')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
    </div>

    <form method="POST" action="{{ route('update-user') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="mb-3">
            <label for="user-name" class="form-label">Name</label>
            <input value="{{ $user->name }}" name="name" required type="text" class="form-control" id="user-name">
            @if ($errors->has('name'))
                <span class="help-block text-center">
                    <strong style="color:red;font-size:12px;">{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="user-email" class="form-label">Email address</label>
            <input value="{{ $user->email }}" name="email" disabled type="email" class="form-control" id="user-email">
        </div>
        <div class="mb-3">
            <label for="user-role" class="form-label">Role</label>
            <select name="roleId" class="form-control">
                @foreach($role_options as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <a class="btn btn-secondary" type="button" href="{{ route('users') }}">Cancel</a>
        <button class="btn btn-primary" type="submit">Save</button>
        </form>
</div>
@endsection
