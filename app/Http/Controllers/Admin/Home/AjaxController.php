<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Eir;

class AjaxController extends Controller
{

    public function EirPendingApproved()
    {
        $eirs  = Eir::where('status', 'Under Review')->get();

        $data = view('admin.home.includes.eirs._eir_under_review_count', compact('eirs'));

        return $data;

    }//end of fun

    public function EirInTransit()
    {
        $eirs  = Eir::where('status', 'Part In Transit')->get();

        $data = view('admin.home.includes.eirs._eir_in_transit', compact('eirs'));

        return $data;

    }//end of fun

    public function EquipmentVehicle()
    {
        $equipmens = Equipment::whereDate('registration_expiry', '>=', now())
                     ->whereDate('registration_expiry', '<=', now()->addMonth(1))->get();

        $data = view('admin.home.includes.equipments._equipment_vehicle', compact('equipmens'));

        return $data;

    }//end of fun

    public function EquipmentRented()
    {
        $equipmens = Equipment::where('owner_ship', 'Rented')->get();

        $data = view('admin.home.includes.equipments._equipment_rented', compact('equipmens'));

        return $data;

    }//end of fun

    public function EquipmentBarkdown()
    {
        $equipmens = Equipment::withCount('statusone','city')
                                ->having('statusone_count', '>', '0')
                                ->get()
                                ->sortByDesc('city.name', 'desc');

        $data = view('admin.home.includes.equipments._equipment_barkdown', compact('equipmens'));

        return $data;

    }//end of fun

}//end of class