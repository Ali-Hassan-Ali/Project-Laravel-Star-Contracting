<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spare;
use App\Models\City;
use Yajra\DataTables\DataTables;

class AparesAvailableController extends Controller
{
    public function index()
    {
        $spares = Spare::query()->where('used', '0');
        $citys  = City::all();

        return view('admin.reports.spares_available', compact('spares', 'citys'));

    }//end of fun index

    public function data()
    {
        $spares = Spare::where('used', '0')->withCount('equipments')->having('equipments', '>', '0')
                        ->whereDateBetween(request()->start_data, request()->end_data)
                        ->WhenCityId(request()->city_id)
                        ->orderBy('id')->get();

        return DataTables::of($spares)
            ->addColumn('site', function (Spare $spare) {
                return $spare->equipments()->first()->city->name;
            })
            ->addColumn('equipments', function (Spare $spare) {
                return view('admin.spares.data_table._equipment', compact('spare'));
            })
            ->addColumn('used', function (Spare $spare) {
                return $spare->used == 1 ? 'Yes' : 'No';
            })
            ->editColumn('location', function (Spare $spare) {
                return $spare->location ?? '';
            })
            ->editColumn('cost', function (Spare $spare) {
                $cost = $spare->cost;
                return '$' . $cost;
            })
            ->editColumn('freight_charges', function (Spare $spare) {
                $freight_charges = $spare->freight_charges;
                return '$' . $freight_charges;
            })
            ->addColumn('total_cost', function (Spare $spare) {
                $total = $spare->cost + $spare->freight_charges;
                return '$' . $total;
            })->toJson();

    }// end of data

}//end of controller