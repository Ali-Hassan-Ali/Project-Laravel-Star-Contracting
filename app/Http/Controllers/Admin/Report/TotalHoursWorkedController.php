<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fuel;
use App\Models\City;
use Yajra\DataTables\DataTables;

class TotalHoursWorkedController extends Controller
{
    public function index()
    {
        $citys  = City::all();

        return view('admin.reports.total_hours_worked', compact('citys'));

    }//end of fun index

    public function data()
    {
        $fuels = Fuel::whereDateBetween(request()->start_data, request()->end_data)
                    ->WhenCityId(request()->city_id)
                    ->WhenSpecstIds([1,2,4])
                    ->orderBy('id')
                    ->get();

		return DataTables::of($fuels)
            ->addColumn('equipments', function (Fuel $fuel) {
                return $fuel->equipment ?
                    $fuel->equipment->make . ' ' . $fuel->equipment->name . ' ' . $fuel->equipment->plate_no 
                 : '';
            })
            ->addColumn('city', function (Fuel $fuel) {
                return $fuel->equipment->city->name;
            })
            ->toJson();

    }// end of data

}//end of controller