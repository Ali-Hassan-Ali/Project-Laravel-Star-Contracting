@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('spares.spares')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.spares.index') }}">@lang('spares.spares')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.spares.store') }}" enctype="multipart/form-data">
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

                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('spares.name')<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    @php
                        $status = [1, 0];
                        $enums = ['used', 'part_no'];
                    @endphp

                    @foreach ($enums as $enum)
                        
                        {{--$enum--}}
                        <div class="form-group">
                            <label>@lang('spares.' . $enum) <span class="text-danger">*</span></label>
                            <select name="{{ $enum }}" class="form-control select2 @error($enum) custom-select @enderror" required>
                                <option value="">@lang('site.choose') @lang('spares.' . $enum)</option>
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

                    @php
                        $numbers = ['freight_charges','cost','location'];
                    @endphp

                    @foreach ($numbers as $number)
                        
                        {{--$number--}}
                        <div class="form-group">
                            <label>@lang('spares.' . $number)<span class="text-danger">*</span></label>
                            <input type="number" name="{{ $number }}" class="form-control @error($number) is-invalid @enderror" value="{{ old($number) }}" required autofocus>
                            @error($number)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    @endforeach

                    {{-- usage_date --}}
                    <div class="form-group">
                        <label>@lang('insurances.usage_date') <span class="text-danger">*</span></label>
                        <input type="date" name="usage_date" autofocus class="form-control @error('usage_date') is-invalid @enderror" value="{{ old('usage_date') }}" required>
                        @error('usage_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- description --}}
                    <div class="form-group">
                        <label>@lang('spares.description') <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="6">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    {{-- attachments --}}
                    <div class="form-group">
                        <label>@lang('insurances.attachments') <span class="text-danger">*</span></label>
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


