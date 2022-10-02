<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

                $sum1 = $equipment->rental_cost_basis ?? 0;
                $sum2 = $equipment->driver_salary ?? 0;
                $sum3 = $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges');
                $sum4 = $equipment->fuel->total_cost_of_fuel ?? 0;

                $sum = $sum1 + $sum2 + $sum3 + $sum4;

                return '$ ' . $sum;
            })
            ->addColumn('average_mileage_reading', function (Equipment $equipment) {
                $average_mileage = $equipment->fuel->average_mileage_reading  ?? '0';
                return $average_mileage;
            })
            ->addColumn('average_expenditure', function (Equipment $equipment) {

                $sum1 = $equipment->rental_cost_basis ?? 0;
                $sum2 = $equipment->driver_salary ?? 0;
                $sum3 = $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges');
                $sum4 = $equipment->fuel->total_cost_of_fuel ?? 0;

                $sum = $sum1 + $sum2 + $sum3 + $sum4;

                $average = $equipment->fuel->average_mileage_reading ?? 0;

                if ($average == 0) {
                    
                    $total = 0;

                } else {

                    $total = $sum / $average;
                }

                return '$ ' . $total;
            })
            ->toJson();

    }// end of data

}//end of controller