<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EquipmentRequest;
use App\Models\Equipment;
use App\Models\Country;
use App\Models\City;
use App\Models\ComboBox;
use App\Models\Type;
use App\Models\Spec;
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
                return $equipment->type;
            })
            ->addColumn('actions','admin.equipments.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        $countrys = Country::all();
        $citys    = City::all();
        $specs    = Spec::all();
        $makes    = ComboBox::where('type', 'make')->get();
        $models   = ComboBox::where('type', 'model')->get();
        $types    = ComboBox::where('type', 'type')->get();

        $equipments = ComboBox::where('type', 'equipment')->get();
        $owner_ship = ComboBox::where('type', 'owner_ship')->get();
        $rental_basis = ComboBox::where('type', 'rental_basis')->get();
        $operators  = ComboBox::where('type', 'operator')->get();

        $responsible_person       = ComboBox::where('type', 'responsible_person')->get();
        $responsible_person_email = ComboBox::where('type', 'responsible_person_email')->get();
        $allocated_to             = ComboBox::where('type', 'allocated_to')->get();
        $project_allocated_to     = ComboBox::where('type', 'project_allocated_to')->get();

        return view('admin.equipments.create', compact('countrys',
                                                        'citys',
                                                        'types',
                                                        'makes', 
                                                        'models', 
                                                        'specs', 
                                                        'types',
                                                        'owner_ship',
                                                        'rental_basis',
                                                        'operators',
                                                        'equipments',
                                                        'responsible_person',
                                                        'responsible_person_email',
                                                        'allocated_to',
                                                        'project_allocated_to'));

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
        $citys    = City::all();
        $specs    = Spec::all();
        $makes    = ComboBox::where('type', 'make')->get();
        $models   = ComboBox::where('type', 'model')->get();
        $types    = ComboBox::where('type', 'type')->get();

        $equ        = ComboBox::where('type', 'equipment')->get();
        $owner_ship = ComboBox::where('type', 'owner_ship')->get();
        $rental_basis = ComboBox::where('type', 'rental_basis')->get();
        $operators  = ComboBox::where('type', 'operator')->get();

        $responsible_person       = ComboBox::where('type', 'responsible_person')->get();
        $responsible_person_email = ComboBox::where('type', 'responsible_person_email')->get();
        $allocated_to             = ComboBox::where('type', 'allocated_to')->get();
        $project_allocated_to     = ComboBox::where('type', 'project_allocated_to')->get();

        return view('admin.equipments.edit', compact('equipment',
                                                        'countrys',
                                                        'citys',
                                                        'types',
                                                        'makes', 
                                                        'models', 
                                                        'specs', 
                                                        'types',
                                                        'owner_ship',
                                                        'rental_basis',
                                                        'operators',
                                                        'equ',
                                                        'responsible_person',
                                                        'responsible_person_email',
                                                        'allocated_to',
                                                        'project_allocated_to'));

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