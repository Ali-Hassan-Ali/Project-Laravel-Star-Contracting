<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.home');

    }// end of index

    public function topStatistics()
    {
        $rolesCount       = number_format(Role::count(), 1);
        $adminsCount      = number_format(User::count(), 1);
        $countrysCount    = number_format(country::count(), 1);
        $citysCount       = number_format(City::count(), 1);
        $typesCount       = number_format(Type::count(), 1);
        $statusCount      = number_format(Status::count(), 1);
        $specsCount       = number_format(Spec::count(), 1);
        $insurancesCount  = number_format(Insurance::count(), 1);
        $equipmentsCount  = number_format(Equipment::count(), 1);
        $sparesCount      = number_format(Spare::count(), 1);
        $MaintenancesCount= number_format(Maintenance::count(), 1);
        $FuelsCount       = number_format(Fuel::count(), 1);
        $EirsCount        = number_format(Eir::count(), 1);
        $RequestPartsCount= number_format(RequestPart::count(), 1);

        return response()->json([
            'roles_count'         => $rolesCount,
            'admins_count'        => $adminsCount,
            'countrys_count'      => $countrysCount,
            'citys_count'         => $citysCount,
            'types_count'         => $typesCount,
            'status_count'        => $statusCount,
            'specs_count'         => $specsCount,
            'insurances_count'    => $insurancesCount,
            'equipments_count'    => $equipmentsCount,
            'spares_count'        => $sparesCount,
            'maintenances_count'  => $MaintenancesCount,
            'fuels_count'         => $FuelsCount,
            'eirs_count'          => $EirsCount,
            'request_parts_count' => $RequestPartsCount,
        ]);

    }//emd of 

}//end of controller
