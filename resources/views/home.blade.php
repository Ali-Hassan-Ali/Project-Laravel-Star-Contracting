@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p>{{ __('You are logged in!') }}</p>

                        <a href="{{ route('admin.home') }}" class="btn btn-primary">Admin Dashboard</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection






@extends('layouts.admin.app')

@section('content')

    <div>
        <h2>@lang('reports.breakdown_overview')</h2>
    </div>

    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.equipments.index') }}">@lang('equipments.equipments')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.status.index') }}">@lang('status.status')</a></li>
    </ul>

    @foreach ($citys as $city)

        @if ($city->equipments()->count())

        <div class="row">

            <div class="col-md-12">

                <div class="tile shadow">
                    
                    <div class="table-responsive">

                        <div class="col-md-12">
                            
                            <div class="d-flex">
                                <div class="p-2"><h3>{{ $city->name }}</h3></div>
                                <div class="ml-auto p-3">
                                    <div class="form-check form-switch" data-toggle="collapse" href="#collapse{{ $city->id }}" role="button" aria-expanded="false" aria-controls="collapse{{ $city->id }}">
                                        <label class="form-check-label mr-5">@lang('reports.show_details')</label>
                                        <input class="form-check-input" type="checkbox">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="collapse" id="collapse{{ $city->id }}">
                            @php
                                $no_of_break_down = 0;
                                $total_average_break_down_duration = 0;
                            @endphp
                            @foreach ($city->equipments as $index=>$equipment)
                            @if ($equipment->status()->count() > 0)

                                <strong>
                                    @lang('equipments.equipments') | {{ $equipment->make . ' ' . $equipment->name  . ' ' . $equipment->plate_no }}
                                </strong>
            
                                <div class="table-responsive-sm">
                                    <table class="table table-sm table-bordered table-hover">
                                    
                                    <thead {{ $index == 0 ? '' : 'hidden' }}>
                                    <tr>
                                        <th class="text-center" style="width: 50px">@lang('status.as_of')</th>
                                        <th class="text-center" style="width: 50px">@lang('status.break_down_date')</th>
                                        <th class="text-center" style="width: 50px">@lang('status.break_down_duration')</th>
                                        <th class="text-center" style="width: 50px">@lang('eirs.idle')</th>
                                        <th class="text-center" style="width: 50px">@lang('eirs.date')</th>
                                        <th class="text-center" style="width: 50px">@lang('eirs.actual_arrival_to_site_date')</th>
                                        <th class="text-center" style="width: 50px">@lang('reports.eir_break_down_duration')</th>
                                        <th class="text-center" style="width: 50px">@lang('reports.total_break_down_duration')</th>
                                    </tr>
                                    </thead>
                                    
                                    <body>
                                        @php
                                            $average = 0;
                                            $average_break_down_duration = 0;
                                            $total_break_down_duration = !empty($equipment->eir->total_break_down_duration) ? $equipment->eir->total_break_down_duration : 0;
                                        @endphp
                                        @foreach ($equipment->status as $statu)
                                            @php
                                                $average += $statu->break_down_duration + $total_break_down_duration;
                                                $average_break_down_duration += $statu->break_down_duration + $total_break_down_duration;
                                            @endphp
                                            <tr>
                                                <td class="text-center" style="width: 50px">{{ $statu->as_of ? date('d-m-Y', strtotime($statu->as_of)) : '-' }}</td>
                                                <td class="text-center" style="width: 50px">{{ $statu->break_down_date ? date('d-m-Y', strtotime($statu->break_down_date)) : '-' }}</td>
                                                <td class="text-center" style="width: 50px">{{ $statu->break_down_duration }}</td>
                                                <td class="text-center" style="width: 50px">{{ !empty($equipment->eir->idle) ? 'Yes' : 'No' }}</td>
                                                <td class="text-center" style="width: 50px">{{ !empty($equipment->eir->date) ? date('d-m-Y', strtotime($equipment->eir->date)) : '' }}</td>
                                                <td class="text-center" style="width: 50px">{{ !empty($equipment->eir->actual_arrival_to_site_date) ? date('d-m-Y', strtotime($equipment->eir->actual_arrival_to_site_date)) : '-' }}</td>
                                                <td class="text-center" style="width: 50px">{{ $total_break_down_duration }}</td>
                                                <td class="text-center" style="width: 50px">{{ $statu->break_down_duration + $total_break_down_duration }}</td>
                                            </tr>
                                        @endforeach
                                    </body>
                                    <tfoot>
                                    <tr>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px">{{ $equipment->status->count() }}</td>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px"></td>
                                        <td class="text-center" style="width: 50px">{{ $average / $equipment->status->count() }}</td>
                                        @php
                                            $no_of_break_down += $equipment->status->count();
                                            $total_average_break_down_duration += $average_break_down_duration;
                                        @endphp
                                    </tr>
                                    </tfoot>
                                    </table>
                                </div>
                            @endif
                            @endforeach
                            </div>{{-- end of collapse  --}}
                            <table class="table table-sm table-hover">
                                <tfoot>
                                <tr>
                                    <td class="text-center" style="width: 50px"></td>
                                    <td class="text-end" style="width: 50px"></td>
                                    <td class="text-center" style="width: 50px">@lang('reports.no_of_break_down')</td>
                                    <td class="text-center" style="width: 50px">{{ $no_of_break_down }}</td>
                                    <td class="text-end" style="width: 50px"></td>
                                    <td class="text-center" style="width: 50px"></td>
                                    <td class="text-center" style="width: 50px">@lang('reports.average_break_down_duration')</td>
                                    <td class="text-center" style="width: 50px">{{ $total_average_break_down_duration }}</td>
                                </tr>
                                </tfoot>
                            </table>

                        </div><!-- end of col -->

                    </div><!-- end of row -->

                </div><!-- end of tile -->

            </div><!-- end of col -->

        </div><!-- end of row -->

        @endif

    @endforeach

@endsection




$citys = City::with('equipments.status', 'equipments.eir')->get();

return view('admin.reports.breakdown_overview', compact('citys'));






























@extends('layouts.admin.app')

@section('content')
    
    <div>
        <h2>@lang('reports.spares_available')</h2>
    </div>
    
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item">@lang('reports.reports')</li>
        <li class="breadcrumb-item">@lang('reports.spares_available')</li>
    </ul>
    
    <div class="row">
        
        <div class="col-md-12">
            
            <div class="tile shadow">
                
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control col-6 select2-tags-false" id="data-table-search-city">
                                <option value="">@lang('site.all') @lang('citys.citys')</option>
                                @foreach ($citys as $city)
                                    <option data-id="{{ $city->id }}" value="{{ $city->name }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="d-flex flex-row-reverse">
                            <div class="form-check form-switch" data-toggle="collapse" href="#collapse{{ $city->id }}" role="button" aria-expanded="false" aria-controls="collapse{{ $city->id }}">
                                <label class="form-check-label mr-5">@lang('reports.show_details')</label>
                                <input class="form-check-input" type="checkbox">
                            </div>
                        </div>
                    </div>
                
                </div><!-- end of row -->
                
                <div class="collapse" id="collapse{{ $city->id }}">
                    
                    <div class="row">
                        
                        <div class="col-md-12">
                            
                            <div class="table-responsive">
                                
                                <table class="table datatable table-sm table-bordered table-hover" id="spares_available-table" style="width: 100%;">
                                    <thead>
                                    <tr>
                                        <th class="text-center">@lang('citys.citys')</th>
                                        <th class="text-center">@lang('equipments.equipments')</th>
                                        <th class="text-center">@lang('spares.name')</th>
                                        <th class="text-center">@lang('spares.part_no')</th>
                                        <th class="text-center">@lang('spares.cost')</th>
                                        <th class="text-center">@lang('spares.freight_charges')</th>
                                        <th class="text-center">@lang('spares.used')</th>
                                        <th class="text-center">@lang('spares.location')</th>
                                        <th class="text-center">@lang('reports.total_cost')</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <td class="text-center" style="width: 121px"></td>
                                        <td class="text-center" style="width: 116px"></td>
                                        <td class="text-center" style="width: 121px"></td>
                                        <td class="text-center" style="width: 121px"></td>
                                        <td class="text-center" style="width: 121px"></td>
                                        <td class="text-end" olspan="2">@lang('reports.total_cost_spare')</td>
                                        <td class="text-center" style="width: 50px">$ {{ $totalCostSpare }}</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            
                            </div><!-- end of table responsive -->
                        
                        </div><!-- end of col -->
                    
                    </div><!-- end of row -->
                
                </div>{{--end of collapse --}}
            
            </div><!-- end of tile -->
        
        </div><!-- end of col -->
    
    </div><!-- end of row -->

@endsection

@push('scripts')
    
    <script>
        let cityId;
        let DataTable = $('#spares_available-table').DataTable({
            dom: "Bfrtip",
            paging: false,
            serverSide: true,
            processing: true,
            "language": {
                "url": "{{ asset('admin_assets/datatable-lang/' . app()->getLocale() . '.json') }}"
            },
            ajax: {
                url: '{{ route('admin.spares_available.data') }}',
            },
            columns: [
                {data: 'site', name: 'site'},
                {data: 'equipments', name: 'equipments'},
                {data: 'name', name: 'name'},
                {data: 'part_no', name: 'part_no'},
                {data: 'cost', name: 'cost'},
                {data: 'cost', name: 'cost'},
                {data: 'used', name: 'used'},
                {data: 'location', name: 'location'},
                {data: 'total_cost', name: 'total_cost'},
            ],
            buttons: [{
                footer: true,
                extend: "pdf",
                pageSize: 'A4',
                title: `Star-Contracting`,
                className: 'btn btn-primary',
                text: '<i class="fa fa-file-pdf" aria-hidden="true"></i> PDF',
                customize: function(doc) {
                    doc.styles.tableBodyEven.alignment = 'center';
                    doc.styles.tableBodyOdd.alignment = 'center';
                    doc.styles.tableFooter.alignment = 'center';
                },
            }],
        });
        $('#data-table-search-city').change(function () {
            
            DataTable.search(this.value).draw();
            
            let url    = '{{ route('admin.spares_available.sum') }}';
            let count  = '{{ $spares->count() }}';
            var id     = $(this).find(':selected').data('id');
            var method = 'get';
            
            $.ajax({
                url: url,
                method: method,
                data: {city_id: id},
                success: function (data) {
                    let total = data.total / data.count;
                    let sum = $.number(total, 2);
                    $('.average').html(sum);
                    $('.average-min').html('Average Delivery Time ' + sum);
                }//end of success
            });//end of ajax
            
        });//end of data-table-search-city
    </script>

@endpush

















@extends('layouts.admin.app')

@section('content')
    
    <div>
        <h2>@lang('reports.eir_overview')</h2>
    </div>
    
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.equipments.index') }}">@lang('equipments.equipments')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.spares.index') }}">@lang('spares.spares')</a></li>
    </ul>
    
    @foreach ($citys as $city)
        
        @if ($city->equipments()->count() > 0)
            
            <div class="row">
                
                <div class="col-md-12">
                    
                    <div class="tile shadow">
                        
                        <div class="table-responsive">
                            
                            <div class="col-md-12">
                                
                                <div class="d-flex">
                                    <div class="p-2"><h3>{{ $city->name }}</h3></div>
                                    <div class="ml-auto p-3">
                                        <div class="form-check form-switch" data-toggle="collapse" href="#collapse{{ $city->id }}" role="button" aria-expanded="false" aria-controls="collapse{{ $city->id }}">
                                            <label class="form-check-label mr-5">@lang('reports.show_details')</label>
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="collapse" id="collapse{{ $city->id }}">
                                
                                    @foreach ($city->equipments as $index=>$equipment)
                                    
                                    @if ($equipment->eirs()->count() > 0)
                                        
                                        <strong>
                                            @lang('equipments.equipments') | {{ $equipment->make . ' ' . $equipment->name  . ' ' . $equipment->plate_no }}
                                        </strong>

                                        <table class="table table-sm table-bordered table-hover ml-3">
                                            @if ($index == 0)
                                                <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 150px">@lang('eirs.eir_no')</th>
                                                    <th class="text-center" style="width: 200px">@lang('eirs.date')</th>
                                                    <th class="text-center" style="width: 0px">@lang('eirs.status')</th>
                                                </tr>
                                                </thead>
                                            @endif
                                            <body>
                                            @foreach ($equipment->eirs as $eir)
                                                <tr>
                                                    <td class="text-center" style="width: 150px">{{ $eir->eir_no }}</td>
                                                    <td class="text-center" style="width: 200px">{{ $eir->date ? date('d-m-Y', strtotime($eir->date)) : '' }}</td>
                                                    <td class="text-center" style="width: 0px">{{ $eir->status }}</td>
                                                </tr>
                                            @endforeach
                                            </body>
                                            <tfoot>
                                            <tr>
                                                <td class="text-center" style="width: 150px"></td>
                                                <td class="text-end" style="width: 200px">@lang('reports.total_EIRs')</td>
                                                <td class="text-center" style="width: 0px">{{ $equipment->eirs->count() }}</td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    
                                    @endif
                                @endforeach
                                
                                </div>{{-- end of collapse  --}}
                            
                            </div><!-- end of col -->
                        
                        </div><!-- end of row -->
                    
                    </div><!-- end of tile -->
                
                </div><!-- end of col -->
            
            </div><!-- end of row -->
        
        @endif
    
    @endforeach

@endsection





@extends('layouts.admin.app')

@section('content')
    
    <div>
        <h2>@lang('reports.equipments_overview')</h2>
    </div>
    
    <ul class="breadcrumb mt-2">
        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.equipments.index') }}">@lang('equipments.equipments')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.spares.index') }}">@lang('spares.spares')</a></li>
    </ul>
    
    @foreach ($citys as $city)
        
        @if ($city->equipments()->count() > 0)
            
            <div class="row">
                
                <div class="col-md-12">
                    
                    <div class="tile shadow">
                        
                        <div class="table-responsive">
                            
                            <div class="col-md-12">
                                
                                <div class="d-flex">
                                    <div class="p-2"><h3>{{ $city->name }}</h3></div>
                                    <div class="ml-auto p-3">
                                        <div class="form-check form-switch" data-toggle="collapse" href="#collapse{{ $city->id }}" role="button" aria-expanded="false" aria-controls="collapse{{ $city->id }}">
                                            <label class="form-check-label mr-5">@lang('reports.show_details')</label>
                                            <input class="form-check-input" type="checkbox">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="collapse" id="collapse{{ $city->id }}">
                                    
                                    @foreach ($city->equipments as $index=>$equipment)
                                    
                                    @if ($equipment->count() > 0)
                                        
                                        <strong>
                                            @lang('equipments.equipments') | {{ $equipment->make . ' ' . $equipment->name  . ' ' . $equipment->plate_no }}
                                        </strong>
                                        
                                        @if($equipment->statusBreakdown->count() > 0)
                                            {{--status--}}
                                            <h4 class="ml-3">@lang('reports.table_status')</h4>
                                            <div class="table-responsive-sm">
                                                {{--status--}}
                                                <table class="table table-sm table-bordered table-hover ml-3">
                                                @if ($index == 0)
                                                <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 150px">@lang('status.as_of')</th>
                                                        <th class="text-center" style="width: 250px">@lang('status.working_status')</th>
                                                        <th class="text-center" style="width: 0px">@lang('status.break_down_date')</th>
                                                    </tr>
                                                    </thead>
                                                @endif
                                                <body>
                                                @foreach ($equipment->statusBreakdown as $statu)
                                                    <tr>
                                                        <td class="text-center" style="width: 150px">{{ $statu->as_of ? date('d-m-Y', strtotime($statu->as_of)) : '' }}</td>
                                                        <td class="text-center" style="width: 250px">{{ $statu->working_status }}</td>
                                                        <td class="text-center" style="width: 0px">{{ $statu->break_down_date ? date('d-m-Y', strtotime($statu->break_down_date)) : '' }}</td>
                                                    </tr>
                                                @endforeach
                                                </body>
                                                <tfoot>
                                                    <tr>
                                                        <td class="text-end" colspan="2" style="width: 250px">@lang('reports.no_of_break_down')</td>
                                                        <td class="text-center" style="width: 0px">{{ $equipment->statusBreakdown->count() }}</td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                        
                                        @if($equipment->eirs->count() > 0)
                                            {{--eir--}}
                                            <h4 class="ml-3">@lang('reports.table_EIRs')</h4>
                                            <div class="table-responsive-sm">
                                                {{--status--}}
                                                <table class="table table-sm table-bordered table-hover ml-3">
                                                    @if ($index == 0)
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="width: 150px">@lang('eirs.date')</th>
                                                            <th class="text-center" style="width: 250px">@lang('eirs.eir_no')</th>
                                                            <th class="text-center" style="width: 0px">@lang('eirs.status')</th>
                                                        </tr>
                                                        </thead>
                                                    @endif
                                                    <body>
                                                    @foreach ($equipment->eirs as $eir)
                                                        <tr>
                                                            <td class="text-center" style="width: 150px">{{ $eir->date ? date('d-m-Y', strtotime($eir->date)) : '' }}</td>
                                                            <td class="text-center" style="width: 250px">{{ $eir->eir_no }}</td>
                                                            <td class="text-center" style="width: 0px">{{ $eir->status }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </body>
                                                    <tfoot>
                                                    <tr>
                                                        <td class="text-end" colspan="2" style="width: 250px">@lang('reports.total_EIRs')</td>
                                                        <td class="text-center" style="width: 0px">{{ $equipment->eirs->count() }}</td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                        
                                        @if($equipment->sparesUsed->count() > 0)
                                            {{--spares--}}
                                            <h4 class="ml-3">@lang('reports.table_spares')</h4>
                                            <div class="table-responsive-sm">
                                                {{--spares--}}
                                                <table class="table table-sm table-bordered table-hover ml-3">
                                                    @if ($index == 0)
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center" style="width: 50px">@lang('spares.used')</th>
                                                        <th class="text-center" style="width: 50px">@lang('spares.cost')</th>
                                                        <th class="text-center" style="width: 50px">@lang('spares.freight_charges')</th>
                                                        <th class="text-center" style="width: 50px">@lang('reports.total_cost_of_used_spares')</th>
                                                    </tr>
                                                    </thead>
                                                    @endif
                                                    <body>
                                                    @php
                                                        $total_cost_of_used_spares = 0;
                                                    @endphp
                                                    @foreach ($equipment->sparesUsed as $spare)
                                                        @php
                                                            $total_cost_of_used_spares += $spare->cost + $spare->freight_charges;
                                                        @endphp
                                                        <tr>
                                                            <td class="text-center" style="width: 50px">{{ $spare->used ? 'Yes' : 'No' }}</td>
                                                            <td class="text-center" style="width: 50px">{{ $spare->cost }}</td>
                                                            <td class="text-center" style="width: 50px">{{ $spare->freight_charges }}</td>
                                                            <td class="text-center" style="width: 50px">{{ $spare->cost + $spare->freight_charges }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </body>
                                                    <tfoot>
                                                    <tr>
                                                        <td class="text-center" style="width: 05px">{{ $equipment->sparesUsed->count() }}</td>
                                                        <td class="text-center" style="width: 50px"></td>
                                                        <td class="text-center" style="width: 50px"></td>
                                                        <td class="text-center" style="width: 50px">{{ $total_cost_of_used_spares }}</td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                        
                                        @if($equipment->fuels->count() > 0)
                                            {{--fuels--}}
                                            <h4 class="ml-3">@lang('reports.table_fuel')</h4>
                                            <div class="table-responsive-sm">
                                                {{--fuels--}}
                                                <table class="table table-sm table-bordered table-hover ml-3">
                                                    @if ($index == 0)
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="width: 50px">@lang('fuels.no_of_units_filled')</th>
                                                            <th class="text-center" style="width: 50px">@lang('fuels.total_cost_of_fuel')</th>
                                                        </tr>
                                                        </thead>
                                                    @endif
                                                    <body>
                                                    @foreach ($equipment->fuels as $fuel)
                                                    <tr>
                                                            <td class="text-center" style="width: 50px">{{ $fuel->no_of_units_filled }}</td>
                                                            <td class="text-center" style="width: 50px">{{ $fuel->total_cost_of_fuel}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </body>
                                                    <tfoot>
                                                    <tr>
                                                        <td class="text-center" style="width: 50px">{{ $equipment->fuels->sum('no_of_units_filled') }}</td>
                                                        <td class="text-center" style="width: 50px">{{ $equipment->fuels->sum('total_cost_of_fuel') }}</td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    
                                    @endif
                                @endforeach
                                
                                </div>{{-- end of collapse  --}}
                            
                            </div><!-- end of col -->
                        
                        </div><!-- end of row -->
                    
                    </div><!-- end of tile -->
                
                </div><!-- end of col -->
            
            </div><!-- end of row -->
        
        @endif
    
    @endforeach
total hours workedZ