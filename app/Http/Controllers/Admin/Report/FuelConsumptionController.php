<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Fuel;
use Yajra\DataTables\DataTables;

class FuelConsumptionController extends Controller
{
    public function index()
    {
        $citys  = City::all();

        return view('admin.reports.total_fuel_consumption', compact('citys'));

    }//end of fun index

    public function data()
    {
    	$fuels = Fuel::with('equipment')
                                ->whereDateBetween(request()->start_data, request()->end_data)
                                ->WhenCityId(request()->city_id)
                                ->orderBy('id')
                                ->get();


        return DataTables::of($fuels)
            ->addColumn('city', function (Fuel $fuel) {
                return $fuel->equipment->city->name;
            })
            ->addColumn('name', function (Fuel $fuel) {
                return $fuel->equipment->make . ' ' . $fuel->equipment->name . ' ' . $fuel->equipment->plate_no;
            })
            ->addColumn('edit_no_of_units_filled', function (Fuel $fuel) {
                return $fuel->no_of_units_filled ?? 0;
            })
            ->addColumn('edit_fuel_rate_per_litre', function (Equipment $equipment) {
                $data = $fuel->fuel_rate_per_litre ?? '0';
                return "$ $data";
            })
            ->addColumn('edit_total_cost_of_fuel', function (Equipment $equipment) {
                $data = $fuel->total_cost_of_fuel ?? '0';
                return "$ $data";
            })
            ->toJson();

    }// end of data

}//end of controller