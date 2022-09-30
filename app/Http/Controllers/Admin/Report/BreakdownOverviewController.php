<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Status;
use App\Models\City;
use Yajra\DataTables\DataTables;

class BreakdownOverviewController extends Controller
{
    public function index()
    {
        $citys  = City::all();

        return view('admin.reports.breakdown_overview', compact('citys'));

    }//end of fun index

    public function data()
    {

    	$status = Status::with('equipment.eir')
		                ->whereRelation('equipment.eir', 'idle', '1')
		                ->whereDateBetween(request()->start_data, request()->end_data)
		                ->WhenCityId(request()->city_id)
		                ->get();

        return DataTables::of($status)
            ->addColumn('city', function (Status $status) {
                return $status->equipment->city->name;
            })
            ->editColumn('as_of', function (Status $status) {
                return $status->as_of ? date('d-m-Y', strtotime($status->as_of)) : '-';
            })
            ->editColumn('break_down_date', function (Status $status) {
                return $status->break_down_date ? date('d-m-Y', strtotime($status->break_down_date)) : '-';
            })
            ->addColumn('eir_idle', function (Status $status) {
                return $status->equipment->eir->idle == '1' ? 'Yes' : 'No';
            })
            ->addColumn('eir_date', function (Status $status) {
                return isset($status->equipment->eir->date) ? date('d-m-Y', strtotime($status->equipment->eir->date)) : '-';
            })
            ->addColumn('actual_arrival_to_site_date', function (Status $status) {
                return isset($status->equipment->eir->actual_arrival_to_site_date) ? date('d-m-Y', strtotime($status->equipment->eir->actual_arrival_to_site_date)) : '-';
            })
            ->addColumn('spares ', function (Status $status) {
                return isset($status->equipment->eir->actual_arrival_to_site_date) ? date('d-m-Y', strtotime($status->equipment->eir->actual_arrival_to_site_date)) : '-';
            })
            ->addColumn('eir_break_down_duration', function (Status $status) {
                 return isset($status->eir->total_break_down_duration) ? $status->eir->total_break_down_duration : 0;
            })
            ->addColumn('total_break_down_duration', function (Status $status) {
                $total_break_down = isset($status->eir->total_break_down_duration) ? $status->eir->total_break_down_duration : 0;
                return $status->break_down_duration + $total_break_down;
            })
            ->addIndexColumn()
            ->toJson();

    }// end of data

}//end of controller