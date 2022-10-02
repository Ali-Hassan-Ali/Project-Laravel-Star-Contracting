<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Insurance;
use App\Models\Equipment;
use App\Models\City;
use Yajra\DataTables\DataTables;

class TotalInsuranceCostController extends Controller
{
    public function index()
    {
        $citys       = City::all();
        $equipments  = Equipment::all();

        return view('admin.reports.total_insurance_cost', compact('citys', 'equipments'));

    }//end of fun index

    public function data()
    {
        $insurances = Insurance::whereDateBetween(request()->start_data, request()->end_data)
                    ->WhenCityId(request()->city_id)
                    ->WhenEquipmentId(request()->equipment_id)
                    ->orderBy('id')
                    ->get();

		return DataTables::of($insurances)
            ->addColumn('equipments', function (Insurance $insurance) {
                return $insurance->equipment ?
                    $insurance->equipment->make . ' ' . $insurance->equipment->name . ' ' . $insurance->equipment->plate_no 
                 : '';
            })
            ->addColumn('city', function (Insurance $insurance) {
                return $insurance->equipment->city->name  ?? '';
            })
            ->editColumn('premium', function (Insurance $insurance) {
                $premium = $insurance->premium  ?? 0;

                return "$ $premium";
            })
            ->toJson();

    }// end of data

}//end of controller
