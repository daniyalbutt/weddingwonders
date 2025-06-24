@extends('layouts.app')
@section('content')

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Add Item</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Items</li>
        <li>-</li>
        <li class="fw-medium">Add Item</li>
    </ul>
</div>

<div class="row gy-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Item Form</h5>
            </div>
            <div class="card-body">
		        <form class="form" method="post" action="{{ route('items.store') }}" enctype="multipart/form-data">
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
		                            <label class="form-label">Quantity</label>
		                            <input type="number" class="form-control" name="quantity" required>
		                        </div>
		                    </div>
							<div class="col-md-4">
		                        <div class="form-group">
		                            <label class="form-label">Storage Location</label>
		                            <input type="text" class="form-control" name="location" required>
		                        </div>
		                    </div>
							<div class="col-md-3">
		                        <div class="form-group">
		                            <label class="form-label">Shelf Number</label>
		                            <input type="text" class="form-control" name="shelf" required>
		                        </div>
		                    </div>
							<div class="col-md-3">
		                        <div class="form-group">
		                            <label class="form-label">Row Number</label>
		                            <input type="text" class="form-control" name="row" required>
		                        </div>
		                    </div>
							<div class="col-md-3">
		                        <div class="form-group">
		                            <label class="form-label">Image</label>
		                            <input type="file" class="form-control" name="image" required>
		                        </div>
		                    </div>
							<div class="col-md-3">
								<div class="form-group">
		                            <label class="form-label">Category</label>
									<select class="form-control" name="category" id="category" required>
										<option value="">Select Category</option>
										<option value="Flowers">Flowers</option>
										<option value="Linens">Linens</option>
										<option value="Drapes">Drapes</option>
										<option value="Centerpieces">Centerpieces</option>
										<option value="Stage">Stage</option>
									</select>
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary-600 btn-sm">Save Item</button>
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