@extends('layouts.backoffice')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Roles</h1>
        @if(Auth::user()->role->permission->contains('id', 6))
        <a href="#" data-toggle="modal" data-target="#createRoleModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Role
        </a>
        @endif
    </div>

    @if(Auth::user()->role->permission->whereIn('id', [7, 8, 9])->count() > 0)
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Created at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $index => $row)
            <tr>
                <th scope="row text-center">{{ $index + $roles->firstItem() }}</th>
                <td>{{ $row->name }}</td>
                <td>{{ isset($row->created_at) ? $row->created_at : '-' }}</td>
                <td>
                    @if(Auth::user()->role->permission->contains('id', 8))
                    <a href="{{ route('edit-role', $row->id) }}">
                        <i class="fas mr-1 cursor-pointer fa-edit text-warning text-lg"></i>
                    </a>
                    @endif

                    @if(Auth::user()->role->permission->contains('id', 9))
                    <a href="#" class="delete-role" data-user-id="{{ $row->id }}" data-toggle="modal" data-target="#confirmationModal">
                        <i class="fas mr-1 cursor-pointer fa-trash text-danger text-lg"></i>
                    </a>
                    @endif

                    @if(Auth::user()->role->permission->contains('id', 8))
                    <a href="{{ route('manage-permission', $row->id) }}">
                        <i class="fas mr-1 cursor-pointer fa-user-cog text-success text-lg"></i>
                    </a>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <th colspan="4" class="text-center">No record data.</th>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $roles->links() }}
    @endif
</div>

<!-- Confirmation Modal-->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Role Deletion</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure want to delete this role?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- Create User Modal-->
<div class="modal fade" id="createRoleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Role Form</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="{{ route('create-role') }}">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="role-name" class="form-label">Name</label>
                    <input name="name" required type="text" class="form-control" id="role-name">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".delete-role").click(function () {
            var userId = $(this).data("user-id");

            var deleteUrl = "{{ route('delete-role', ['id' => ':userId']) }}";
            deleteUrl = deleteUrl.replace(':userId', userId);
            $("#confirmationModal .btn-primary").attr("href", deleteUrl);
        });
    });
</script>
@endsection
