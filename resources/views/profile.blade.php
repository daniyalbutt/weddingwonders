@extends('layouts.app')
@section('content')

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Update Profile</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Update Profile</li>
    </ul>
</div>

<div class="row gy-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Update Profile</h5>
            </div>
            <div class="card-body">
		        <form class="form" method="post" action="{{ route('profile.update') }}">
		        	@csrf
					@method('PUT')
		            <div class="box-body">
						@if($errors->any())
							{!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
						@endif
						@if(session()->has('success'))
							<div class="alert alert-success">
								{{ session()->get('success') }}
							</div>
						@endif
		                <div class="row gy-3">
		                    <div class="col-md-4">
		                        <div class="form-group">
		                            <label class="form-label">Name</label>
		                            <input type="text" class="form-control" name="name" value="{{ old('name', $data->name) }}" required>
		                        </div>
		                    </div>
                            <div class="col-md-4">
		                        <div class="form-group">
		                            <label class="form-label">Email</label>
		                            <input type="email" class="form-control" name="email" value="{{ old('name', $data->email) }}" readonly>
		                        </div>
		                    </div>
                            <div class="col-md-4">
		                        <div class="form-group">
		                            <label class="form-label">Password</label>
		                            <input type="text" class="form-control" name="password" value="{{ old('password') }}">
		                        </div>
		                    </div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary-600 btn-sm">Update Profile</button>
							</div>
		                </div>
		            </div>
		        </form>
		    </div>
		    <!-- /.box -->			
		</div>
	</div>
</div>

@endsection

@push('scripts')
@endpush