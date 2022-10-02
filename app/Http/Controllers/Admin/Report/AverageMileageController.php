<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fuel;
use App\Models\City;
use Yajra\DataTables\DataTables;

class AverageMileageController extends Controller
{
    public function index()
    {
        $citys  = City::all();

        return view('admin.reports.average_mileage', compact('citys'));

    }//end of fun index

    public function data()
    {
        $fuels = Fuel::whereDateBetween(request()->start_data, request()->end_data)
                    ->WhenCityId(request()->city_id)
                    ->orderBy('id')
                    ->get();

        return DataTables::of($fuels)
            ->editColumn('project', function (Fuel $fuel) {
                return $fuel->equipment->allocated_to;
                return !empty($fuel->project) ? date('d-m-Y', strtotime($fuel->project)) : '-';
            })
            ->addColumn('equipments_name', function (Fuel $fuel) {
                return $fuel->equipment ?
                    $fuel->equipment->name . ' ' . $fuel->equipment->make . ' ' . $fuel->equipment->plate_no 
                 : '';
            })
            ->addColumn('city', function (Fuel $fuel) {
                return $fuel->equipment->city->name;
            })
            ->toJson();

    }// end of data

}//end of controller