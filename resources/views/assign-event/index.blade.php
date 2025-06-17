@extends('layouts.app')
@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Events</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Events</li>
        <li>-</li>
        <li class="fw-medium">Event List</li>
    </ul>
</div>
<!-- Main content -->
<div class="card basic-data-table">
    <div class="card-header">
        <h5 class="card-title mb-0">Events List</h5>
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
                    <th scope="col">Venue</th>
                    <th scope="col">Date</th>
                    <th scope="col">User</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $value)
                <tr class="hover-primary">
                    <td>#{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->venue }}</td>
                    <td>{{ $value->event_date }}</td>
                    <td>{{ $value->user->name }}</td>
                    <td><span class="badge text-sm fw-semibold rounded-pill {{ $value->get_status_class() }} px-20 py-9 radius-4 text-white badge-sm">{{ $value->get_status() }}</span></td>
                    <td>
                        @can('show assign-event')
                        <div class="d-flex">
                            <a href="{{ route('event.show', $value->id) }}" class="me-10 w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:eye"></iconify-icon>
                            </a>
                        </div>
                        @endcan
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