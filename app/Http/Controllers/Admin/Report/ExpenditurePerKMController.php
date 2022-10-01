<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\City;
use App\Models\Equipment;
use Yajra\DataTables\DataTables;

class ExpenditurePerKMController extends Controller
{
    public function index()
    {
        $citys  = City::all();

        return view('admin.reports.average_expenditure_per_km', compact('citys'));

    }//end of fun index

    public function data()
    {

    	$equipments = Equipment::with('fuel','spares')
				                ->whereDateBetween(request()->start_data, request()->end_data)
				                ->WhenCityId(request()->city_id)
    							->orderBy('city_id')->get();

        return DataTables::of($equipments)
            ->addColumn('city', function (Equipment $equipment) {
                return $equipment->city->name;
            })
            ->addColumn('name', function (Equipment $equipment) {
                return $equipment->name . ' ' . $equipment->make . ' ' . $equipment->plate_no;
            })
            ->addColumn('rental_cost_basis', function (Equipment $equipment) {
                return '$ ' . $equipment->rental_cost_basis ?? '0';
            })
            ->addColumn('driver_salary', function (Equipment $equipment) {
                return '$ '. $equipment->driver_salary ?? '';
            })
            ->addColumn('total_spares_cost', function (Equipment $equipment) {
                $sum = $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges') ?? '0';
                return '$ '. $sum;
            })
            ->addColumn('total_cost_of_fuel', function (Equipment $equipment) {
                $total_cost = $equipment->fuel->total_cost_of_fuel ?? '0';
                return "$ $total_cost";
            })
            ->addColumn('total_expenditure', function (Equipment $equipment) {
                $sum = $equipment->rental_cost_basis + $equipment->driver_salary + $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges') + !empty($equipment->fuel->total_cost_of_fuel) ?? '';
                return '$ ' . $sum;
            })
            ->toJson();

    }// end of data

}//end of controller