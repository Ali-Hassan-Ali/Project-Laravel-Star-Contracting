<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Eir;
use App\Models\Equipment;

class HomeController extends Controller
{
    public function topStatisticsTables()
    {
        $eirUnderReviewCount    = Eir::where('status', 'Under Review')->count();
        $eirInTransitCount      = Eir::where('status', 'Part In Transit')->count();
        $equipmentVehicleCount  = Equipment::WhereBetweenDataRegistrationExpiry()->count();
        $equipmentRentedCount   = Equipment::where('owner_ship', 'Rented')->count();
        $equipmentBarkdownCount = Equipment::whereRelation('statusone', 'working_status', 'barkdown')->count();

        return response()->json([
            'eir_under_review_count'   => $eirUnderReviewCount,
            'eir_in_transit_count'     => $eirInTransitCount,
            'equipment_vehicle_count'  => $equipmentVehicleCount,
            'equipment_rented_count'   => $equipmentRentedCount,
            'equipment_barkdown_count' => $equipmentBarkdownCount,
        ]);

    }//emd of

}//end of class