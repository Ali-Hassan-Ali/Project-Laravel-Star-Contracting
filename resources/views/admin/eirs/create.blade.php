@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('eirs.eirs')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.eirs.index') }}">@lang('eirs.eirs')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                @include('admin.partials._errors')

                <form method="post" action="{{ route('admin.eirs.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    <div class="row">
                        {{--equipment_id--}}
                        <div class="form-group col-6">
                            <label>@lang('countrys.countrys') <span class="text-danger">*</span></label>
                            <select class="form-control col-6 select2" id="equipment-countrey">
                                <option value="" selected disabled>@lang('site.choose') @lang('countrys.countrys')</option>
                                @foreach ($countrys as $country)
                                    <option value="{{ $country->id }}" 
                                        data-url="{{ route('admin.ajax.country', $country->id) }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--equipment_id--}}
                        <div class="form-group col-6">
                            <label>@lang('citys.citys') <span class="text-danger">*</span></label>
                            <select class="form-control select2" id="equipment-city">
                                
                            </select>
                        </div>

                        {{--equipment_id--}}
                        <div class="form-group @error('equipment_id') custom-select @enderror">
                            <label>@lang('equipments.equipments') <span class="text-danger">*</span></label>
                            <select name="equipment_id" id="equipment-man" class="form-control select2" required>
                                <option value="">@lang('site.choose') @lang('equipments.equipments')</option>
                                @foreach ($equipments as $equipment)
                                    <option value="{{ $equipment->id }}" {{ $equipment->id == old('equipment_id') ? 'selected' : '' }}>{{ $equipment->name .' '. $equipment->make .' '. $equipment->plate_no }}</option>
                                @endforeach
                            </select>
                            @error('equipment_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--$number--}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.eir_no')<span class="text-danger">*</span></label>
                            <input type="number" name="eir_no" class="form-control @error('eir_no') is-invalid @enderror" value="{{ old('eir_no') }}" required autofocus>
                            @error('eir_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label>@lang('eirs.date')<span class="text-danger">*</span></label>
                            <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required autofocus>
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--expected_process_date--}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.expected_process_date')<span class="text-danger">*</span></label>
                            <input type="date" disabled name="expected_process_date" class="form-control @error('expected_process_date') is-invalid @enderror" value="{{ old('expected_process_date') }}" required autofocus>
                            @error('expected_process_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--expected_po_released_date--}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.expected_po_released_date')<span class="text-danger">*</span></label>
                            <input type="date" disabled name="expected_po_released_date" class="form-control @error('expected_po_released_date') is-invalid @enderror" value="{{ old('expected_po_released_date') }}" required autofocus>
                            @error('expected_po_released_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--expected_payment_transfer_date--}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.expected_payment_transfer_date')<span class="text-danger">*</span></label>
                            <input type="date" disabled name="expected_payment_transfer_date" class="form-control @error('expected_payment_transfer_date') is-invalid @enderror" value="{{ old('expected_payment_transfer_date') }}" required autofocus>
                            @error('expected_payment_transfer_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--expected_shipment_pickup_date--}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.expected_shipment_pickup_date')<span class="text-danger">*</span></label>
                            <input type="date" disabled name="expected_shipment_pickup_date" class="form-control @error('expected_shipment_pickup_date') is-invalid @enderror" value="{{ old('expected_shipment_pickup_date') }}" required autofocus>
                            @error('expected_shipment_pickup_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--expected_arrival_to_site_date--}}
                        <div class="form-group col-12">
                            <label>@lang('eirs.expected_arrival_to_site_date')<span class="text-danger">*</span></label>
                            <input type="date" disabled name="expected_arrival_to_site_date" class="form-control @error('expected_arrival_to_site_date') is-invalid @enderror" value="{{ old('expected_arrival_to_site_date') }}" required autofocus>
                            @error('expected_arrival_to_site_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- actual_process_date --}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.actual_process_date')<span class="text-danger">*</span></label>
                            <input type="date" name="actual_process_date" class="form-control @error('actual_process_date') is-invalid @enderror" value="{{ old('actual_process_date') }}" required autofocus>
                            @error('actual_process_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- actual_po_released_date --}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.actual_po_released_date')<span class="text-danger">*</span></label>
                            <input type="date" name="actual_po_released_date" class="form-control @error('actual_po_released_date') is-invalid @enderror" value="{{ old('actual_po_released_date') }}" required autofocus>
                            @error('actual_po_released_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- actual_payment_transfer_date --}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.actual_payment_transfer_date')<span class="text-danger">*</span></label>
                            <input type="date" name="actual_payment_transfer_date" class="form-control @error('actual_payment_transfer_date') is-invalid @enderror" value="{{ old('actual_payment_transfer_date') }}" required autofocus>
                            @error('actual_payment_transfer_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- actual_shipment_pickup_date --}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.actual_shipment_pickup_date')<span class="text-danger">*</span></label>
                            <input type="date" name="actual_shipment_pickup_date" class="form-control @error('actual_shipment_pickup_date') is-invalid @enderror" value="{{ old('actual_shipment_pickup_date') }}" required autofocus>
                            @error('actual_shipment_pickup_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- actual_arrival_to_site_date --}}
                        <div class="form-group col-12">
                            <label>@lang('eirs.actual_arrival_to_site_date')<span class="text-danger">*</span></label>
                            <input type="date" name="actual_arrival_to_site_date" class="form-control @error('actual_arrival_to_site_date') is-invalid @enderror" value="{{ old('actual_arrival_to_site_date') }}" required autofocus>
                            @error('actual_arrival_to_site_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                    </div>{{-- row --}}

                    @php
                        $status = ['Under Review', 'Approved', 'PO Placed', 'Payment Processed', 'Part In Transit', 'Deliverd To Site'];
                    @endphp

                    {{--$enum--}}
                    <div class="form-group">
                        <label>@lang('eirs.status' ) <span class="text-danger">*</span></label>
                        <select name="status" class="form-control select2 @error('status') custom-select @enderror" required>
                            <option value="">@lang('site.choose') @lang('eirs.status')</option>
                            @foreach ($status as $statu)
                                <option value="{{ $statu }}" {{ $statu == old('status') ? 'selected' : '' }}>@lang('site.status')</option>
                            @endforeach
                        </select>
                    </div>

                                        {{-- attachments --}}
                    <div class="form-group">
                        <label>@lang('eirs.attachments') <span class="text-danger">*</span></label>
                        <input type="file" name="attachments" autofocus class="form-control @error('attachments') is-invalid @enderror" value="{{ old('attachments') }}" required>
                        @error('attachments')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

@push('scripts')
    
    <script>
        //select 2
        $('.select2').select2({
            'width': '100%',
            'tags': false,
            'minimumResultsForSearch': Infinity
        });

    </script>

@endpush


