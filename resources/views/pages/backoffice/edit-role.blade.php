@extends('layouts.backoffice')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Role</h1>
    </div>

    <form method="POST" action="{{ route('update-role') }}">
        @csrf
        <input type="hidden" name="id" value="{{ $role->id }}">
        <div class="mb-3">
            <label for="role-name" class="form-label">Name</label>
            <input value="{{ $role->name }}" name="name" required type="text" class="form-control" id="role-name">
        </div>
    
        <a class="btn btn-secondary" type="button" href="{{ route('roles') }}">Cancel</a>
        <button class="btn btn-primary" type="submit">Save</button>
    </form>
</div>
@endsection
