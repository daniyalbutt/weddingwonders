@extends('layouts.app')
@section('content')

<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Add Event</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
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
		                            <input type="text" class="form-control" name="name" value="{{ $template != null ? $template->name : '' }}" required>
		                        </div>
		                    </div>
							<div class="col-md-6">
		                        <div class="form-group">
		                            <label class="form-label">Date</label>
		                            <input type="date" class="form-control" name="date" value="{{ $template != null ? $template->event_date : '' }}" required>
		                        </div>
		                    </div>
							<div class="col-md-6">
		                        <div class="form-group">
		                            <label class="form-label">Venue</label>
		                            <input type="text" class="form-control" name="venue" value="{{ $template != null ? $template->venue : '' }}" required>
		                        </div>
		                    </div>
							<div class="col-md-3">
		                        <div class="form-group">
		                            <label class="form-label">Assign Employee</label>
									<select name="user_id" id="user_id" class="form-control" required>
										<option value="">Select Employee</option>
										@foreach($employees as $key => $value)
										<option value="{{ $value->id }}">{{ $value->name }}</option>
										@endforeach
									</select>
		                        </div>
		                    </div>
							<div class="col-md-3">
		                        <div class="form-group">
		                            <label class="form-label">Mark as Template</label>
									<select name="template" id="template" class="form-control">
										<option value="0">NO</option>
										<option value="1">YES</option>
									</select>
								</div>
							</div>
							<div class="col-md-12 mt-40">
								<hr>
							</div>
							@if($template != null)
							@foreach($template->template_items as $key => $value)
							<div class="col-md-12">
								<div class="row mb-3">
									<div class="col-md-5">
										<div class="form-group">
											<label class="form-label">Items</label>
											<input type="text" class="form-control" name="old_items[{{$value->item->id}}]" value="{{ $value->item->name }}" readonly>
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
											<label class="form-label">Quantity ( Remaining {{ $value->total_remaining() }} )</label>
											<input type="number" class="form-control" name="old_quantity[{{$value->item->id}}]" value="{{ $value->quantity }}" max="{{ $value->quantity + $value->total_remaining() }}" onfocusout="checkQuantity(this)" required>
										</div>
									</div>
									<div class="col-md-2">
										<button class="btn btn-danger btn-sm w-100" type="button" style="margin-top: 36px;" onclick="deleteItem(this, {{$value->id}})">Delete Item</button>
									</div>
								</div>
							</div>
							@endforeach
							@endif
							<div class="repeater">
								<div data-repeater-list="items">
									<div data-repeater-item>
										<div class="row mb-10">
											<div class="col-md-5">
												<div class="form-group">
													<label class="form-label">Items</label>
													<select class="item-data form-control" name="item">

													</select>
												</div>
											</div>
											<div class="col-md-5">
												<div class="form-group">
													<label class="form-label quantity-show">Quantity <span></span></label>
													<input type="number" name="quantity" class="form-control quantity" onfocusout="checkQuantity(this)">
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
	}).on('change', function (e) {
		var selected_select2 = this;
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url : "{{ route('item.quantity') }}",
			data : {'id' : this.value},
			type : 'GET',
			dataType : 'json',
			success : function(result){
				if(result.status){
					$(selected_select2).parent().parent().parent().find('.quantity-show span').text('( Remaining '+result.qty+' )');
					$(selected_select2).parent().parent().parent().find('.quantity').attr('max', result.qty);
				}
			}
		});
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
    		}).on('change', function (e) {
				var selected_select2 = this;
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url : "{{ route('item.quantity') }}",
					data : {'id' : this.value},
					type : 'GET',
					dataType : 'json',
					success : function(result){
						if(result.status){
							$(selected_select2).parent().parent().parent().find('.quantity-show span').text('( Remaining '+result.qty+')');
							$(selected_select2).parent().parent().parent().find('.quantity').attr('max', result.qty);
						}
					}
				});
			});;
    		$(this).find('.select2-container').css('width','100%');
  		},
	});

	function checkQuantity(a){
		var $this = $(a);
        var val = parseInt($this.val());
        var max = parseInt($this.attr("max"));

        if (max > 0 && val > max){
            $this.val(max);
        }

	}
</script>
@endpush