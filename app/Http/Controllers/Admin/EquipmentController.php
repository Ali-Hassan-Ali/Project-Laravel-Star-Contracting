<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EquipmentRequest;
use App\Models\Equipment;
use App\Models\Country;
use App\Models\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EquipmentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:read_equipments')->only(['index']);
        $this->middleware('permission:create_equipments')->only(['create', 'store']);
        $this->middleware('permission:update_equipments')->only(['edit', 'update']);
        $this->middleware('permission:delete_equipments')->only(['delete', 'bulk_delete']);

    }// end of __construct


    public function index()
    {
        return view('admin.equipments.index');

    }//end of index

    public function data()
    {
        $equipments = Equipment::latest()->get();

        return DataTables::of($equipments)
            ->addColumn('record_select', 'admin.equipments.data_table.record_select')
            ->editColumn('created_at', function (Equipment $equipment) {
                return $equipment->created_at->format('Y-m-d');
            })
            ->addColumn('admin', function (Equipment $equipment) {
                return $equipment->admin->name;
            })
            ->addColumn('country', function (Equipment $equipment) {
                return $equipment->country->name;
            })
            ->addColumn('type', function (Equipment $equipment) {
                return $equipment->type->name;
            })
            ->addColumn('actions','admin.equipments.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        $countrys = Country::all();
        $types    = Type::all();

        return view('admin.equipments.create', compact('countrys','types'));

    }// end of create

    
    public function store(EquipmentRequest $request)
    {
        $requestData             = $request->validated();
        $requestData['user_id']  = auth()->id();

        Equipment::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.equipments.index');

    }//end of store


    public function edit(Equipment $equipment)
    {
        $countrys = Country::all();
        $types    = Type::all();

        return view('admin.equipments.edit', compact('equipment','countrys','types'));

    }// end of edit

    
    public function update(EquipmentRequest $request, Equipment $equipment)
    {
        $equipment->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.equipments.index');

    }// end of update

    
    public function destroy(Equipment $equipment)
    {
        $this->delete($equipment);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $equipment = Equipment::FindOrFail($recordId);
            $this->delete($equipment);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Equipment $equipment)
    {
        $equipment->delete();

    }// end of delete

}//end of controller