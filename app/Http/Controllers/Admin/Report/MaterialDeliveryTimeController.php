<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\City;
use App\Models\Equipment;
use Yajra\DataTables\DataTables;

class MaterialDeliveryTimeController extends Controller
{
    public function index()
    {
        $citys  = City::all();

        return view('admin.reports.material_delivery_time', compact('citys'));

    }//end of fun index

    public function data()
    {

    	$equipments = Equipment::with('eir')
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
            ->addColumn('eir_no', function (Equipment $equipment) {
                return $equipment->eir->eir_no ?? '';
            })
            ->addColumn('eir_date', function (Equipment $equipment) {
                return !empty($equipment->eir->date) ? date('d-m-Y', strtotime($equipment->eir->date)) : '-';
            })
            ->addColumn('actual_arrival_to_site_date', function (Equipment $equipment) {
                return !empty($equipment->eir->actual_arrival_to_site_date) ? date('d-m-Y', strtotime($equipment->eir->actual_arrival_to_site_date)) : '-';
            })
            ->addColumn('total_break_down_duration', function (Equipment $equipment) {
                return $equipment->eir->total_break_down_duration ?? '';
            })
            ->make(true);

    }// end of data

}//end of controller