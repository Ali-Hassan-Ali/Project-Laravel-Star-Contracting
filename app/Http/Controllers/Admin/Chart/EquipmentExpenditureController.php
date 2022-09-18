<?php

namespace App\Http\Controllers\Admin\Chart;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Fuel;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipmentExpenditureController extends Controller
{
    public function index()
    {
        $citys      = City::all();
        $equipments = Equipment::all();

        return view('admin.charts.equipment_expenditure.index', compact('citys', 'equipments'));

    }//end of index

    public function Chart()
    {

        if (!request()->city_id) {

            $collection = collect();

            $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();

            foreach($equipments as $equipment) {
                
                $total = $equipment->rental_cost_basis + 
                         $equipment->driver_salary + 
                         $equipment->spares->sum('cost') + 
                         $equipment->spares->sum('freight_charges') + 
                         !empty($equipment->fuel->total_cost_of_fuel) ?? 0;

                $month = $equipment->created_at->format('F');

                $collection->push([
                    'total' => $total,
                    'month' => $month,
                ]);

            }//end of each

            $stats = $collection->groupBy('month');

            $equipments = $collection->groupBy('month')->map(function ($row) {
                            return $row->sum('total');
                        });

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
