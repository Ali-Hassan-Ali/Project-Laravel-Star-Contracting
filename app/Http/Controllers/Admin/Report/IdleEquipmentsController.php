<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Equipment;
use Yajra\DataTables\DataTables;

class IdleEquipmentsController extends Controller
{
    public function index()
    {
        $citys  = City::all();

        return view('admin.reports.idle_equipments', compact('citys'));

    }//end of fun index

    public function data()
    {

    	$equipments = Equipment::withCount('status')
                                        ->having('status_count', '0')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->WhenCityId(request()->city_id)
                                        ->orderBy('city_id')->get();


        return DataTables::of($equipments)
            ->addColumn('city', function (Equipment $equipment) {
                return $equipment->city->name;
            })
            ->addColumn('name', function (Equipment $equipment) {
                return $equipment->name . ' ' . $equipment->make;
            })
            ->addColumn('plate_no', function (Equipment $equipment) {
                return $equipment->plate_no  ?? '0';
            })
            ->toJson();

    }// end of data

}//end of controller