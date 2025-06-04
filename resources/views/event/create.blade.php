@extends('layouts.app')
@section('content')

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Add Event</h6>
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
        <li class="fw-medium">Add Event</li>
    </ul>
</div>

<div class="row gy-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Event Form</h5>
            </div>
            <div class="card-body">
		        <form class="form" method="post" action="{{ route('events.store') }}">
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
		                    <div class="col-md-6">
		                        <div class="form-group">
		                            <label class="form-label">Name</label>
		                            <input type="text" class="form-control" name="name" required>
		                        </div>
		                    </div>
							<div class="col-md-6">
		                        <div class="form-group">
		                            <label class="form-label">Date</label>
		                            <input type="date" class="form-control" name="date" required>
		                        </div>
		                    </div>
							<div class="col-md-6">
		                        <div class="form-group">
		                            <label class="form-label">Venue</label>
		                            <input type="text" class="form-control" name="venue" required>
		                        </div>
		                    </div>
							<div class="col-md-6">
		                        <div class="form-group">
		                            <label class="form-label">Assign Employee</label>
									<select name="user_id" id="user_id" class="form-control">
										<option value="">Select Employee</option>
										@foreach($employees as $key => $value)
										<option value="{{ $value->id }}">{{ $value->name }}</option>
										@endforeach
									</select>
		                        </div>
		                    </div>
							<div class="col-md-12 mt-40">
								<hr>
							</div>
							<div class="repeater">
								<div data-repeater-list="group-a">
									<div data-repeater-item>
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="form-label">Items</label>
													<select class="item-data form-control" name="items[]">

													</select>
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<label class="form-label">Quantity</label>
													<input type="number" name="quantity[]" class="form-control">
												</div>
											</div>
											<div class="col-md-2">
												<button class="btn btn-danger btn-sm w-100" data-repeater-delete type="button" style="margin-top: 36px;">Delete Item</button>
											</div>
										</div>
									</div>
								</div>
								<div class="text-end mt-3">
									<button class="btn btn-primary btn-sm" data-repeater-create type="button">Add Item</button>
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary-600 btn-sm">Save Event</button>
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
<script>
	$('.item-data').select2({
  		ajax: {
    		url: "{{ route('item.list') }}",
    		dataType: 'json',
			processResults: function (data) {
				console.log(data);
				return {
					results:  $.map(data, function (item) {
						return {
							text: item.name,
							id: item.id,
							image: item.image
						}
                	})
            	};
			}
  		}
	});
	$('.repeater').repeater({
		show: function () {
    		$(this).slideDown();
    		$(this).find('.select2-container').remove();
    		$(this).find('.item-data').select2({
      			ajax: {
					url: "{{ route('item.list') }}",
					dataType: 'json',
					processResults: function (data) {
						console.log(data);
						return {
							results:  $.map(data, function (item) {
								return {
									text: item.name,
									id: item.id,
									image: item.image
								}
							})
						};
					}
				}
    		});
    		$(this).find('.select2-container').css('width','100%');
  		},
	});
</script>
@endpush