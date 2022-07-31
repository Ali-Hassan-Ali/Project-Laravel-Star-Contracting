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

                    {{--equipment_id--}}
                    <div class="form-group @error('equipment_id') custom-select @enderror">
                        <label>@lang('equipments.equipments') <span class="text-danger">*</span></label>
                        <select name="equipment_id" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('equipments.equipments')</option>
                            @foreach ($equipments as $equipment)
                                <option value="{{ $equipment->id }}" {{ $equipment->id == old('equipment_id') ? 'selected' : '' }}>{{ $equipment->name }}</option>
                            @endforeach
                        </select>
                        @error('equipment_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    @php
                        $numbers    = ['eir_no'];
                        $textareas  = ['description'];
                        $data_times_expected = ['expected_process_date','expected_po_released_date','expected_payment_transfer_date',
                                       'expected_shipment_pickup_date','expected_arrival_to_site_date'];

                       $data_times = ['actual_process_date','actual_po_released_date',
                                       'actual_payment_transfer_date','actual_shipment_pickup_date',
                                       'actual_arrival_to_site_date'];
                    @endphp

                    @foreach ($numbers as $number)
                        
                        {{--$number--}}
                        <div class="form-group">
                            <label>@lang('eirs.' . $number)<span class="text-danger">*</span></label>
                            <input type="number" name="{{ $number }}" class="form-control @error($number) is-invalid @enderror" value="{{ old($number) }}" required autofocus>
                            @error($number)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    @endforeach

                    {{--$expected--}}
                    <div class="form-group">
                        <label>@lang('eirs.date')<span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}" required autofocus>
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @foreach ($data_times_expected as $expected)
                        
                        {{--$expected--}}
                        <div class="form-group">
                            <label>@lang('eirs.' . $expected)<span class="text-danger">*</span></label>
                            <input type="date" disabled name="{{ $expected }}" class="form-control @error($expected) is-invalid @enderror" value="{{ old($expected) }}" required autofocus>
                            @error($expected)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    @endforeach


                    @foreach ($data_times as $data_time)
                        
                        {{--$data_time--}}
                        <div class="form-group">
                            <label>@lang('eirs.' . $data_time)<span class="text-danger">*</span></label>
                            <input type="date" name="{{ $data_time }}" class="form-control @error($data_time) is-invalid @enderror" value="{{ old($data_time) }}" required autofocus>
                            @error($data_time)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    @endforeach
                    @foreach ($textareas as $textarea)
                        
                        {{-- $textarea --}}
                        <div class="form-group">
                            <label>@lang('eirs.'.$textarea) <span class="text-danger">*</span></label>
                            <textarea class="form-control @error($textarea) is-invalid @enderror" name="{{ $textarea }}" rows="6">{{ old($textarea) }}</textarea>
                            @error($textarea)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    @endforeach

                    @php
                        $status = [1, 0];
                        $enums  = ['status'];
                    @endphp

                    @foreach ($enums as $enum)
                        
                        {{--$enum--}}
                        <div class="form-group">
                            <label>@lang('eirs.' . $enum) <span class="text-danger">*</span></label>
                            <select name="{{ $enum }}" class="form-control select2 @error($enum) custom-select @enderror" required>
                                <option value="">@lang('site.choose') @lang('eirs.' . $enum)</option>
                                @foreach ($status as $statu)
                                    <option value="{{ $statu }}" {{ $statu == old($enum) ? 'selected' : '' }}>@lang('site.' . $statu)</option>
                                @endforeach
                            </select>
                            @error($enum)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    @endforeach

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


