@extends('layouts.backoffice')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Permission for {{ $role->name }}</h1>
    </div>

    <p>Please select the corresponding permissions for this role:</p>

    <form method="POST" action="{{ route('store-permission') }}">
        @csrf
        <input type="hidden" name="roleId" value="{{ $role->id }}">
        @foreach($permissions as $index => $permission)
        <div class="mb-3 form-check">
            <input name="selectedPermission[]" type="checkbox" class="form-check-input" id="permission-{{ $permission->id }}" value="{{ $permission->id }}"
                {{ $role->permission->contains($permission->id) ? 'checked' : '' }}>
            <label class="form-check-label" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
        </div>
        @endforeach

        <a class="btn btn-secondary" type="button" href="{{ route ('roles') }}">Cancel</a>
        <button class="btn btn-primary" type="submit">Save</button>
    </form>
</div>
@endsection
