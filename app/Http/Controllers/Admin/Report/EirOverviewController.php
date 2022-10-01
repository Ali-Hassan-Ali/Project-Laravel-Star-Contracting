<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Eir;
use Yajra\DataTables\DataTables;

class EirOverviewController extends Controller
{
    public function index()
    {
        $citys  = City::all();

        return view('admin.reports.eir_overview', compact('citys'));

    }//end of fun index

    public function data()
    {
    	$eirs = Eir::with('equipment')
                        ->whereDateBetween(request()->start_data, request()->end_data)
                        ->WhenCityId(request()->city_id)
                        ->get();


        return DataTables::of($eirs)
            ->editColumn('date', function (Eir $eir) {
                return !empty($eir->date) ? date('d-m-Y', strtotime($eir->date)) : '-';
            })
            ->addIndexColumn()
            ->toJson();

    }// end of data

}//end of controller