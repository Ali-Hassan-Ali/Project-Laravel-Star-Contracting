<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\Type;
use App\Models\Status;
use App\Models\Spec;
use App\Models\Insurance;
use App\Models\Equipment;
use App\Models\Spare;
use App\Models\Maintenance;
use App\Models\Fuel;
use App\Models\Eir;
use App\Models\RequestPart;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_statistics')->only(['statistics']);

    }// end of __construct

    public function equipmentChart()
    {
        $equipments = Equipment::whereYear('created_at', request()->year)
            ->select(
                '*',
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(id) as total'),
            )
            ->groupBy('month')
            ->get();

        return view('admin.statistics.include._equipments_chart', compact('equipments'));

    }// end of equipmentChart

    public function maintenancesChart()
    {
        $maintenances = Maintenance::whereYear('created_at', request()->year)
            ->select(
                '*',
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(id) as total'),
            )
            ->groupBy('month')
            ->get();

        return view('admin.statistics.include._maintenances_chart', compact('maintenances'));

    }// end of maintenancesChart

    public function insurancesChart()
    {
        $insurances = Insurance::whereYear('created_at', request()->year)
            ->select(
                '*',
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(id) as total'),
            )
            ->groupBy('month')
            ->get();

        return view('admin.statistics.include._insurances_chart', compact('insurances'));

    }// end of insurancesChart

    public function sparesChart()
    {
        $spares = Spare::whereYear('created_at', request()->year)
            ->select(
                '*',
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(id) as total'),
            )
            ->groupBy('month')
            ->get();

        return view('admin.statistics.include._spares_chart', compact('spares'));

    }// end of paresChart

    public function fuelsChart()
    {
        $fuels = Fuel::whereYear('created_at', request()->year)
            ->select(
                '*',
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(id) as total'),
            )
            ->groupBy('month')
            ->get();

        return view('admin.statistics.include._fuels_chart', compact('fuels'));

    }// end of fuelsChart

    public function specsChart()
    {
        $specs = Spec::whereYear('created_at', request()->year)
            ->select(
                '*',
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(id) as total'),
            )
            ->groupBy('month')
            ->get();

        return view('admin.statistics.include._specs_chart', compact('specs'));

    }// end of fuelsChart

    public function eirsChart()
    {
        $eirs = Eir::whereYear('created_at', request()->year)
            ->select(
                '*',
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(id) as total'),
            )
            ->groupBy('month')
            ->get();

        return view('admin.statistics.include._eirs_chart', compact('eirs'));

    }// end of fuelsChart

    public function chart()
    {
        return view('admin.statistics.chart');

    }//end of chart

    public function table()
    {
        $equipments = Equipment::all();

        return view('admin.statistics.table', compact('equipments'));

    }//end of table

}//end of controller