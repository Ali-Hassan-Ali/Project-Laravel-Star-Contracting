<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FuelRequest;
use App\Models\Equipment;
use App\Models\Fuel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FuelController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_fuels')->only(['index']);
        $this->middleware('permission:create_fuels')->only(['create', 'store']);
        $this->middleware('permission:update_fuels')->only(['edit', 'update']);
        $this->middleware('permission:delete_fuels')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.fuels.index');

    }//end of index 

    public function data()
    {
        $fuels = Fuel::latest()->get();

        return DataTables::of($fuels)
            ->addColumn('record_select', 'admin.fuels.data_table.record_select')
            ->editColumn('created_at', function (Fuel $fuel) {
                return $fuel->created_at->format('Y-m-d');
            })
            ->addColumn('admin', function (Fuel $fuel) {
                return $fuel->admin->name;
            })
            ->addColumn('equipment', function (Fuel $fuel) {
                return $fuel->equipment->name;
            })
            ->addColumn('actions', 'admin.fuels.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        $equipments = Equipment::all();

        return view('admin.fuels.create', compact('equipments'));

    }//end of create

    
    public function store(FuelRequest $request)
    {
        $requestData             = $request->validated();
        $requestData['user_id']  = auth()->id();
        fuel::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.fuels.index');

    }//end of store



    public function edit(Fuel $fuel)
    {
        $equipments = Equipment::all();

        return view('admin.fuels.edit', compact('fuel','equipments'));

    }//end of edit


    public function update(FuelRequest $request, Fuel $fuel)
    {
        $fuel->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.fuels.index');

    }//end of store

   
    public function destroy(Fuel $fuel)
    {
        $this->delete($fuel);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $fuel = Fuel::FindOrFail($recordId);
            $this->delete($fuel);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Fuel $fuel)
    {
        $fuel->delete();

    }// end of delete

}//end of controller