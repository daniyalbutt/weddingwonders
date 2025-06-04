@extends('layouts.app')
@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@endpush
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Edit Portfolio - {{ $data->name }}</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="index.html" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">ItePortfoliosms</li>
        <li>-</li>
        <li class="fw-medium">Edit Portfolio - {{ $data->name }}</li>
    </ul>
</div>

<div class="row gy-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Portfolio Form - {{ $data->name }}</h5>
            </div>
            <div class="card-body">
		        <form class="form" method="post" action="{{ route('portfolios.update', $data->id) }}" enctype="multipart/form-data">
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
		                    <div class="col-md-6">
		                        <div class="form-group">
		                            <label class="form-label">Name</label>
		                            <input type="text" class="form-control" name="name" value="{{ old('name', $data->name) }}" required>
		                        </div>
		                    </div>
							<div class="col-md-6">
		                        <div class="form-group">
		                            <label class="form-label">Date</label>
		                            <input type="date" class="form-control" name="event_date" value="{{ old('event_date', $data->event_date) }}" required>
		                        </div>
		                    </div>
							<div class="col-md-12">
		                        <div class="form-group">
		                            <label class="form-label">Theme</label>
									<textarea name="theme" id="theme" class="form-control" required>{{ old('theme', $data->theme) }}</textarea>
		                        </div>
		                    </div>
							<div class="col-md-12">
		                        <div class="form-group">
		                            <label class="form-label">Venue</label>
									<textarea name="venue" id="venue" class="form-control" required>{{ old('venue', $data->venue) }}</textarea>
		                        </div>
		                    </div>
							
							<div class="col-md-12">
		                        <div class="form-group">
		                            <label class="form-label">Image</label>
		                            <input type="file" class="form-control dropify" name="image" data-default-file="{{ asset($data->image) }}">
		                        </div>
		                    </div>

							<div class="col-md-12">
		                        <div class="form-group">
		                            <label class="form-label">Images</label>
									<input name="images[]" type="file" class="file multiple-images" multiple data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload...">
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary-600 btn-sm">Update Portfolio</button>
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
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>
<script>
	var urls = [],
        initialPreviewConfig = [],
        initialPreviewAsData = false;

	var images = {!! json_encode($data->images->toArray()) !!};
	images.forEach(function(portfolio_images, i) {
		urls.push(window.location.origin + '/' + portfolio_images.image);
		initialPreviewConfig.push({
			caption: portfolio_images.image.split('/').slice(-1)[0],
			downloadUrl: window.location.origin + '/' + portfolio_images.image,
			url: "{{ route('portfolio.delete') }}",
			key: portfolio_images.id,
			extra: {
				_token: $('meta[name="csrf-token"]').attr('content'),
				path: portfolio_images.image
			}
		})
		initialPreviewAsData = true
	});

	var formData = new FormData();
	$(".multiple-images").fileinput({
		showUpload: false,
		// uploadUrl: "http://127.0.0.1:8000/products/7",
		theme: 'fa',
		initialPreview: urls,
		initialPreviewAsData: initialPreviewAsData,
		initialPreviewConfig: initialPreviewConfig,
		uploadAsync: false,
		browseOnZoneClick: true,
		initialPreviewShowDelete: true,
		dropZoneEnabled: true,
		overwriteInitial: false,
		maxFileSize: 20000000,
		maxFilesNum: 20,
		uploadExtraData: function() {
			return {
				created_at: $('.created_at').val()
			};
		}
	}).on('filebatchselected', function(event, files) {
		$.each(files, function(index, value) {
			formData.append('productgalleries[]', value['file'])
		});
	});
</script>
@endpush