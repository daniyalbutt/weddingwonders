@extends('layouts.app')
@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Venues</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Venues</li>
        <li>-</li>
        <li class="fw-medium">Venue List</li>
    </ul>
</div>

<!-- Main content -->
<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-0">Venues List</h5>
    </div>
    <div class="card-body">
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif
        <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
            <thead>
                <tr>
                    <th scope="col">
                        SNO
                    </th>
                    <th scope="col">Name</th>
                    <th scope="col">Added by</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $value)
                <tr class="hover-primary">
                    <td>#{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->user->name }}</td>
                    <td>
                        <div class="d-flex">
                            @can('edit venue')
                            <a href="{{ route('venues.edit', $value->id) }}" class="me-10 w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            @endcan
                            @can('delete venue')
                            <form action="{{ route('venues.destroy', $value->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                </button>
                            </form>
                            @endcan
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
@endpush