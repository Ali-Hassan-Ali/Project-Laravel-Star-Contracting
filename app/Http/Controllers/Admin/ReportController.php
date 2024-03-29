<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Eir;
use App\Models\Fuel;
use App\Models\Insurance;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Spare;
use App\Models\City;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{

    //////////////////////////////////////////////////////////////

    public function breakdownOverview()
    {
        
        $status = Status::with('equipment.eir')
                ->whereRelation('equipment.eir', 'idle', '1')
                ->get();

        $average = 0;
        foreach ($status as $statu) {
            if (isset($statu->equipment->eir)) {
                $total_break_down = isset($statu->equipment->eir->total_break_down_duration) ? $statu->equipment->eir->total_break_down_duration : 0;
                $average += $statu->break_down_duration;
               // $average += $statu->break_down_duration + $total_break_down;
            }
        }
        $citys = City::all();

        return view('admin.reports.breakdown_overview', compact('citys', 'status', 'average'));

    }//end of fun

    public function dataBreakdownOverview()
    {

        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $status = Status::with('equipment.eir')
                                ->whereRelation('equipment.eir', 'idle', '1')
                                ->whereDateBetween(request()->start_data, request()->end_data)
                                ->whereRelation('equipment.city', 'id', request()->city_id)
                                ->orderBy('id')->get();
            } else {

                $status = Status::with('equipment.eir')
                                ->whereRelation('equipment.eir', 'idle', '1')
                                ->whereRelation('equipment.city', 'id', request()->city_id)
                                ->orderBy('id')->get();
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $status = Status::with('equipment.eir')
                                ->whereRelation('equipment.eir', 'idle', '1')
                                ->whereDateBetween(request()->start_data, request()->end_data)
                                ->orderBy('id')->get();
                
            } else {

                $status = Status::with('equipment.eir')
                                ->whereRelation('equipment.eir', 'idle', '1')
                                ->orderBy('id')->get();
            }


        }//end of if

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

    public function sumBreakdownOverview()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $status = Status::with('equipment.eir')
                                ->whereRelation('equipment.eir', 'idle', '1')
                                ->whereDateBetween(request()->start_data, request()->end_data)
                                ->whereRelation('equipment.city', 'id', request()->city_id)
                                ->orderBy('id')->get();
            } else {

                $status = Status::with('equipment.eir')
                                ->whereRelation('equipment.eir', 'idle', '1')
                                ->whereRelation('equipment.city', 'id', request()->city_id)
                                ->orderBy('id')->get();
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $status = Status::with('equipment.eir')
                                ->whereRelation('equipment.eir', 'idle', '1')
                                ->whereDateBetween(request()->start_data, request()->end_data)
                                ->orderBy('id')->get();
                
            } else {

                $status = Status::with('equipment.eir')
                                ->whereRelation('equipment.eir', 'idle', '1')
                                ->orderBy('id')->get();
            }


        }//end of if

        $average = 0;

        foreach ($status as $statu) {
            if (isset($statu->equipment->eir)) {
                $total_break_down = isset($statu->equipment->eir->total_break_down_duration) ? $statu->equipment->eir->total_break_down_duration : 0;
                $average += $statu->break_down_duration;
            }
        }

        return response()->json(['total' => $average, 'count' => $status->count()]);

    }//end of fun

    //////////////////////////////////////////////////////////////

    // material_delivery_time

    public function sumMaterialDeliveryTime()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('eir')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')
                                        ->get();

            } else {

                $equipments = Equipment::with('eir')
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')
                                        ->get();
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('eir')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->orderBy('city_id')
                                        ->get();
                
            } else {

                $equipments = Equipment::with('eir')->orderBy('city_id')->get();

            }


        }//end of if

        $total = 0;
        $count = 0;

        foreach($equipments as $equipment) {
            $total += $equipment->eir->total_break_down_duration ?? 0;
            $count +=1;
        }

        return response()->json(['total' => $total, 'count' => $count]);

    }//end of fun

    public function MaterialDeliveryTime()
    {
        $equipments = Equipment::with('eir')->orderBy('city_id')->get();
        $citys = City::all();

        $total = 0;

        foreach($equipments as $equipment) {
            $total += $equipment->eir->total_break_down_duration ?? 0;
        }

        return view('admin.reports.material_delivery_time', compact('equipments', 'citys', 'total'));
        
    }//end of fun

    public function dataMaterialDeliveryTime()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('eir')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')
                                        ->get();

            } else {

                $equipments = Equipment::with('eir')
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')
                                        ->get();
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('eir')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->orderBy('city_id')
                                        ->get();
                
            } else {

                $equipments = Equipment::with('eir')->orderBy('city_id')->get();

            }


        }//end of if

        return DataTables::of($equipments)
            ->addColumn('city', function (Equipment $equipment) {
                return $equipment->city->name;
            })
            ->addColumn('name', function (Equipment $equipment) {
                return $equipment->name . ' ' . $equipment->make . ' ' . $equipment->plate_no;
            })
            ->addColumn('eir_no', function (Equipment $equipment) {
                return $equipment->eir->eir_no ?? '';
            })
            ->addColumn('eir_date', function (Equipment $equipment) {
                return !empty($equipment->eir->date) ? date('d-m-Y', strtotime($equipment->eir->date)) : '-';
            })
            ->addColumn('actual_arrival_to_site_date', function (Equipment $equipment) {
                return !empty($equipment->eir->actual_arrival_to_site_date) ? date('d-m-Y', strtotime($equipment->eir->actual_arrival_to_site_date)) : '-';
            })
            ->addColumn('total_break_down_duration', function (Equipment $equipment) {
                return $equipment->eir->total_break_down_duration ?? '';
            })
            ->make(true);

    }// end of data

    // total_fuel_consumption

    public function sumTotalFuelConsumption()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('eir')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')
                                        ->get();

            } else {

                $equipments = Equipment::with('eir')
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')
                                        ->get();
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('eir')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->orderBy('city_id')
                                        ->get();
                
            } else {

                $equipments = Equipment::with('eir')->orderBy('city_id')->get();

            }


        }//end of if

        $cityID = request()->city_id;
        $count = 0;
        $totalCost = 0;
        $totalUnit = 0;

        foreach($equipments as $equipment) {
            $totalCost += $equipment->fuel->total_cost_of_fuel ?? 0;
            $totalUnit += $equipment->fuel->no_of_units_filled ?? 0;
            $count +=1;
        }

        return response()->json(['totalCost' => $totalCost, 'totalUnit' => $totalUnit]);

    }//end of fun

    public function totalFuelConsumption()
    {
        $equipments = Equipment::with('fuel')->orderBy('city_id')->get();
        $citys = City::all();

        $cityID = request()->city_id;
        $count = 0;
        $totalCost = 0;
        $totalUnit = 0;

        if ($cityID) {
            foreach($equipments as $equipment) {
                if ($equipment->city_id == $cityID) {
                    $totalCost += $equipment->eir->total_break_down_duration ?? 0;
                    $totalUnit += $equipment->eir->no_of_units_filled ?? 0;
                    $count +=1;
                }
            }
        } else {
            foreach($equipments as $equipment) {
                $totalCost += $equipment->fuel->total_cost_of_fuel ?? 0;
                $totalUnit += $equipment->fuel->no_of_units_filled ?? 0;
                $count +=1;
            }
        }

        return view('admin.reports.total_fuel_consumption', compact('equipments' ,'citys', 'totalCost', 'totalUnit'));

    }//end of fun

    public function dataTotalFuelConsumption()
    {

        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('fuel')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')
                                        ->get();

            } else {

                $equipments = Equipment::with('fuel')
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')
                                        ->get();
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('fuel')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->orderBy('city_id')
                                        ->get();
                
            } else {

                $equipments = Equipment::with('fuel')->orderBy('city_id')->get();

            }


        }//end of if

        return DataTables::of($equipments)
            ->addColumn('city', function (Equipment $equipment) {
                return $equipment->city->name;
            })
            ->addColumn('name', function (Equipment $equipment) {
                return $equipment->name . ' ' . $equipment->make . ' ' . $equipment->plate_no;
            })
            ->addColumn('project', function (Equipment $equipment) {
                return $equipment->allocated_to;
                return !empty($equipment->fuel->project) ? date('d-m-Y', strtotime($equipment->fuel->project)) : '-';
            })
            ->addColumn('fuel', function (Equipment $equipment) {
                return $equipment->fuel->unit ?? '';
            })
            ->addColumn('no_of_units_filled', function (Equipment $equipment) {
                return $equipment->fuel->no_of_units_filled ?? 0;
            })
            ->addColumn('fuel_rate_per_litre', function (Equipment $equipment) {
                $data = $equipment->fuel->fuel_rate_per_litre ?? '0';
                return "$ $data";
            })
            ->addColumn('total_cost_of_fuel', function (Equipment $equipment) {
                $data = $equipment->fuel->total_cost_of_fuel ?? '0';
                return "$ $data";
            })
            ->toJson();

    }// end of data

    // equipment_expenditure

    ////////////////////////////////////////////////////////////////////////////

    public function sumTotalEquipmentExpenditure()
    {

        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('fuel','spares')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')
                                        ->get();

            } else {

                $equipments = Equipment::with('fuel','spares')
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')
                                        ->get();
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('fuel','spares')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->orderBy('city_id')
                                        ->get();
                
            } else {

                $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();

            }


        }//end of if

        $total = 0;

        foreach($equipments as $equipment) {

            $fuelFirst = Fuel::where('equipment_id', $equipment->id)->first();

            if ($fuelFirst) {
                
                $cost = isset($fuelFirst) ? 0 : $fuelFirst->total_cost_of_fuel;
            } else {
                $cost = 0;
            }

            $total += $equipment->rental_cost_basis + 
                      $equipment->driver_salary + 
                      $equipment->spares->sum('cost') + 
                      $equipment->spares->sum('freight_charges') + $cost;
        }

        return response()->json($total);

    }//end of fun

    public function dataTotalEquipmentExpenditure()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('fuel','spares')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')
                                        ->get();

            } else {

                $equipments = Equipment::with('fuel','spares')
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')
                                        ->get();
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('fuel','spares')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->orderBy('city_id')
                                        ->get();
                
            } else {

                $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();

            }


        }//end of if

        return DataTables::of($equipments)
            ->addColumn('city', function (Equipment $equipment) {
                return $equipment->city->name;
            })
            ->addColumn('name', function (Equipment $equipment) {
                return $equipment->name . ' ' . $equipment->make . ' ' . $equipment->plate_no;
            })
            ->addColumn('rental_cost_basis', function (Equipment $equipment) {
                return '$ ' . $equipment->rental_cost_basis ?? '0';
            })
            ->addColumn('driver_salary', function (Equipment $equipment) {
                return '$ '. $equipment->driver_salary ?? '';
            })
            ->addColumn('total_spares_cost', function (Equipment $equipment) {
                $sum = $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges') ?? '0';
                return '$ '. $sum;
            })
            ->addColumn('total_cost_of_fuel', function (Equipment $equipment) {
                $total_cost = $equipment->fuel->total_cost_of_fuel ?? '0';
                return "$ $total_cost";
            })
            ->addColumn('total_expenditure', function (Equipment $equipment) {
                $sum = $equipment->rental_cost_basis + $equipment->driver_salary + $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges') + !empty($equipment->fuel->total_cost_of_fuel) ?? '';
                return '$ ' . $sum;
            })
            ->toJson();

    }//end of fun

    public function totalEquipmentExpenditure()
    {
        $equipments = Equipment::with('spares')->orderBy('city_id')->get();
        $citys = City::all();

        $total = 0;

        foreach($equipments as $equipment) {

            $fuelFirst = Fuel::where('equipment_id', $equipment->id)->first();

            if ($fuelFirst) {
                
                $cost = isset($fuelFirst) ? 0 : $fuelFirst->total_cost_of_fuel;
            } else {
                $cost = 0;
            }
            $total += $equipment->rental_cost_basis + 
                      $equipment->driver_salary + 
                      $equipment->spares->sum('cost') + 
                      $equipment->spares->sum('freight_charges') + $cost;
        }

        return view('admin.reports.total_equipment_expenditure', compact('equipments', 'citys', 'total'));

    }//end of fun

    /////////////////////////////////////////////////////////////////////////////////

    // average_expenditure_per_km


    public function sumAverageExpenditurePerkM()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('fuel','spares')
                                    ->whereDateBetween(request()->start_data, request()->end_data)
                                    ->where('city_id', request()->city_id)
                                    ->orderBy('city_id')
                                    ->get();

            } else {

                $equipments = Equipment::with('fuel','spares')
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')->get();

            }


        } else {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('fuel','spares')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->orderBy('city_id')->get();
                
            } else {

                $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();

            }


        }//end of if
        
        $total = 0;
    
        foreach($equipments as $equipment) {
                
                 $fuelFirst = Fuel::where('equipment_id', $equipment->id)->first();

                if ($fuelFirst) {
                    
                    $cost = isset($fuelFirst) ? 0 : $fuelFirst->total_cost_of_fuel;
                } else {
                    $cost = 0;
                }

                $total += $average_mileage_reading + 
                          $equipment->rental_cost_basis + 
                          $equipment->driver_salary + 
                          $equipment->spares->sum('cost') + 
                          $equipment->spares->sum('freight_charges') + $cost;
            
        }

        return response()->json(['count' => $equipments->count(), 'total' => $total]);

    }//end of fun

    public function dataAverageExpenditurePerkM()
    {
        if(request()->city_id) {

            
            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('fuel','spares')
                                    ->whereDateBetween(request()->start_data, request()->end_data)
                                    ->where('city_id', request()->city_id)
                                    ->orderBy('city_id')
                                    ->get();

            } else {

                $equipments = Equipment::with('fuel','spares')
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')->get();

            }


        } else {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::with('fuel','spares')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->orderBy('city_id')->get();
                
            } else {

                $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();

            }


        }//end of if

        return DataTables::of($equipments)
            ->addColumn('city', function (Equipment $equipment) {
                return $equipment->city->name;
            })
            ->addColumn('name', function (Equipment $equipment) {
                return $equipment->name . ' ' . $equipment->make . ' ' . $equipment->plate_no;
            })
            ->addColumn('rental_cost_basis', function (Equipment $equipment) {
                return '$ ' . $equipment->rental_cost_basis ?? '0';
            })
            ->addColumn('driver_salary', function (Equipment $equipment) {
                return '$ '. $equipment->driver_salary ?? '';
            })
            ->addColumn('total_spares_cost', function (Equipment $equipment) {
                $sum = $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges') ?? '0';
                return '$ '. $sum;
            })
            ->addColumn('total_cost_of_fuel', function (Equipment $equipment) {
                $total_cost = $equipment->fuel->total_cost_of_fuel ?? '0';
                return "$ $total_cost";
            })
            ->addColumn('total_expenditure', function (Equipment $equipment) {
                $sum = $equipment->rental_cost_basis + $equipment->driver_salary + $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges') + !empty($equipment->fuel->total_cost_of_fuel) ?? '';
                return '$ ' . $sum;
            })
            ->addColumn('average_mileage_reading', function (Equipment $equipment) {
                $average_mileage = $equipment->fuel->average_mileage_reading  ?? '0';
                return $average_mileage;
            })
            ->addColumn('average_expenditure', function (Equipment $equipment) {
                $average_mileage_reading = $equipment->fuel->average_mileage_reading ?? 0;
                $total = $equipment->rental_cost_basis + $equipment->driver_salary + $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges') + !empty($equipment->fuel->total_cost_of_fuel) ?? '';
                $sum = $average_mileage_reading + $total;
                return '$ ' . $sum;
            })
            ->toJson();

    }//end of fun

    public function averageExpenditurePerkM()
    {
        $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();
        $citys = City::all();

        $total = 0;

        foreach($equipments as $equipment) {
            $average_mileage_reading = $equipment->fuel->average_mileage_reading ?? 0;
            $total += $average_mileage_reading + $equipment->rental_cost_basis + $equipment->driver_salary + $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges') + !empty($equipment->fuel->total_cost_of_fuel) ?? 0;
        }

        return view('admin.reports.average_expenditure_per_km', compact('equipments', 'citys', 'total'));

    }//end of fun

    // average_expenditure_per_km

    /////////////////////////////////////////////////////////////////////////////////

    public function EirOverview()
    {
        $citys = City::all();

        $eirs = Eir::all();

        return view('admin.reports.eir_overview', compact('citys', 'eirs'));

    }//end of fun

    public function dataEirOverview()
    {

        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $eirs = Eir::with('equipment')->whereDateBetween(request()->start_data, request()->end_data)
                                              ->whereRelation('equipment.city', 'id', request()->city_id)
                                              ->get();

            } else {

                $eirs = Eir::with('equipment')->whereRelation('equipment.city', 'id', request()->city_id)->get();

            }


        } else {

            if (request()->start_data && request()->end_data) {

                $eirs = Eir::with('equipment')->whereDateBetween(request()->start_data, request()->end_data)->get();
                
            } else {

                $eirs = Eir::with('equipment')->get();

            }


        }//end of if

        return DataTables::of($eirs)
            ->editColumn('date', function (Eir $eir) {
                return !empty($eir->date) ? date('d-m-Y', strtotime($eir->date)) : '-';
            })
            ->addIndexColumn()
            ->toJson();
    }//end of fun

    public function sumEirOverview()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $eirs = Eir::with('equipment')->whereDateBetween(request()->start_data, request()->end_data)
                                              ->whereRelation('equipment.city', 'id', request()->city_id)
                                              ->get();

            } else {

                $eirs = Eir::with('equipment')->whereRelation('equipment.city', 'id', request()->city_id)->get();

            }


        } else {

            if (request()->start_data && request()->end_data) {

                $eirs = Eir::with('equipment')->whereDateBetween(request()->start_data, request()->end_data)->get();
                
            } else {

                $eirs = Eir::with('equipment')->get();

            }


        }//end of if

        return response(['count' => $eirs->count()]);

    }//end of fun

    /////////////////////////////////////////////////////////////////////////////////

    public function EquipmentsOverview()
    {
        $citys = City::with( 'equipments.statusBreakdown', 'equipments.sparesUsed', 'equipments.fuels', 'equipments.eirs')->get();

        return view('admin.reports.equipments_overview', compact('citys'));

    }//end of fun

    public function dataEquipmentsOverview()
    {

    }

    public function sumEquipmentsOverview()
    {

    }

    // idle_equipments

    //////////////////////////////////////////////////////////////////////////

    public function sumIdleEquipments()
    {

        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::withCount('status')
                                        ->having('status_count', '0')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')->get();

            } else {

                $equipments = Equipment::withCount('status')
                                        ->having('status_count', '0')
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')->get();
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::withCount('status')
                                        ->having('status_count', '0')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->orderBy('city_id')->get();
                
            } else {

                $equipments = Equipment::withCount('status')->having('status_count', '0')->orderBy('city_id')->get();

            }


        }//end of if

        return response()->json($equipments->count());

    }//end of fun

    public function dataIdleEquipments()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::withCount('status')
                                        ->having('status_count', '0')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')->get();

            } else {

                $equipments = Equipment::withCount('status')
                                        ->having('status_count', '0')
                                        ->where('city_id', request()->city_id)
                                        ->orderBy('city_id')->get();
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $equipments = Equipment::withCount('status')
                                        ->having('status_count', '0')
                                        ->whereDateBetween(request()->start_data, request()->end_data)
                                        ->orderBy('city_id')->get();
                
            } else {

                $equipments = Equipment::withCount('status')->having('status_count', '0')->orderBy('city_id')->get();

            }


        }//end of if

        return DataTables::of($equipments)
            ->addColumn('city', function (Equipment $equipment) {
                return $equipment->city->name;
            })
            ->addColumn('name', function (Equipment $equipment) {
                return $equipment->name . ' ' . $equipment->make;
            })
            ->addColumn('plate_no', function (Equipment $equipment) {
                return $equipment->plate_no  ?? '0';
            })
            ->toJson();

    }//end of fun

    public function IdleEquipments()
    {
        $equipments = Equipment::withCount('status')->having('status_count', '0')->orderBy('city_id')->get();

        $citys = City::all();

        return view('admin.reports.idle_equipments', compact('equipments', 'citys'));

    }//end of fun


    //////////////////////////////////////////////////////////////////////////


    public function GetEquipment(Equipment $equipment)
    {
        return $equipment;

    }//end of fun


    public function totalHoursWorked()
    {
        $citys = City::all();
        $fuels = Fuel::query();
        $total_hours = $fuels->sum('hours_worked_weekly');

        return view('admin.reports.total_hours_worked', compact('citys', 'total_hours'));

    }//end of fun

    public function dataTotalHoursWorked()
    {

        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $fuels = Fuel::query()->whereDateBetween(request()->start_data, request()->end_data)
                                ->whereRelation('equipment.city', 'id', request()->city_id);
                
            } else {

                $fuels = Fuel::query()->whereRelation('equipment.city', 'id', request()->city_id);
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $fuels = Fuel::query()->whereDateBetween(request()->start_data, request()->end_data);
                
            } else {

                $fuels = Fuel::query();
            }


        }//end of if

        return DataTables::of($fuels)
            ->editColumn('project', function (Fuel $fuel) {
                return $fuel->equipment->allocated_to;
                return 'Project';
            })
            ->addColumn('equipments', function (Fuel $fuel) {
                return $fuel->equipment ?
                    $fuel->equipment->name . ' ' . $fuel->equipment->make . ' ' . $fuel->equipment->plate_no 
                 : '';
            })
            ->addColumn('city', function (Fuel $fuel) {
                return $fuel->equipment->city->name;
            })
            ->toJson();

    }//end of fun

    public function sumTotalHoursWorked()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $fuels = Fuel::query()->whereDateBetween(request()->start_data, request()->end_data)
                                ->whereRelation('equipment.city', 'id', request()->city_id);
                
            } else {

                $fuels = Fuel::query()->whereRelation('equipment.city', 'id', request()->city_id);
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $fuels = Fuel::query()->whereDateBetween(request()->start_data, request()->end_data);
                
            } else {

                $fuels = Fuel::query();
            }


        }//end of if

        return $total_hours = $fuels->sum('hours_worked_weekly');

    }//end of fun


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function AverageMileage()
    {
        $citys = City::all();

        $fuels = Fuel::query();
        $total_average_mileage = $fuels->sum('average_mileage_reading');

        return view('admin.reports.average_mileage', compact('citys', 'total_average_mileage'));

    }//end of fun

    public function dataAverageMileage()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $fuels = Fuel::query()->whereDateBetween(request()->start_data, request()->end_data)
                                ->whereRelation('equipment.city', 'id', request()->city_id);
                
            } else {

                $fuels = Fuel::query()->whereRelation('equipment.city', 'id', request()->city_id);
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $fuels = Fuel::query()->whereDateBetween(request()->start_data, request()->end_data);
                
            } else {

                $fuels = Fuel::query();
            }


        }//end of if

        return DataTables::of($fuels)
            ->editColumn('project', function (Fuel $fuel) {
                return $fuel->equipment->allocated_to;
                return !empty($fuel->project) ? date('d-m-Y', strtotime($fuel->project)) : '-';
            })
            ->addColumn('equipments_name', function (Fuel $fuel) {
                return $fuel->equipment ?
                    $fuel->equipment->name . ' ' . $fuel->equipment->make . ' ' . $fuel->equipment->plate_no 
                 : '';
            })
            ->addColumn('city', function (Fuel $fuel) {
                return $fuel->equipment->city->name;
            })
            ->toJson();

    }//end of fun

    public function sumAverageMileage()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $fuels = Fuel::query()->whereDateBetween(request()->start_data, request()->end_data)
                                ->whereRelation('equipment.city', 'id', request()->city_id);
                
            } else {

                $fuels = Fuel::query()->whereRelation('equipment.city', 'id', request()->city_id);
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $fuels = Fuel::query()->whereDateBetween(request()->start_data, request()->end_data);
                
            } else {

                $fuels = Fuel::query();
            }


        }//end of if

        return $fuels->sum('average_mileage_reading');

    }//end of fun

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function TotalInsuranceCost()
    {
        $citys = City::all();

        $insurances    = Insurance::query();
        $total_premium = $insurances->sum('premium');

        return view('admin.reports.total_insurance_cost', compact('citys', 'total_premium'));

    }//end of fun

    public function dataTotalInsuranceCost()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $insurances = Insurance::query()->whereDateBetween(request()->start_data, request()->end_data)
                                ->whereRelation('equipment.city', 'id', request()->city_id);
                
            } else {

                $insurances = Insurance::query()->whereRelation('equipment.city', 'id', request()->city_id);
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $insurances = Insurance::query()->whereDateBetween(request()->start_data, request()->end_data);
                
            } else {

                $insurances = Insurance::query();
            }


        }//end of if

        return DataTables::of($insurances)
            ->addColumn('plate_no', function (Insurance $insurance) {
                return $insurance->equipment->plate_no ?? '';
            })
            ->addColumn('city', function (Insurance $insurance) {
                return $insurance->equipment->city->name  ?? '';
            })
            ->editColumn('premium', function (Insurance $insurance) {
                $premium = $insurance->premium  ?? 0;

                return "$ $premium";
            })
            ->toJson();

    }//end of fun

    public function sumTotalInsuranceCost()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $insurances = Insurance::whereDateBetween(request()->start_data, request()->end_data)
                                ->whereRelation('equipment.city', 'id', request()->city_id)->get();
                
            } else {

                $insurances = Insurance::whereRelation('equipment.city', 'id', request()->city_id)->get();
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $insurances = Insurance::whereDateBetween(request()->start_data, request()->end_data)->get();
                
            } else {

                $insurances = Insurance::query();
            }


        }//end of if

        return $insurances->sum('premium');

    }//end of fun

}//end of controller