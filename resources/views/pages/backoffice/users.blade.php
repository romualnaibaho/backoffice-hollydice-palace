@extends('layouts.backoffice')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            {{ !isset($deletedPage) ? 'Users' : 'Deleted Users'}}
        </h1>
        @if(!isset($deletedPage) && Auth::user()->role->permission->contains('id', 1))
        <a href="#" data-toggle="modal" data-target="#createUserModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New User
        </a>
        @endif
    </div>

    @if(Auth::user()->role->permission->whereIn('id', [2, 3, 4])->count() > 0)
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">
                    {{ isset($deletedPage) ? 'Deleted At' : 'Last Login' }}
                </th>
                @if(!isset($deletedPage))
                <th scope="col">Action</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $row)
            <tr>
                <th scope="row text-center">{{ $index + $users->firstItem() }}</th>
                <td>{{ $row->name }}</td>
                <td>{{ $row->email }}</td>
                <td>{{ $row->role_name }}</td>
                @if(isset($deletedPage) && $deletedPage)
                <td>{{ $row->deleted_at }}</td>
                @else
                <td>{{ isset($row->last_login) ? $row->last_login : '-' }}</td>
                @endif
                @if(!isset($deletedPage))
                <td>
                    @if(Auth::user()->role->permission->contains('id', 3))
                    <a href="{{ route('edit-user', $row->id) }}">
                        <i class="fas mr-1 cursor-pointer fa-edit text-warning text-lg"></i>
                    </a>
                    @endif

                    @if(Auth::user()->role->permission->contains('id', 4))
                    <a href="#" class="delete-user" data-user-id="{{ $row->id }}" data-toggle="modal" data-target="#confirmationModal">
                        <i class="fas mr-1 cursor-pointer fa-trash text-danger text-lg"></i>
                    </a>
                    @endif
                </td>
                @endif
            </tr>
            @empty
            <tr >
                <th colspan="6" class="text-center">No record data.</th>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $users->links() }}
    @endif
</div>

<!-- Confirmation Modal-->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Account Deletion</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Are you sure want to delete this account?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary">Delete</a>
            </div>
        </div>
    </div>
</div>

<!-- Create User Modal-->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New User Form</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="{{ route('create-user') }}">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="user-name" class="form-label">Name</label>
                    <input name="name" required type="text" class="form-control" id="user-name">
                    @if ($errors->has('name'))
                        <span class="help-block text-center">
                            <strong style="color:red;font-size:12px;">{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="user-email" class="form-label">Email address</label>
                    <input name="email" required type="email" class="form-control" id="user-email">
                    @if ($errors->has('email'))
                        <span class="help-block text-center">
                            <strong style="color:red;font-size:12px;">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="user-password" class="form-label">Password</label>
                    <input name="password" required type="password" class="form-control" id="user-password">
                    @if ($errors->has('password'))
                        <span class="help-block text-center">
                            <strong style="color:red;font-size:12px;">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="user-role" class="form-label">Role</label>
                    <select name="roleId" class="form-control">
                        @foreach($role_options as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
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
@if ($errors->any())
    <script>
        $(document).ready(function () {
            $('#createUserModal').modal('show');
        });
    </script>
@endif

<script>
    $(document).ready(function () {
        $(".delete-user").click(function () {
            var userId = $(this).data("user-id");

            var deleteUrl = "{{ route('delete-user', ['id' => ':userId']) }}";
            deleteUrl = deleteUrl.replace(':userId', userId);
            $("#confirmationModal .btn-primary").attr("href", deleteUrl);
        });
    });
</script>

@endsection
