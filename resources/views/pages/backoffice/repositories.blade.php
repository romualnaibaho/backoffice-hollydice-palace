@extends('layouts.backoffice')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gitlab Repositories</h1>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @else
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Fullname</th>
                <th scope="col">Html Url</th>
            </tr>
        </thead>
        <tbody>
            @forelse($repositories as $index => $repository)
            <tr>
                <th scope="row text-center">{{ $index + 1 }}</th>
                <td>{{ $repository['name'] }}</td>
                <td>{{ $repository['full_name'] }}</td>
                <td>
                    <a href="{{ $repository['html_url'] }}" target="blank">
                        {{ $repository['html_url'] }}
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <th colspan="4" class="text-center">No record data.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $repositories->links() }}
    @endif

</div>
@endsection
