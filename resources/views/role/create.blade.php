@extends('layouts.app')
@section('content')

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Add Role</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Roles</li>
        <li>-</li>
        <li class="fw-medium">Add Role</li>
    </ul>
</div>

<div class="row gy-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Role Form</h5>
            </div>
            <div class="card-body">
				<form class="form" method="post" action="{{ route('roles.store') }}">
					@csrf
					@if($errors->any())
						{!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
					@endif
					@if(session()->has('success'))
						<div class="alert alert-success">
							{{ session()->get('success') }}
						</div>
					@endif
					<div class="row gy-3">
						<div class="col-12">
							<label class="form-label">Name <strong>*</strong></label>
							<input type="text" class="form-control" name="name" required>
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-primary-600 btn-sm">Save Role</button>
						</div>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

@endpush