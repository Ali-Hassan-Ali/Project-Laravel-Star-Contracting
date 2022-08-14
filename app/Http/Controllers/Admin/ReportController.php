<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Spare;

class ReportController extends Controller
{
    public function equipments()
    {
        return 'fdf';
        $equipments = Equipment::with('spares')->get();

        return view('admin.reports.equipments', compact('equipments'));

    }//end of fun

}//end of controller
