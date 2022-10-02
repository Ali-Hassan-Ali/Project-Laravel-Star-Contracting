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
            ->addColumn('project', function (Fuel $fuel) {
                return $fuel->project ?? '';
            })
            ->ediColumn('fuel', function (Fuel $fuel) {
                return $fuel->unit ?? '';
            })
            ->editColumn('no_of_units_filled', function (Fuel $fuel) {
                return $fuel->no_of_units_filled ?? 0;
            })
            ->editColumn('fuel_rate_per_litre', function (Fuel $fuel) {
                $data = $fuel->fuel_rate_per_litre ?? '0';
                return "$ $data";
            })
            ->editColumn('total_cost_of_fuel', function (Fuel $fuel) {
                $data = $fuel->total_cost_of_fuel ?? '0';
                return "$ $data";
            })
            ->toJson();

    }// end of data

}//end of controller