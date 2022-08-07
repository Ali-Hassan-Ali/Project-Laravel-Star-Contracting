@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('equipments.equipments')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.equipments.index') }}">@lang('equipments.equipments')</a></li>
        <li class="breadcrumb-item">@lang('site.edit')</li>
    </ul>

    <div class="row">

        <div class="col-md-12">

            <div class="tile shadow">

                <form method="post" action="{{ route('admin.equipments.update', $equipment->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    @include('admin.partials._errors')

                    <div class="row">

                        {{--make--}}
                        <div class="form-group col-6 @error('make') custom-select @enderror">
                            <label>@lang('equipments.make') <span class="text-danger">*</span></label>
                            <select name="make" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('equipments.make')</option>
                                @foreach ($makes as $make)
                                    <option value="{{ $make->name }}" {{ $make->name == old('make', $equipment->make) ? 'selected' : '' }}>{{ $make->name }}</option>
                                @endforeach
                            </select>
                            @error('make')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--equipments--}}
                        <div class="form-group col-6 @error('equipments') custom-select @enderror">
                            <label>@lang('equipments.name') <span class="text-danger">*</span></label>
                            <select name="name" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('equipments.name')</option>
                                @foreach ($equis as $equi)
                                    <option value="{{ $equi->name }}" {{ $equi->name == old('name', $equipment->name) ? 'selected' : '' }}>{{ $equi->name }}</option>
                                @endforeach
                            </select>
                            @error('equipment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--types--}}
                        <div class="form-group col-6">
                            <label>@lang('types.types') <span class="text-danger">*</span></label>
                            <select name="type" id="types-equipment" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('types.types')</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->name }}" {{ $type->name == old('type', $equipment->type) ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--specs--}}
                        <div class="form-group col-6">
                            <label>@lang('specs.specs') <span class="text-danger">*</span></label>
                            <select name="spec_id" id="spec-id" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('specs.specs')</option>
                                @foreach ($specs as $spec)
                                    <option value="{{ $spec->id }}" {{ $spec->id == old('spec_id', $equipment->spec_id) ? 'selected' : '' }}>{{ $spec->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--plate_no--}}
                        <div class="form-group col-6">
                            <label>@lang('equipments.plate_no')</label>
                            <input type="text" name="plate_no" class="form-control @error('plate_no') custom-select @enderror" value="{{ old('plate_no', $equipment->plate_no) }}" autofocus>
                            @error('plate_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--chasis_no--}}
                        <div class="form-group col-6">
                            <label>@lang('equipments.chasis_no')</label>
                            <input type="text" name="chasis_no" class="form-control @error('engine_no') custom-select @enderror" value="{{ old('chasis_no', $equipment->chasis_no) }}" autofocus>
                            @error('engine_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--engine_no--}}
                        <div class="form-group col-6">
                            <label>@lang('equipments.engine_no')</label>
                            <input type="text" name="engine_no" class="form-control @error('engine_no') custom-select @enderror" value="{{ old('engine_no', $equipment->engine_no) }}" autofocus>
                            @error('engine_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--serial_no--}}
                        <div class="form-group col-6">
                            <label>@lang('equipments.serial_no')</label>
                            <input type="text" name="serial_no" class="form-control @error('serial_no') custom-select @enderror" value="{{ old('serial_no', $equipment->serial_no) }}" autofocus>
                            @error('serial_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--model--}}
                        <div class="form-group col-6 @error('model') custom-select @enderror">
                            <label>@lang('equipments.model')</label>
                            <select name="model" class="form-control select2">
                                <option value="" selected>@lang('site.null') @lang('equipments.model')</option>
                                @foreach ($models as $model)
                                    <option value="{{ $model->name }}" {{ $model->name == old('model', $equipment->model) ? 'selected' : '' }}>{{ $model->name }}</option>
                                @endforeach
                            </select>
                            @error('model')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        {{--year_of_manufacture--}}
                        <div class="form-group col-6">
                            <label>@lang('equipments.year_of_manufacture')</label>
                            <input type="test" name="year_of_manufacture" class="form-control @error('year_of_manufacture') custom-select @enderror" value="{{ old('year_of_manufacture', $equipment->year_of_manufacture) }}" autofocus>
                            @error('year_of_manufacture')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--registration_expiry--}}
                        <div class="form-group col-12">
                            <label>@lang('equipments.registration_expiry')</label>
                            <input {{ old('type', $equipment->type) == 'Vehicle' ? '' : 'disabled' }} id="registration-expiry" type="date" name="registration_expiry" class="form-control @error('registration_expiry') custom-select @enderror" value="{{  old('registration_expiry', $equipment->registration_expiry ? date('Y-m-d', strtotime($equipment->registration_expiry)) : '') }}" autofocus>
                            @error('registration_expiry')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--countrys--}}
                        <div class="form-group col-6">
                            <label>@lang('countrys.countrys') <span class="text-danger">*</span></label>
                            <select name="country_id" id="country" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('countrys.countrys')</option>
                                @foreach ($countrys as $country)
                                    <option value="{{ $country->id }}" {{ $country->id == old('country_id', $equipment->country_id) ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--citys--}}
                        <div class="form-group col-6">
                            <label>@lang('citys.citys') <span class="text-danger">*</span></label>
                            <select name="city_id" id="city" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('citys.citys')</option>
                                @foreach ($citys as $city)
                                    <option value="{{ $city->id }}" {{ $city->id == old('city_id', $equipment->city_id) ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{--owner_ship--}}
                        <div class="form-group col-6 @error('owner_ship') custom-select @enderror">
                            <label>@lang('equipments.owner_ship') <span class="text-danger">*</span></label>
                            <select name="owner_ship" id="owner-ship" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('equipments.owner_ship')</option>
                                @foreach ($owner_ship as $owner)
                                    <option value="{{ $owner->name }}" {{ $owner->name == old('owner_ship', $equipment->owner_ship) ? 'selected' : '' }}>{{ $owner->name }}</option>
                                @endforeach
                            </select>
                            @error('owner_ship')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        {{--rental_basis--}}
                        <div class="form-group col-6 @error('rental_basis') custom-select @enderror">
                            <label>@lang('equipments.rental_basis') <span class="text-danger">*</span></label>
                            <select name="rental_basis" {{ old('owner_ship', $equipment->owner_ship) == 'Rented' ? '' : 'disabled' }} id="rental-basis" class="form-control select2">
                                <option value="" selected disabled>@lang('site.choose') @lang('equipments.rental_basis')</option>
                                @foreach ($rental_basis as $rental)
                                    <option value="{{ $rental->name }}" {{ $rental->name == old('rental_basis', $equipment->rental_basis) ? 'selected' : '' }}>{{ $rental->name }}</option>
                                @endforeach
                            </select>
                            @error('rental_basis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--rental_cost_basis--}}
                        <div class="form-group col-6">
                            <label>@lang('equipments.rental_cost_basis')<span class="text-danger">*</span></label>
                            <input type="test" name="rental_cost_basis" {{ old('owner_ship', $equipment->owner_ship) == 'Rented' ? '' : 'disabled' }} id="rental-cost-basis" class="form-control @error('rental_cost_basis') custom-select @enderror" value="{{ old('rental_cost_basis', $equipment->rental_cost_basis) }}" autofocus>
                            @error('rental_cost_basis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>




                        {{--operator--}}
                        <div class="form-group col-6 @error('operator') custom-select @enderror">
                            <label>@lang('equipments.operator') <span class="text-danger">*</span></label>
                            <select name="operator" id="operator" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('equipments.operator')</option>
                                @foreach ($operators as $operator)
                                    <option value="{{ $operator->name }}" {{ $operator->name == old('operator', $equipment->operator) ? 'selected' : '' }}>{{ $operator->name }}</option>
                                @endforeach
                            </select>
                            @error('operator')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--driver_salary--}}
                        <div class="form-group col-6">
                            <label>@lang('equipments.driver_salary')<span class="text-danger">*</span></label>
                            <input type="text" {{ old('operator', $equipment->operator) == 'driver' ? '' : 'disabled' }} id="driver-salary" name="driver_salary" class="form-control @error('driver_salary') custom-select @enderror" value="{{ old('driver_salary', $equipment->driver_salary) }}" required autofocus>
                            @error('driver_salary')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        {{--responsible_person--}}
                        <div class="form-group col-6 @error('responsible_person') custom-select @enderror">
                            <label>@lang('equipments.responsible_person') <span class="text-danger">*</span></label>
                            <select name="responsible_person" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('equipments.responsible_person')</option>
                                @foreach ($responsible_person as $person)
                                    <option value="{{ $person->name }}" {{ $person->name == old('responsible_person', $equipment->responsible_person) ? 'selected' : '' }}>{{ $person->name }}</option>
                                @endforeach
                            </select>
                            @error('responsible_person')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        {{--email--}}
                        <div class="form-group col-6 @error('email') custom-select @enderror">
                            <label>@lang('equipments.email') <span class="text-danger">*</span></label>
                            <select name="email" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('equipments.email')</option>
                                @foreach ($responsible_person_email as $email)
                                    <option value="{{ $email->name }}" {{ $email->name == old('email', $equipment->email) ? 'selected' : '' }}>{{ $email->name }}</option>
                                @endforeach
                            </select>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{--allocated_to--}}
                        <div class="form-group col-6 @error('allocated_to') custom-select @enderror">
                            <label>@lang('equipments.allocated_to') <span class="text-danger">*</span></label>
                            <select name="allocated_to" id="allocated-to" class="form-control select2" required>
                                <option value="" selected disabled>@lang('site.choose') @lang('equipments.allocated_to')</option>
                                @foreach ($allocated_to as $allocated)
                                    <option value="{{ $allocated->name }}" {{ $allocated->name == old('allocated_to', $equipment->allocated_to) ? 'selected' : '' }}>{{ $allocated->name }}</option>
                                @endforeach
                            </select>
                            @error('allocated_to')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{--project_allocated_to--}}
                        <div class="form-group col-6 @error('project_allocated_to') custom-select @enderror">
                            <label>@lang('equipments.project_allocated_to') <span class="text-danger">*</span></label>
                            <select name="project_allocated_to[]" {{ old('allocated_to', $equipment->allocated_to) == 'Project' ? '' : 'disabled' }} multiple id="project-allocated-to" class="form-control select2">
                                <option value="" disabled>@lang('site.choose') @lang('equipments.project_allocated_to')</option>
                                @foreach ($project_allocated_to as $project)
                                    <option value="{{ ucwords($project->name) }}" {{ in_array(ucwords($project->name), old('project_allocated_to', json_decode(ucwords($equipment->project_allocated_to)) ?? [])) ? 'selected' : '' }}>{{ $project->name }}</option>
                                @endforeach
                            </select>
                            @error('project_allocated_to')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- attachments --}}
                        <div class="form-group col-6">
                            <label>@lang('insurances.claim_attachments') <span class="text-danger">*</span></label>
                            <input type="file" name="attachments[]" multiple class="form-control @error('attachments') is-invalid @enderror" value="{{ old('attachments') }}">
                            @error('attachments')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>{{-- row --}}



                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('site.update')</button>
                    </div>

                </form><!-- end of form -->

            </div><!-- end of tile -->

        </div><!-- end of col -->

    </div><!-- end of row -->

@endsection

@push('scripts')

    <script>

        $('#country').on('change', function () {

            var value  = $(this).val();
            var method = 'post';
            var url    = "{{ route('admin.equipments.country') }}";

            $.ajax({
                url: url,
                method: method,
                data: {
                    country_id : value
                },
                success: function (data) {
                    
                    $('#city').empty('');
                    $('#city').append(`<option selected disabled>Choose city</option>`);

                    $.each(data, function(index,item) {

                        var html = `<option value="${item.id}">${item.name}</option>`;

                        $('#city').append(html);

                    });//end of each

                }//end of each
            });
            
        });//end of chage

        $('#types-equipment').on('change', function () {

            var value  = $(this).val();
            var method = 'post';
            var url    = "{{ route('admin.equipments.type') }}";

            $.ajax({
                url: url,
                method: method,
                data: {
                    type : value
                },
                success: function (data) {
                    
                    $('#spec-id').empty('');
                    $('#spec-id').append(`<option selected disabled>Choose</option>`);

                    $.each(data, function(index,item) {

                        var html = `<option value="${item.id}">${item.name}</option>`;

                        $('#spec-id').append(html);

                    });//end of each

                }//end of each
            });
            
            $('#registration-expiry').attr('disabled', value == 'Vehicle' ? false : true);

        });//end of chage
        
        $('#operator').on('change', function () {

            var value = $(this).val();

            alert(value);

            if (value == 'driver' || value == 'Driver') {

                $('#driver-salary').attr('disabled', false);

            } else {

                $('#driver-salary').attr('disabled', true);

            }//end of if
            
        });//end of chage

        
        $('#allocated-to').on('change', function () {
            
            var value = $(this).val();

            if (value == 'project' || value == 'Project') {

                $('#project-allocated-to').attr('disabled', false);

            } else {

                $('#project-allocated-to').attr('disabled', true);

            }//end of if
            
        });//end of chage

        $('#owner-ship').on('change', function () {
            
            var value = $(this).val();

            if (value == 'rented' || value == 'Rented') {

                $('#rental-cost-basis').attr('disabled', false);
                $('#rental-basis').attr('disabled', false);

            } else {

                $('#rental-cost-basis').attr('disabled', true);
                $('#rental-basis').attr('disabled', true);

            }//end of if
            
        });//end of chage


    </script>

@endpush