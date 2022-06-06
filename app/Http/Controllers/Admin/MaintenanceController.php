<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MaintenanceRequest;
use App\Models\Maintenance;
use App\Models\Equipment;
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
        $maintenances = Maintenance::latest()->get();

        return DataTables::of($maintenances)
            ->addColumn('record_select', 'admin.maintenances.data_table.record_select')
            ->editColumn('created_at', function (Maintenance $maintenance) {
                return $maintenance->created_at->format('Y-m-d');
            })
            ->addColumn('admin', function (Maintenance $maintenance) {
                return $maintenance->admin->name;
            })
            ->addColumn('equipment', function (Maintenance $maintenance) {
                return $maintenance->equipment->name;
            })
            ->addColumn('actions', 'admin.maintenances.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        $equipments = Equipment::all();

        return view('admin.maintenances.create', compact('equipments'));

    }//end of create

    
    public function store(MaintenanceRequest $request)
    {
        $requestData             = $request->validated();
        $requestData['user_id']  = auth()->id();
        Maintenance::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.maintenances.index');

    }//end of store



    public function edit(Maintenance $maintenance)
    {
        $equipments = Equipment::all();

        return view('admin.maintenances.edit', compact('maintenance','equipments'));

    }//end of edit


    public function update(maintenanceRequest $request, Maintenance $maintenance)
    {
        $maintenance->update($request->validated());

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