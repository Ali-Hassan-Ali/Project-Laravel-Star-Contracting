@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('combo_boxs.combo_boxs')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.combo_boxs.index') }}">@lang('combo_boxs.combo_boxs')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.combo_boxs.update', $ComboBox->id) }}">
                    @csrf
                    @method('put')

                    {{--name--}}
                    <div class="form-group">
                        <label>@lang('combo_boxs.name')<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $ComboBox->name) }}" required autofocus>
                    </div>

                    @php
                        $combo_boxs = ['make', 'model', 'owner_ship', 'equipment', 'equipment', 'rental_basis', 'operator', 'responsible_person', 'responsible_person_email', 'allocated_to', 'project_allocated_to', 'insurer', 'location', 'non_scheduled', 'unit'];
                    @endphp

                    {{--type--}}
                    <div class="form-group @error('type') custom-select @enderror">
                        <label>@lang('combo_boxs.type') <span class="text-danger">*</span></label>
                        <select name="type" class="form-control select2" required>
                            <option value="">@lang('site.choose') @lang('combo_boxs.type')</option>
                            @foreach ($combo_boxs as $box)
                                <option value="{{ $box }}" {{ $box == old('type', $ComboBox->type) ? 'selected' : '' }}>
                                    {{ $box }}
                                </option>
                            @endforeach
                        </select>
                        @error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

