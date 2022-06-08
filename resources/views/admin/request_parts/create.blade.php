@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('request_parts.request_parts')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.request_parts.index') }}">@lang('request_parts.request_parts')</a></li>
        <li class="breadcrumb-item">@lang('site.create')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.request_parts.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('post')

                    {{--eir_id--}}
                    <div class="form-group @error('eir_id') custom-select @enderror">
                        <label>@lang('eirs.eirs') <span class="text-danger">*</span></label>
                        <select name="eir_id" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('eirs.eirs')</option>
                            @foreach ($eirs as $eir)
                                <option value="{{ $eir->id }}" {{ $eir->id == old('eir_id') ? 'selected' : '' }}>{{ $eir->description }}</option>
                            @endforeach
                        </select>
                        @error('eir_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    @php
                        $numbers    = ['quantity'];
                        $textareas  = ['requested_part', 'requested_part_no', 'unit'];
                    @endphp

                    @foreach ($numbers as $number)
                        
                        {{--$number--}}
                        <div class="form-group">
                            <label>@lang('request_parts.' . $number)<span class="text-danger">*</span></label>
                            <input type="number" name="{{ $number }}" class="form-control @error($number) is-invalid @enderror" value="{{ old($number) }}" required autofocus>
                            @error($number)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    @endforeach

                    @foreach ($textareas as $textarea)
                        
                        {{-- $textarea --}}
                        <div class="form-group">
                            <label>@lang('request_parts.'.$textarea) <span class="text-danger">*</span></label>
                            <textarea class="form-control @error($textarea) is-invalid @enderror" name="{{ $textarea }}" rows="6">{{ old($textarea) }}</textarea>
                            @error($textarea)
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                    @endforeach

                
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.create')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection


