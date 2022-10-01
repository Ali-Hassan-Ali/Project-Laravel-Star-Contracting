<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Equipment;
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

    	$equipments = Equipment::with('fuel')
                                ->whereDateBetween(request()->start_data, request()->end_data)
                                ->WhenCityId(request()->city_id)
                                ->orderBy('city_id')
                                ->get();


        return DataTables::of($equipments)
            ->addColumn('city', function (Equipment $equipment) {
                return $equipment->city->name;
            })
            ->addColumn('name', function (Equipment $equipment) {
                return $equipment->name . ' ' . $equipment->make . ' ' . $equipment->plate_no;
            })
            ->addColumn('project', function (Equipment $equipment) {
                return $equipment->allocated_to;
            })
            ->addColumn('fuel', function (Equipment $equipment) {
                return $equipment->fuel->unit ?? '';
            })
            ->addColumn('no_of_units_filled', function (Equipment $equipment) {
                return $equipment->fuel->no_of_units_filled ?? 0;
            })
            ->addColumn('fuel_rate_per_litre', function (Equipment $equipment) {
                $data = $equipment->fuel->fuel_rate_per_litre ?? '0';
                return "$ $data";
            })
            ->addColumn('total_cost_of_fuel', function (Equipment $equipment) {
                $data = $equipment->fuel->total_cost_of_fuel ?? '0';
                return "$ $data";
            })
            ->toJson();

    }// end of data

}//end of controller