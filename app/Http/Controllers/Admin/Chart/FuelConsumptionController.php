<?php

namespace App\Http\Controllers\Admin\Chart;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Fuel;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuelConsumptionController extends Controller
{
    public function index()
    {
        $citys      = City::all();
        $equipments = Equipment::all();

        return view('admin.charts.fuel_consumption.index', compact('citys', 'equipments'));

    }//end of index

    public function Chart()
    {

        if (!request()->city_id) {

            $fuels = Fuel::whereYear('created_at', request()->year)
                ->select(
                DB::raw('MONTHNAME(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(no_of_units_filled) as total_units'),
                DB::raw('SUM(total_cost_of_fuel) as total_cost'),
            )
            ->groupBy('month')
            ->get();

        }//end of if

        if (request()->city_id) {
            
            $fuels = Fuel::whereYear('created_at', request()->year)
                    ->whereRelation('equipment.city', 'id', request()->city_id)->select(
                    DB::raw('MONTHNAME(created_at) as month'),
                    DB::raw('YEAR(created_at) as year'),
                    DB::raw('SUM(no_of_units_filled) as total_units'),
                    DB::raw('SUM(total_cost_of_fuel) as total_cost'),
                )
                ->groupBy('month')
                ->get();

        }//end of if

        if (request()->city_id && request()->equipment_id) {
            
            $fuels = Fuel::whereYear('created_at', request()->year)
                    ->whereRelation('equipment.city', 'id', request()->city_id)
                    ->where('equipment_id', request()->equipment_id)->select(
                    DB::raw('MONTHNAME(created_at) as month'),
                    DB::raw('YEAR(created_at) as year'),
                    DB::raw('SUM(no_of_units_filled) as total_units'),
                    DB::raw('SUM(total_cost_of_fuel) as total_cost'),
                )
                ->groupBy('month')
                ->get();

        }//end of if

        return view('admin.charts.fuel_consumption._chart', compact('fuels'));

    }// end of equipmentChart

}//end of controller
