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
                            <input type="date" name="date" id="erd-data" class="form-control actual @error('date') is-invalid @enderror" value="{{ old('date') }}" required autofocus max="{{ date('Y-m-d', strtotime( now() )) }}">
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--expected_process_date--}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.expected_process_date')<span class="text-danger">*</span></label>
                            <input type="date" disabled name="expected_process_date" id="expected_process_date" class="form-control @error('expected_process_date') is-invalid @enderror" value="{{ old('expected_process_date') }}" required autofocus>
                            @error('expected_process_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="date" name="expected_process_date" id="expected_process_date-hidden" hidden>

                        {{--expected_po_released_date--}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.expected_po_released_date')<span class="text-danger">*</span></label>
                            <input type="date" disabled name="expected_po_released_date" id="expected_po_released_date" class="form-control @error('expected_po_released_date') is-invalid @enderror" value="{{ old('expected_po_released_date') }}" required autofocus>
                            @error('expected_po_released_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="date" name="expected_po_released_date" id="expected_po_released_date-hidden" hidden>

                        {{--expected_payment_transfer_date--}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.expected_payment_transfer_date')<span class="text-danger">*</span></label>
                            <input type="date" disabled name="expected_payment_transfer_date" id="expected_payment_transfer_date" class="form-control @error('expected_payment_transfer_date') is-invalid @enderror" value="{{ old('expected_payment_transfer_date') }}" required autofocus>
                            @error('expected_payment_transfer_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="date" name="expected_payment_transfer_date" id="expected_payment_transfer_date-hidden" hidden>

                        {{--expected_shipment_pickup_date--}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.expected_shipment_pickup_date')<span class="text-danger">*</span></label>
                            <input type="date" disabled name="expected_shipment_pickup_date" id="expected_shipment_pickup_date" class="form-control @error('expected_shipment_pickup_date') is-invalid @enderror" value="{{ old('expected_shipment_pickup_date') }}" required autofocus>
                            @error('expected_shipment_pickup_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="date" name="expected_shipment_pickup_date" id="expected_shipment_pickup_date-hidden" hidden>

                        {{--expected_arrival_to_site_date--}}
                        <div class="form-group col-12">
                            <label>@lang('eirs.expected_arrival_to_site_date')<span class="text-danger">*</span></label>
                            <input type="date" disabled name="expected_arrival_to_site_date" id="expected_arrival_to_site_date" class="form-control @error('expected_arrival_to_site_date') is-invalid @enderror" value="{{ old('expected_arrival_to_site_date') }}" required autofocus>
                            @error('expected_arrival_to_site_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <input type="date" name="expected_arrival_to_site_date" id="expected_arrival_to_site_date-hidden" hidden>

                        {{-- actual_process_date --}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.actual_process_date')<span class="text-danger">*</span></label>
                            <input type="date" name="actual_process_date" id="actual_process_date" class="form-control actual @error('actual_process_date') is-invalid @enderror" value="{{ old('actual_process_date') }}" required autofocus max="{{ date('Y-m-d', strtotime( now() )) }}">
                            @error('actual_process_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- actual_po_released_date --}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.actual_po_released_date')<span class="text-danger">*</span></label>
                            <input type="date" name="actual_po_released_date" id="actual_po_released_date" class="form-control actual @error('actual_po_released_date') is-invalid @enderror" value="{{ old('actual_po_released_date') }}" required autofocus max="{{ date('Y-m-d', strtotime( now() )) }}">
                            @error('actual_po_released_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- actual_payment_transfer_date --}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.actual_payment_transfer_date')<span class="text-danger">*</span></label>
                            <input type="date" name="actual_payment_transfer_date" id="actual_payment_transfer_date" class="form-control actual @error('actual_payment_transfer_date') is-invalid @enderror" value="{{ old('actual_payment_transfer_date') }}" required autofocus max="{{ date('Y-m-d', strtotime( now() )) }}">
                            @error('actual_payment_transfer_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- actual_shipment_pickup_date --}}
                        <div class="form-group col-6">
                            <label>@lang('eirs.actual_shipment_pickup_date')<span class="text-danger">*</span></label>
                            <input type="date" name="actual_shipment_pickup_date" id="actual_shipment_pickup_date" class="form-control actual @error('actual_shipment_pickup_date') is-invalid @enderror" value="{{ old('actual_shipment_pickup_date') }}" required autofocus max="{{ date('Y-m-d', strtotime( now() )) }}">
                            @error('actual_shipment_pickup_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- actual_arrival_to_site_date --}}
                        <div class="form-group col-12">
                            <label>@lang('eirs.actual_arrival_to_site_date')<span class="text-danger">*</span></label>
                            <input type="date" name="actual_arrival_to_site_date" id="actual_arrival_to_site_date" class="form-control actual @error('actual_arrival_to_site_date') is-invalid @enderror" value="{{ old('actual_arrival_to_site_date') }}" required autofocus max="{{ date('Y-m-d', strtotime( now() )) }}">
                            @error('actual_arrival_to_site_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @php
                            $status = ['Under Review', 'Approved', 'PO Placed', 'Payment Processed', 'Part In Transit', 'Delivered To Site'];
                        @endphp

                        {{--$enum--}}
                        <div class="form-group">
                            <label>@lang('eirs.status' ) <span class="text-danger">*</span></label>
                            <select id="status" disabled class="form-control select2 @error('status') custom-select @enderror" required>
                                <option value="">@lang('site.choose') @lang('eirs.status')</option>
                                @foreach ($status as $statu)
                                    <option value="{{ $statu }}" {{ $statu == old('status') ? 'selected' : '' }}>{{ $statu }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="text" name="status" value="{{ old('status') }}" id="statu-hidden" hidden>


                        {{-- attachments --}}
                        <div class="form-group">
                            <label>@lang('eirs.attachments') <span class="text-danger">*</span></label>
                            <input type="file" name="attachments[]" autofocus class="form-control @error('attachments') is-invalid @enderror" value="{{ old('attachments') }}" required>
                            @error('attachments')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <h3>
                            <button class="btn btn-primary" id="add-request-part">
                                <i class="fa fa-plus"></i>
                            </button>
                            @lang('request_parts.request_parts')
                        </h3>
                        <hr/>
                        {{-- request part --}}
                        <div class="row" id="append-request-part">

                                
                            <div class="row">

                                <div class="col-1">
                                    <button class="btn btn-danger remove-form-request-part">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </div>

                                <div class="form-group col-5">
                                    <input type="number" disabled name="requested_part_no" class="form-control" required autofocus placeholder="Requested Part No">
                                </div>

                                <div class="form-group col-6">
                                    <input type="text" name="requested_part" class="form-control" required autofocus placeholder="Requested Part">
                                </div>

                                <div class="form-group col-6">
                                    <input type="number" name="quantity" class="form-control" required autofocus placeholder="Quantity">
                                </div>

                                <div class="form-group col-6">
                                    <input type="text" name="unit" class="form-control" required autofocus placeholder="Unit">
                                </div>
                                
                            </div>
                            
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                        </div>

                    </div>{{-- row --}}
                

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

@push('scripts')
    
    <script>

        $(document).ready(function() {

            $(document).on('click', '#add-request-part', function(e) {
                e.preventDefault();

                let html = `<div class="row">

                                <div class="col-1">
                                    <button class="btn btn-danger remove-form-request-part">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </div>

                                <div class="form-group col-5">
                                    <input type="number" disabled name="requested_part_no" class="form-control" required autofocus placeholder="Requested Part No">
                                </div>

                                <div class="form-group col-6">
                                    <input type="text" name="requested_part" class="form-control" required autofocus placeholder="Requested Part">
                                </div>

                                <div class="form-group col-6">
                                    <input type="number" name="quantity" class="form-control" required autofocus placeholder="Quantity">
                                </div>

                                <div class="form-group col-6">
                                    <input type="text" name="unit" class="form-control" required autofocus placeholder="Unit">
                                </div>
                                
                            </div>
                            
                        </div>`;

                $('#append-request-part').append(html);

            });//end of change

            $(document).on('click', '.remove-form-request-part', function(e) {
                e.preventDefault();

                $(this).closest('.row').remove();

            });//end of change

            function calculateDays(Countdays, startDay) {
                
                var startDate = new Date(startDay),
                    days      = parseInt(Countdays);

                var newDate = startDate.setDate(startDate.getDate() + days);

                return new Date(newDate).toLocaleDateString('en-CA');

            }//end of fun
            
            $(document).on('change', '.actual', function(e) {
                e.preventDefault();

                var name = $(this).attr('name');

                if(name == 'date') {

                    $('#status').val('Under Review').change();
                    $('#statu-hidden').val('Under Review');

                    let date = $(this).val();
                    $('#actual_process_date').attr('min', date);

                    ////////////////////////////////////////

                    $('#expected_process_date').val(calculateDays(2, date));
                    $('#expected_process_date-hidden').val(calculateDays(2, date));

                    ////////////////////////////////////////

                    var expectedProcessDate = $('#expected_process_date').val();

                    $('#expected_po_released_date').val(calculateDays(10, expectedProcessDate));//2
                    $('#expected_po_released_date-hidden').val(calculateDays(10, expectedProcessDate));//2

                    ////////////////////////////////////////

                    var expectedPaymentTransferDate = $('#expected_po_released_date').val();//3

                    $('#expected_payment_transfer_date').val(calculateDays(14, expectedPaymentTransferDate));//2
                    $('#expected_payment_transfer_date-hidden').val(calculateDays(14, expectedPaymentTransferDate));//2

                    ////////////////////////////////////////

                    var expectedShipmentPickupDate = $('#expected_payment_transfer_date').val();//3

                    $('#expected_shipment_pickup_date').val(calculateDays(14, expectedShipmentPickupDate));//2
                    $('#expected_shipment_pickup_date-hidden').val(calculateDays(14, expectedShipmentPickupDate));//2

                    ////////////////////////////////////////

                    var expectedArrivalToSiteDate = $('#expected_shipment_pickup_date').val();//3

                    $('#expected_arrival_to_site_date').val(calculateDays(7, expectedArrivalToSiteDate));//2
                    $('#expected_arrival_to_site_date-hidden').val(calculateDays(7, expectedArrivalToSiteDate));//2


                }//end of if

                if(name == 'actual_process_date') {
                    $('#status').val('Approved').change();
                    $('#statu-hidden').val('Approved');
                }

                if(name == 'actual_po_released_date') {
                    $('#status').val('PO Placed').change();
                    $('#statu-hidden').val('PO Placed');
                }

                if(name == 'actual_payment_transfer_date') {
                    $('#status').val('Payment Processed').change();
                    $('#statu-hidden').val('Payment Processed');
                }

                if(name == 'actual_shipment_pickup_date') {
                    $('#status').val('Part In Transit').change();
                    $('#statu-hidden').val('Part In Transit');
                }

                if(name == 'actual_arrival_to_site_date') {
                    $('#status').val('Delivered To Site').change();
                    $('#statu-hidden').val('Delivered To Site');
                }

            });//end of change

            $(document).on('change', '#actual_process_date', function(e) {
                e.preventDefault();

                let date = $(this).val();

                $('#actual_po_released_date').attr('min', date);

            });//end of change

            $(document).on('change', '#actual_po_released_date', function(e) {
                e.preventDefault();

                let date = $(this).val();

                $('#actual_payment_transfer_date').attr('min', date);

            });//end of change

            $(document).on('change', '#actual_payment_transfer_date', function(e) {
                e.preventDefault();

                let date = $(this).val();

                $('#actual_shipment_pickup_date').attr('min', date);

            });//end of change

            $(document).on('change', '#actual_shipment_pickup_date', function(e) {
                e.preventDefault();

                let date = $(this).val();

                $('#actual_arrival_to_site_date').attr('min', date);

            });//end of change

        });//end of redy fun

        //select 2
        $('.select2').select2({
            'width': '100%',
            'tags': false,
            'minimumResultsForSearch': Infinity
        });

    </script>

@endpush