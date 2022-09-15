<table class="table table-bordered">
  <thead>
  <tr>
    <th class="text-center">@lang('site.DT_RowIndex')</th>
    <th class="text-center">@lang('citys.citys')</th>
    <th class="text-center">@lang('equipments.equipments')</th>
    <th class="text-center">@lang('equipments.registration_expiry')</th>
    <th class="text-center">@lang('statistics.equipment_vehicle')</th>
  </tr>
  </thead>
  <tbody>
    @if($equipmens->count() > 0)

      @foreach($equipmens as $index=>$equipment)
        <tr>
          <th class="text-center">{{ $index + 1 }}</th>
          <td class="text-center">{{ $equipment->city->name }}</td>
          <td class="text-center">{{ $equipment->make .' '. $equipment->name .' '. $equipment->plate_no }}</td>
          <td class="text-center">{{ $equipment->registration_expiry ? date('d-m-Y', strtotime($equipment->registration_expiry)) : '' }}</td>
          <td class="text-center">{{ $equipment->registration_expiry ? now()->parse($equipment->registration_expiry)->addDays(1)->format('d') : '' }}</td>
        </tr>
      @endforeach

    @endif
  </tbody>
</table>