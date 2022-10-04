<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MaintenanceRequest;
use App\Models\Maintenance;
use App\Models\Equipment;
use App\Models\ComboBox;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MaintenanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_maintenances')->only(['index']);
        $this->middleware('permission:create_maintenances')->only(['create', 'store']);
        $this->middleware('permission:update_maintenances')->only(['edit', 'update']);
        $this->middleware('permission:delete_maintenances')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.maintenances.index');

    }//end of index 

    public function data()
    {

        if (request()->old) {

             if (request()->start_data && request()->end_data) {

                $maintenances = Maintenance::query()
                    ->whereDateBetween(request()->start_data, request()->end_data)
                    ->whereYear('created_at', '!=', now()->year);
                
            } else {

                $maintenances = Maintenance::query()->whereYear('created_at', '!=', now()->year);
            }
            
        } else {

            if (request()->start_data && request()->end_data) {

                $maintenances = Maintenance::query()
                    ->whereDateBetween(request()->start_data, request()->end_data)
                    ->whereYear('created_at', now()->year);
                
            } else {

                $maintenances = Maintenance::query()->whereYear('created_at', now()->year);
            }


        }//end of if

        return DataTables::of($maintenances)
            ->addColumn('record_select', 'admin.maintenances.data_table.record_select')
            ->editColumn('created_at', function (Maintenance $maintenance) {
                return $maintenance->created_at->format('Y-m-d');
            })
            ->editColumn('scheduled', function (Maintenance $maintenance) {
                return view('admin.maintenances.data_table._scheduled', compact('maintenance'));
            })
            ->editColumn('last_service_date', function (Maintenance $maintenance) {
                return $maintenance->last_service_date ? date('d-m-Y', strtotime($maintenance->last_service_date)) : '';
            })
            ->editColumn('next_service_date', function (Maintenance $maintenance) {
                return $maintenance->next_service_date ? date('d-m-Y', strtotime($maintenance->next_service_date)) : '';
            })
            ->editColumn('actual_service_date', function (Maintenance $maintenance) {
                return $maintenance->actual_service_date ? date('d-m-Y', strtotime($maintenance->actual_service_date)) : '';
            })
            ->addColumn('admin', function (Maintenance $maintenance) {
                return $maintenance->admin->name ?? '';
            })
            ->addColumn('equipment', function (Maintenance $maintenance) {
                return $maintenance->equipment ?
                    $maintenance->equipment->make . ' ' . $maintenance->equipment->name . ' ' . $maintenance->equipment->plate_no 
                 : '';
            })
            ->addColumn('actions', 'admin.maintenances.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        $equipments     = Equipment::all();
        $countrys       = Country::all();
        $non_scheduleds = ComboBox::where('type', 'non_scheduled')->get();

        return view('admin.maintenances.create', compact('equipments', 'non_scheduleds', 'countrys'));

    }//end of create

    
    public function store(MaintenanceRequest $request)
    {
        $validated = $request->validated();
        $validated = $request->safe()->except(['scheduled']);

        $validated['scheduled']    = request()->has('scheduled') ? '1' : '0';
        $validated['user_id']      = auth()->id();

        Maintenance::create($validated);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.maintenances.index');

    }//end of store



    public function edit(Maintenance $maintenance)
    {
        $equipments     = Equipment::all();
        $countrys       = Country::all();
        $non_scheduleds = ComboBox::where('type', 'non_scheduled')->get();

        return view('admin.maintenances.edit', compact('maintenance','equipments', 'non_scheduleds', 'countrys'));

    }//end of edit


    public function update(MaintenanceRequest $request, Maintenance $maintenance)
    {
        $validated = $request->validated();
        $validated = $request->safe()->except(['scheduled']);

        $validated['scheduled']    = request()->has('scheduled') ? '1' : '0';
        $validated['user_id']      = auth()->id();

        $maintenance->update($validated);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.maintenances.index');

    }//end of store

   
    public function destroy(Maintenance $maintenance)
    {
        $this->delete($maintenance);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $maintenance = Maintenance::FindOrFail($recordId);
            $this->delete($maintenance);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Maintenance $maintenance)
    {
        $maintenance->delete();

    }// end of delete

}//end of controller