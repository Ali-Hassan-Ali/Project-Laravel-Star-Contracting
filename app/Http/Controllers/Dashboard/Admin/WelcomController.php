<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Categorey;
use App\Models\Owner;
use App\Models\Admin;
use App\Models\Apartment;
use App\Models\Order;
use App\Models\City;
use App\Models\Vehicle;

class WelcomController extends Controller
{

    public function __construct()
    {
        //read 
        $this->middleware(['permission:dashboard_read'])->only('index');

    }//end of constructor
    
    public function index()
    {
        $admins_count     = Admin::whereRoleIs('admin')->count();
        $citys_count      = City::count();
        $vehicle_count    = Vehicle::count();
        // $apartments_count = Apartment::count();
        // $orders_count     = Order::count();

        // $sales_data = Order::select(
        //     DB::raw('YEAR(created_at) as year'),
        //     DB::raw('MONTH(created_at) as month'),
        //     DB::raw('SUM(total_price) as sum')
        // )->groupBy('month')->get();

        return view('dashboard_admin.welcome', compact('admins_count','citys_count','vehicle_count'));

    }//end of index

}//end of controller