@extends('layouts.backoffice')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Permissions</h1>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody>
            @forelse($permissions as $index => $row)
            <tr>
                <th scope="row text-center">{{ $index + $permissions->firstItem() }}</th>
                <td>{{ $row->name }}</td>
            </tr>
            @empty
            <tr>
                <th colspan="2" class="text-center">No record data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $permissions->links() }}
</div>
@endsection
