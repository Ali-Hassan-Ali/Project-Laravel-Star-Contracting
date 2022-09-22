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
    public function AparesAvailable()
    {
        $spares = Spare::query()->where('used', '0');
        $totalCostSpare = $spares->sum('cost') + $spares->sum('freight_charges');

        $citys = City::all();

        return view('admin.reports.spares_available', compact('spares','totalCostSpare', 'citys'));

    }//end of fun

    public function dataAparesAvailable()
    {

         if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $spares = Spare::where('used', '0')->withCount('equipments')->having('equipments', '>', '0')
                                ->whereDateBetween(request()->start_data, request()->end_data)
                                ->whereRelation('equipmentsFirst.city', 'id', request()->city_id)
                                ->orderBy('id')->get();
            } else {

                $spares = Spare::query()->where('used', '0')->whereRelation('equipmentsFirst.city', 'id', request()->city_id);
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $spares = Spare::query()->where('used', '0')
                                ->withCount('equipments')
                                ->having('equipments', '>', '0')
                                ->whereDateBetween(request()->start_data, request()->end_data);
                
            } else {

                $spares = Spare::query()->where('used', '0')->withCount('equipments')->having('equipments', '>', '0');
            }


        }//end of if

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
            ->addColumn('total_cost', function (Spare $spare) {
                $total = $spare->cost + $spare->freight_charges;
                return '$' . $total;
            })->toJson();

    }// end of data



    public function sumAparesAvailable()
    {
        if(request()->city_id) {

            if (request()->start_data && request()->end_data) {

                $spares = Spare::where('used', '0')->withCount('equipments')->having('equipments', '>', '0')
                                ->whereDateBetween(request()->start_data, request()->end_data)
                                ->whereRelation('equipmentsFirst.city', 'id', request()->city_id)
                                ->get();
                
            } else {

                $spares = Spare::where('used', '0')->whereRelation('equipmentsFirst.city', 'id', request()->city_id)->get();
            }


        } else {

            if (request()->start_data && request()->end_data) {

                $spares = Spare::where('used', '0')->withCount('equipments')->having('equipments', '>', '0')
                                ->whereDateBetween(request()->start_data, request()->end_data)
                                ->get();
                
            } else {

                $spares = Spare::where('used', '0')->withCount('equipments')->having('equipments', '>', '0')->get();
            }


        }//end of if

        $collection = collect();

        foreach($spares as $spare) {

            $total = $spare->cost + $spare->freight_charges;

            $collection->push(['premium' => $total]);

        }//end of each

        $total = $collection->sum('premium');  

        return response()->json(['total' => $total, 'count' => $spares->count()]);

    }//end of fun


    public function AparesUsed()
    {
        $citys = City::with('equipments.spares')->get();

        return view('admin.reports.spares_used', compact('citys'));

    }//end of fun

    public function breakdownOverview()
    {
        if (request()->start_data && request()->end_data) {

            $status = Status::with('equipment.eir')
                    ->whereRelation('equipment.eir', 'idle', '1')
                    ->whereDateBetween(request()->start_data, request()->end_data)
                    ->get();
            
        } else {

            $status = Status::with('equipment.eir')
                    ->whereRelation('equipment.eir', 'idle', '1')
                    ->get();

        }//wnd of if

        $average = 0;
        foreach ($status as $statu) {
            if (isset($statu->equipment->eir)) {
                $total_break_down = isset($statu->equipment->eir->total_break_down_duration) ? $statu->equipment->eir->total_break_down_duration : 0;
                $average += $statu->break_down_duration;
//                $average += $statu->break_down_duration + $total_break_down;
            }
        }
        $citys = City::all();

        return view('admin.reports.breakdown_overview', compact('citys', 'status', 'average'));

    }//end of fun

    public function dataBreakdownOverview()
    {
        if(request()->equipment_id) {

            $status = Status::with('equipment.eir')
                ->whereRelation('equipment.eir', 'idle', '1')
                ->whereRelation('equipment', 'id', request()->equipment_id)
                ->get();

        } else {

            $status = Status::with('equipment.eir')
                ->whereRelation('equipment.eir', 'idle', '1')
                ->get();
        }

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
        $status = Status::with('equipment.eir')
            ->whereRelation('equipment.eir', 'idle', '1')
            ->whereRelation('equipment', 'id', request()->equipment_id)
            ->get();

        $average = 0;

        foreach ($status as $statu) {
            if (isset($statu->equipment->eir)) {
                $total_break_down = isset($statu->equipment->eir->total_break_down_duration) ? $statu->equipment->eir->total_break_down_duration : 0;
                $average += $statu->break_down_duration;
//                $average += $statu->break_down_duration + $total_break_down;
            }
        }

        return response()->json(['averages' => $average, 'count' => $status->count()]);

    }//end of fun

    // material_delivery_time

    public function sumMaterialDeliveryTime()
    {
        $cityID = request()->city_id;
        $equipments = Equipment::with('eir')->orderBy('city_id')->get();

        $total = 0;
        $count = 0;

        if ($cityID) {
            foreach($equipments as $equipment) {
                if ($equipment->city_id == $cityID) {
                    $total += $equipment->eir->total_break_down_duration ?? 0;
                    $count +=1;
                }
            }
        } else {
            foreach($equipments as $equipment) {
                $total += $equipment->eir->total_break_down_duration ?? 0;
                $count +=1;
            }
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
        $equipments = Equipment::with('eir')->orderBy('city_id')->get();

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
        $equipments = Equipment::with('fuel')->orderBy('city_id')->get();

        $cityID = request()->city_id;
        $count = 0;
        $totalCost = 0;
        $totalUnit = 0;

        if ($cityID) {
            foreach($equipments as $equipment) {
                if ($equipment->city_id == $cityID) {
                    $totalCost += $equipment->fuel->total_cost_of_fuel ?? 0;
                    $totalUnit += $equipment->fuel->no_of_units_filled ?? 0;
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
        $equipments = Equipment::with('fuel')->orderBy('city_id')->get();

        return DataTables::of($equipments)
            ->addColumn('city', function (Equipment $equipment) {
                return $equipment->city->name;
            })
            ->addColumn('name', function (Equipment $equipment) {
                return $equipment->name . ' ' . $equipment->make . ' ' . $equipment->plate_no;
            })
            ->addColumn('project', function (Equipment $equipment) {
                return !empty($equipment->fuel->project) ? date('d-m-Y', strtotime($equipment->fuel->project)) : '-';
            })
            ->addColumn('fuel', function (Equipment $equipment) {
                return $equipment->fuel->unit ?? '';
            })
            ->addColumn('no_of_units_filled', function (Equipment $equipment) {
                return $equipment->fuel->no_of_units_filled ?? '';
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

    public function sumTotalEquipmentExpenditure()
    {
        $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();
        $cityID = request()->city_id;
        $total = 0;

        if ($cityID) {
            foreach($equipments as $equipment) {
                if ($equipment->city_id == $cityID) {
                    $total += $equipment->rental_cost_basis + 
                              $equipment->driver_salary + 
                              $equipment->spares->sum('cost') + 
                              $equipment->spares->sum('freight_charges') + 
                              isset($equipment->fuel->total_cost_of_fuel) ? $equipment->fuel->total_cost_of_fuel : '';
                }
            }
        } else {
            foreach($equipments as $equipment) {
                $total += $equipment->rental_cost_basis + 
                          $equipment->driver_salary + 
                          $equipment->spares->sum('cost') + 
                          $equipment->spares->sum('freight_charges') + 
                          isset($equipment->fuel->total_cost_of_fuel) ? $equipment->fuel->total_cost_of_fuel : '';
            }
        }

        return response()->json($total);

    }//end of fun

    public function dataTotalEquipmentExpenditure()
    {
        $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();

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
        $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();
        $citys = City::all();

        $total = 0;

        foreach($equipments as $equipment) {
            $total += $equipment->rental_cost_basis + 
                      $equipment->driver_salary + 
                      $equipment->spares->sum('cost') + 
                      $equipment->spares->sum('freight_charges') + 
                      !empty($equipment->fuel->total_cost_of_fuel) ?? 0;
        }

        return view('admin.reports.total_equipment_expenditure', compact('equipments', 'citys', 'total'));

    }//end of fun


    // average_expenditure_per_km

    public function sumAverageExpenditurePerkM()
    {
        $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();
        $cityID = request()->city_id;
        $total = 0;
        $count = 0;

        if ($cityID) {
            foreach($equipments as $equipment) {
                if ($equipment->city_id == $cityID) {
                    $count +=1;
                    $average_mileage_reading = $equipment->fuel->average_mileage_reading ?? 0;
                    $total += $average_mileage_reading + $equipment->rental_cost_basis + $equipment->driver_salary + $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges') + !empty($equipment->fuel->total_cost_of_fuel) ?? '';
                }
            }
        } else {
            foreach($equipments as $equipment) {
                $count +=1;
                $average_mileage_reading = $equipment->fuel->average_mileage_reading ?? 0;
                $total += $average_mileage_reading + $equipment->rental_cost_basis + $equipment->driver_salary + $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges') + !empty($equipment->fuel->total_cost_of_fuel) ?? '';
            }
        }

        return response()->json(['count' => $count, 'total' => $total]);

    }//end of fun

    public function dataAverageExpenditurePerkM()
    {
        $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();

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
                return '$ '. $average_mileage;
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
            $total += $average_mileage_reading + $equipment->rental_cost_basis + $equipment->driver_salary + $equipment->spares->sum('cost') + $equipment->spares->sum('freight_charges') + !empty($equipment->fuel->total_cost_of_fuel) ?? '';
        }

        return view('admin.reports.average_expenditure_per_km', compact('equipments', 'citys', 'total'));

    }//end of fun

    // average_expenditure_per_km

    public function EirOverview()
    {
        $citys = City::all();

        $eirs = Eir::all();

        return view('admin.reports.eir_overview', compact('citys', 'eirs'));

    }//end of fun

    public function dataEirOverview()
    {
        if (request()->equipment_id) {
            $eirs = Eir::with('equipment')->where('equipment_id', request()->equipment_id);
        } else {
            $eirs = Eir::with('equipment');
        }

        return DataTables::of($eirs)
            ->editColumn('date', function (Eir $eir) {
                return !empty($eir->date) ? date('d-m-Y', strtotime($eir->date)) : '-';
            })
            ->addIndexColumn()
            ->toJson();
    }//end of fun

    public function sumEirOverview()
    {
        if (request()->equipment_id) {

            $eirs = Eir::where('equipment_id', request()->equipment_id)->get();

        } else {

            $eirs = Eir::query();
        }

        return response(['count' => $eirs->count()]);

    }//end of fun

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

    public function sumIdleEquipments()
    {
        $equipments = Equipment::withCount('status')->having('status_count', '>', '0')->orderBy('city_id')->get();

        $cityID = request()->city_id;
        $count = 0;

        if ($cityID) {
            foreach($equipments as $equipment) {
                if ($equipment->city_id == $cityID) {
                    $count +=1;
                }
            }
        } else {
            foreach($equipments as $equipment) {
                $count +=1;
            }
        }

        return response()->json($count);

    }//end of fun

    public function dataIdleEquipments()
    {
        $equipments = Equipment::withCount('status')->having('status_count', '>', '0')->orderBy('city_id')->get();

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
        $equipments = Equipment::withCount('status')->having('status_count', '>', '0')->orderBy('city_id')->get();

        $citys = City::all();

        return view('admin.reports.idle_equipments', compact('equipments', 'citys'));

    }//end of fun

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
        if(request()->equipment_id) {

            $fuels = Fuel::where('equipment_id', request()->equipment_id)->get();

        } else {

            $fuels = Fuel::query();
        }

        return DataTables::of($fuels)
            ->editColumn('project', function (Fuel $fuel) {
                return !empty($fuel->project) ? date('d-m-Y', strtotime($fuel->project)) : '-';
            })
            ->addColumn('plate_no', function (Fuel $fuel) {
                return $fuel->equipment->plate_no;
            })
            ->addColumn('city', function (Fuel $fuel) {
                return $fuel->equipment->city->name;
            })
            ->toJson();

    }//end of fun

    public function sumTotalHoursWorked()
    {
        if(request()->equipment_id) {

            $fuels = Fuel::where('equipment_id', request()->equipment_id)->get();

        } else {

            $fuels = Fuel::query();
        }

        return $total_hours = $fuels->sum('hours_worked_weekly');

    }//end of fun

    public function AverageMileage()
    {
        $citys = City::all();

        $fuels = Fuel::query();
        $total_average_mileage = $fuels->sum('average_mileage_reading');

        return view('admin.reports.average_mileage', compact('citys', 'total_average_mileage'));

    }//end of fun

    public function dataAverageMileage()
    {
        if(request()->equipment_id) {

            $fuels = Fuel::where('equipment_id', request()->equipment_id)->get();

        } else {

            $fuels = Fuel::query();
        }

        return DataTables::of($fuels)
            ->editColumn('project', function (Fuel $fuel) {
                return !empty($fuel->project) ? date('d-m-Y', strtotime($fuel->project)) : '-';
            })
            ->addColumn('plate_no', function (Fuel $fuel) {
                return $fuel->equipment->plate_no;
            })
            ->addColumn('city', function (Fuel $fuel) {
                return $fuel->equipment->city->name;
            })
            ->toJson();

    }//end of fun

    public function sumAverageMileage()
    {
        if(request()->equipment_id) {

            $fuels = Fuel::where('equipment_id', request()->equipment_id)->get();

        } else {

            $fuels = Fuel::query();
        }

        return $fuels->sum('average_mileage_reading');

    }//end of fun

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