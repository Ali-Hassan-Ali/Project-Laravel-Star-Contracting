<table class="table table-bordered">
  <thead>
  <tr>
    <th class="text-center">@lang('site.DT_RowIndex')</th>
    <th class="text-center">@lang('citys.citys')</th>
    <th class="text-center">@lang('equipments.equipments')</th>
    <th class="text-center">@lang('status.status')</th>
    <th class="text-center">@lang('status.as_of')</th>
  </tr>
  </thead>
  <tbody>
    @if($equipmens->count() > 0)

      @foreach($equipmens as $index=>$equipment)
        <tr>
          <th class="text-center">{{ $index + 1 }}</th>
          <td class="text-center">{{ $equipment->city->name }}</td>
          <td class="text-center">{{ $equipment->make .' '. $equipment->name .' '. $equipment->plate_no }}</td>
          <td class="text-center">Breakdown</td>
          <td class="text-center">{{ isset($equipment->statusBreakdown->first()->as_of) ? 
                                     date('d-m-Y', strtotime($equipment->statusBreakdown->first()->as_of)) : '' }}</td>
        </tr>
      @endforeach

    @endif
  </tbody>
</table>