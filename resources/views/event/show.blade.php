@extends('layouts.app')
@section('content')
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">Event - {{ $data->name }}</h6>
    <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium">
            <a href="{{ route('home') }}" class="d-flex align-items-center gap-1 hover-text-primary">
                <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                Dashboard
            </a>
        </li>
        <li>-</li>
        <li class="fw-medium">Event - {{ $data->name }}</li>
    </ul>
</div>

<div class="row gy-4">
    <div class="col-lg-3">
        <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
            <img src="{{ asset('img/user-grid-bg1.png') }}" alt="" class="w-100 object-fit-cover">
            <div class="pb-24 ms-16 mb-24 me-16  mt--100">
                <div class="text-center border border-top-0 border-start-0 border-end-0">
                    <img src="{{ asset('img/user-grid-img14.png') }}" alt="" class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover">
                    <h6 class="mb-0 mt-16">{{ $data->name }}</h6>
                    <span class="text-secondary-light mb-16">{{ $data->venue }}</span>
                </div>
                <div class="mt-24">
                    <h6 class="text-xl mb-16">Event Info</h6>
                    <ul>
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <span class="w-40 text-md fw-semibold text-primary-light">User Name</span>
                            <span class="w-60 text-secondary-light fw-medium">: {{ $data->user->name }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <span class="w-40 text-md fw-semibold text-primary-light">Event Date</span>
                            <span class="w-60 text-secondary-light fw-medium">: {{ $data->event_date }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <span class="w-40 text-md fw-semibold text-primary-light"> Status</span>
                            <span class="w-60 text-secondary-light fw-medium">: {{ $data->get_status() }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <span class="w-40 text-md fw-semibold text-primary-light"> Created At</span>
                            <span class="w-60 text-secondary-light fw-medium">: {{ $data->created_at->format('d M, Y') }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <span class="w-40 text-md fw-semibold text-primary-light"> Total Items</span>
                            <span class="w-60 text-secondary-light fw-medium">: {{ $data->event_items->count() }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="card h-100">
            <div class="card-body p-24">
                @foreach($data->event_items as $key => $value)
                <div class="row mb-20">
                    <div class="col-md-4">
                        <label for="">Item</label>
                        <input type="text" class="form-control" name="" value="{{ $value->item->name }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="">Condition</label>
                        <select name="condition[{{$value->id}}]" id="" class="form-control" required>
                            <option value="">Select Condition</option>
                            <option value="1" {{ $value->condition == 1 ? 'selected' : '' }}>Good Condition</option>
                            <option value="2" {{ $value->condition == 2 ? 'selected' : '' }}>Damaged</option>
                            <option value="3" {{ $value->condition == 3 ? 'selected' : '' }}>Lost</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="">Quantity</label>
                        <input type="number" name="quantity[{{$value->id}}]" id="quantity" class="form-control" max="{{ $value->quantity }}" value="{{ $value->condition_quantity }}" onfocusout="checkQuantity(this)">
                    </div>
                    <div class="col-md-8">
                        <div class="form-group mt-3">
                            <label for="notes">Notes</label>
                            <input type="text" name="notes[{{$value->id}}]" id="notes" class="form-control" value="{{ $value->notes }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="">Image</label>
                            <input type="file" name="image[{{$value->id}}]" id="image" class="form-control">
                            @if($value->image != null)
                            <a href="{{ asset($value->image) }}" target="_blank" style="font-size: 14px;color: #0d6efd;">Click here to view image</a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12 mt-20">
                        <hr>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@endpush