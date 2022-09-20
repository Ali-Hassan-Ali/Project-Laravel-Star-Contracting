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
                         $equipment->fuel()->count() > 0 ? $equipment->fuel->total_cost_of_fuel : 0;

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

            $month = $equipments->keys();
            $total = $equipments->values();

        }//end of if

        if (request()->city_id) {

            $collection = collect();

            $equipments = Equipment::whereYear('created_at', request()->year)
                                    ->where('city_id', request()->city_id)
                                    ->with('fuel','spares')
                                    ->orderBy('city_id')
                                    ->get();

            foreach($equipments as $equipment) {
                
                $total = $equipment->rental_cost_basis + 
                         $equipment->driver_salary + 
                         $equipment->spares->sum('cost') + 
                         $equipment->spares->sum('freight_charges') + 
                         isset($equipment->fuel->total_cost_of_fuel) ? $equipment->fuel->total_cost_of_fuel : 0;

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

            $month = $equipments->keys();
            $total = $equipments->values();

        }//end of if

        if (request()->city_id && request()->equipment_id) {

            $collection = collect();

            $equipments = Equipment::whereYear('created_at', request()->year)
                                    ->where([
                                        'city_id' => request()->city_id,
                                        'id'      => request()->equipment_id,
                                    ])->with('fuel','spares')
                                      ->orderBy('city_id')
                                      ->get();

            foreach($equipments as $equipment) {
                
                $total = $equipment->rental_cost_basis + 
                         $equipment->driver_salary + 
                         $equipment->spares->sum('cost') + 
                         $equipment->spares->sum('freight_charges') + 
                         isset($equipment->fuel->total_cost_of_fuel) ? $equipment->fuel->total_cost_of_fuel : 0;

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

            $month = $equipments->keys();
            $total = $equipments->values();

        }//end of if

        return view('admin.charts.equipment_expenditure._chart', compact('equipments', 'month', 'total'));

    }// end of equipmentChart

}//end of controller
