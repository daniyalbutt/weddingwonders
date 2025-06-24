@extends('layouts.app')

@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Dashboard</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
    </ul>
</div>

@if(Auth::user()->hasRole('admin'))
<div class="row gy-4">
    <div class="col-12">
        <div class="card radius-12">
            <div class="card-body p-16">
                <div class="row gy-4">
                    @can('item')
                    <div class="col-xxl-3 col-xl-4 col-sm-6">
                        <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-1 left-line line-bg-primary position-relative overflow-hidden">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                <div>
                                    <span class="mb-2 fw-medium text-secondary-light text-md">Total Items</span>
                                    <h6 class="fw-semibold mb-1">{{ $item_count }}</h6>
                                </div>
                                <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-primary-100 text-primary-600">
                                    <i class="ri-list-view"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endcan
                    @can('employee')
                    <div class="col-xxl-3 col-xl-4 col-sm-6">
                        <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-2 left-line line-bg-lilac position-relative overflow-hidden">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                <div>
                                    <span class="mb-2 fw-medium text-secondary-light text-md">Total Employees</span>
                                    <h6 class="fw-semibold mb-1">{{ $user_count }}</h6>
                                </div>
                                <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-lilac-200 text-lilac-600">
                                    <i class="ri-user-2-fill"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endcan
                    @can('event')
                    <div class="col-xxl-3 col-xl-4 col-sm-6">
                        <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-3 left-line line-bg-success position-relative overflow-hidden">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                <div>
                                    <span class="mb-2 fw-medium text-secondary-light text-md">Total Events</span>
                                    <h6 class="fw-semibold mb-1">{{ $event_count }}</h6>
                                </div>
                                <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-success-200 text-success-600">
                                    <i class="ri-clockwise-2-fill"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endcan
                    @can('portfolio')
                    <div class="col-xxl-3 col-xl-4 col-sm-6">
                        <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-4 left-line line-bg-warning position-relative overflow-hidden">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                <div>
                                    <span class="mb-2 fw-medium text-secondary-light text-md">Total Portfolios</span>
                                    <h6 class="fw-semibold mb-1">{{ $portfolio_count }}</h6>
                                </div>
                                <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-warning-focus text-warning-600">
                                    <i class="ri-shopping-cart-fill"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="row gy-4">
            @can('item')
            <div class="col-xxl-6 col-xl-6 col-sm-12">
                <div class="card radius-12">
                    <div class="card-body p-16">
                        <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                            <h6 class="mb-2 fw-bold text-lg mb-0">Items Quantity</h6>
                            <a href="{{ route('items.index') }}" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                View All
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                            </a>
                        </div>
                        <div class="table-responsive scroll-sm mt-20">
                            <table class="table bordered-table sm-table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Items </th>
                                        <th scope="col">Remaining Quantity</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($item_list as $key => $value)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset($value->image) }}" alt="{{ $value->name }}" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden" style="object-fit: contain;">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-medium">{{ $value->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $value->total_quantity() }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('items.edit', $value->id) }}" class="me-10 w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                <iconify-icon icon="lucide:edit"></iconify-icon>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
            @can('event')
            <div class="col-xxl-6 col-xl-6 col-sm-12">
                <div class="card radius-12">
                    <div class="card-body p-16">
                        <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                            <h6 class="mb-2 fw-bold text-lg mb-0">Events</h6>
                            <a href="{{ route('events.index') }}" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                                View All
                                <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                            </a>
                        </div>
                        <div class="table-responsive scroll-sm mt-20">
                            <table class="table bordered-table sm-table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Name </th>
                                        <th scope="col">User</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($event_list as $key => $value)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-medium">{{ $value->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $value->user->name }}</td>
                                        <td><span class="badge text-sm fw-semibold rounded-pill {{ $value->get_status_class() }} px-20 py-9 radius-4 text-white badge-sm">{{ $value->get_status() }}</span></td>
                                        <td class="text-center">
                                            <a href="{{ route('events.show', $value->id) }}" class="me-10 w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                                <iconify-icon icon="lucide:eye"></iconify-icon>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
</div>
@elseif(Auth::user()->hasRole('employee'))
<div class="row gy-4">
    <div class="col-12">
        <div class="card radius-12">
            <div class="card-body p-16">
                <div class="row gy-4">
                    <div class="col-xxl-4 col-xl-4 col-sm-6">
                        <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-1 left-line line-bg-primary position-relative overflow-hidden">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                <div>
                                    <span class="mb-2 fw-medium text-secondary-light text-md">Total Assigned Events</span>
                                    <h6 class="fw-semibold mb-1">{{ $assigned_event }}</h6>
                                </div>
                                <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-primary-100 text-primary-600">
                                    <i class="ri-list-view"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-sm-6">
                        <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-2 left-line line-bg-lilac position-relative overflow-hidden">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                <div>
                                    <span class="mb-2 fw-medium text-secondary-light text-md">Total In progress Events</span>
                                    <h6 class="fw-semibold mb-1">{{ $assigned_event_inprogress }}</h6>
                                </div>
                                <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-lilac-200 text-lilac-600">
                                    <i class="ri-file-settings-fill"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-sm-6">
                        <div class="px-20 py-16 shadow-none radius-8 h-100 gradient-deep-3 left-line line-bg-success position-relative overflow-hidden">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-1 mb-8">
                                <div>
                                    <span class="mb-2 fw-medium text-secondary-light text-md">Total Completed Events</span>
                                    <h6 class="fw-semibold mb-1">{{ $assigned_event_completed }}</h6>
                                </div>
                                <span class="w-44-px h-44-px radius-8 d-inline-flex justify-content-center align-items-center text-2xl mb-12 bg-success-200 text-success-600">
                                    <i class="ri-check-double-fill"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
