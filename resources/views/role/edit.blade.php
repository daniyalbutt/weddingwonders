@extends('layouts.app')
@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Edit Role - {{ $data->name }}</h6>
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
        <li class="fw-medium">Edit Role - {{ $data->name }}</li>
    </ul>
</div>

<div class="row gy-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Role Form</h5>
            </div>
            <div class="card-body">
				<form class="form" method="post" action="{{ route('roles.update', $data->id) }}">
		        	@csrf
					@method('PUT')
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
							<input type="text" class="form-control" name="name" required value="{{ old('name', $data->name) }}">
						</div>
						<div class="col-12">
							<label class="form-label">Permission <strong>*</strong></label>
							<ul class="role-wrapper form-check">
							@foreach($permission as $key => $value)
								<li>
									<input class="form-check-input" name="permission[]" value="{{ $value->name }}" type="checkbox" id="basic_checkbox_{{$key}}" {{ in_array($value->name, $rolePermissions) ? 'checked' : '' }} />
									<label for="basic_checkbox_{{$key}}">{{ $value->name }}</label>
								</li>
							@endforeach
							</ul>
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-primary-600 btn-sm">Update Role</button>
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