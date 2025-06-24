@extends('layouts.app')
@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css" crossorigin="anonymous">
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
@endpush
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Add Portfolio</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Portfolios</li>
        <li>-</li>
        <li class="fw-medium">Add Portfolio</li>
    </ul>
</div>

<div class="row gy-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Portfolio Form</h5>
            </div>
            <div class="card-body">
		        <form class="form" method="post" action="{{ route('portfolios.store') }}" enctype="multipart/form-data">
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
		                            <label class="form-label">Event Date</label>
		                            <input type="date" class="form-control" name="event_date" required>
		                        </div>
		                    </div>
							<div class="col-md-12">
		                        <div class="form-group">
		                            <label class="form-label">Theme</label>
									<textarea name="theme" id="theme" class="form-control" required></textarea>
		                        </div>
		                    </div>
							<div class="col-md-12">
		                        <div class="form-group">
		                            <label class="form-label">Venue</label>
									<textarea name="venue" id="venue" class="form-control" required></textarea>
		                        </div>
		                    </div>
							<div class="col-md-12">
								<div class="form-group">
		                            <label class="form-label">Image</label>
									<input type="file" class="dropify" name="image"/>
								</div>
							</div>
							<div class="col-md-12">
		                        <div class="form-group">
		                            <label class="form-label">Images</label>
									<input name="images[]" type="file" class="file multiple-images" multiple>
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary-600 btn-sm">Save Portfolio</button>
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
	$(".multiple-images").fileinput({
		showUpload: true,
		theme: 'fa',
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
	})
</script>
@endpush