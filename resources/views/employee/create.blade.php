@extends('layouts.app')
@section('content')

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Add Employee</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Employees</li>
        <li>-</li>
        <li class="fw-medium">Add Employee</li>
    </ul>
</div>

<div class="row gy-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Employee Form</h5>
            </div>
            <div class="card-body">
		        <form class="form" method="post" action="{{ route('employees.store') }}">
		        	@csrf
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
		                            <input type="text" class="form-control" name="name" required>
		                        </div>
		                    </div>
		                    <div class="col-md-4">
		                        <div class="form-group">
		                            <label class="form-label">E-mail</label>
		                            <input type="email" class="form-control" name="email" required>
		                        </div>
		                    </div>
							<div class="col-md-4">
		                        <div class="form-group">
		                            <label class="form-label">Password</label>
		                            <input type="text" class="form-control" name="password" required>
		                        </div>
		                    </div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary-600 btn-sm">Save Employee</button>
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