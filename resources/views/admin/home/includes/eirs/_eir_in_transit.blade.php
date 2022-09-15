<table class="table table-bordered">
  <thead>
  <tr>
    <th class="text-center">@lang('site.DT_RowIndex')</th>
    <th class="text-center">@lang('citys.citys')</th>
    <th class="text-center">@lang('eirs.eir_no')</th>
    <th class="text-center">@lang('eirs.date')</th>
    <th class="text-center">@lang('equipments.equipments')</th>
    <th class="text-center">@lang('eirs.actual_arrival_to_site_date')</th>
  </tr>
  </thead>
  <tbody>
    @if($eirs->count() > 0)

      @foreach($eirs as $index=>$eir)
        <tr>
          <th class="text-center">{{ $index + 1 }}</th>
          <td class="text-center">{{ $eir->equipment->city->name }}</td>
          <td class="text-center">{{ $eir->eir_no }}</td>
          <td class="text-center">{{ $eir->date ? date('Y-m-d', strtotime($eir->date)) : '' }}</td>
          <td class="text-center">{{ $eir->equipment->make .' '. $eir->equipment->name .' '. $eir->equipment->plate_no }}</td>
          <td class="text-center">{{ $eir->actual_arrival_to_site_date ? date('Y-m-d', strtotime($eir->actual_arrival_to_site_date)) : '' }}</td>
        </tr>
      @endforeach

    @endif
  </tbody>
</table>