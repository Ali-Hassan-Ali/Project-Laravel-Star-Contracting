<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EquipmentRequest;
use App\Models\Equipment;
use App\Models\Country;
use App\Models\City;
use App\Models\ComboBox;
use App\Models\Attachment;
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
        if (request()->old) {

            $equipments = Equipment::whereDateBetween(request()->start_data, request()->end_data)
                                    ->whereYear('created_at', '!=',now()->year)->get();
            
        } else {

            $equipments = Equipment::whereDateBetween(request()->start_data, request()->end_data)
                                    ->whereYear('created_at', now()->year)->get();

        }//end of if


        return DataTables::of($equipments)
            ->addColumn('record_select', 'admin.equipments.data_table.record_select')
            ->editColumn('created_at', function (Equipment $equipment) {
                return $equipment->created_at->format('Y-m-d');
            })
            ->editColumn('driver_salary', function (Equipment $equipment) {
                return "$ $equipment->driver_salary";
            })
            ->editColumn('rental_cost_basis', function (Equipment $equipment) {
                return "$ $equipment->rental_cost_basis";
            })
            ->addColumn('country', function (Equipment $equipment) {
                return ucfirst($equipment->country->name);
            })
            ->editColumn('attachments', function (Equipment $equipment) {
                return view('admin.equipments.data_table._attachments', compact('equipment'));
            })
            ->addColumn('city', function (Equipment $equipment) {
                return ucfirst($equipment->city->name);
            })
            ->addColumn('specs', function (Equipment $equipment) {
                return isset($equipment->spec->name) ? ucfirst($equipment->spec->name) : '';
            })
            ->editColumn('year_of_manufacture', function (Equipment $equipment) {
                return $equipment->year_of_manufacture ? date('d-m-Y', strtotime($equipment->year_of_manufacture)) : '';
            })
            ->editColumn('project_allocated_to', function (Equipment $equipment) {
                return view('admin.equipments.data_table._project_allocated_to', compact('equipment'));
            })
            ->editColumn('registration_expiry', function (Equipment $equipment) {
                return $equipment->registration_expiry ? date('d-m-Y', strtotime($equipment->registration_expiry)) : '';
            })
            ->addColumn('actions','admin.equipments.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        $countrys = Country::all();
        $citys    = City::all();
        $specs    = Spec::where('type', 'Equipment')->get();
        $makes    = ComboBox::where('type', 'make')->get();
        $models   = ComboBox::where('type', 'model')->get();
        $types    = ComboBox::where('type', 'spec_type')->get();

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
        $validated = $request->safe()->except(['make','model','type','name','operator','email','responsible_person','project_allocated_to','attachments']);

        if ($request->model) {

            $validated['model'] = $this->tagModel($request);

        } else {

            $validated['model'] = null;

        }
        $validated['make']     = $this->tagMake($request);
        $validated['type']     = $this->tagType($request);
        $validated['name']     = $this->tagEquipment($request);
        $validated['operator'] = $this->tagOperator($request);
        $validated['email']    = $this->tagEmail($request);

        $validated['responsible_person'] = $this->tagResponsiblePerson($request);

        if ($request->allocated_to == 'Project') {
            $validated['project_allocated_to'] = json_encode($this->tagProjectAllocatedTo($request));
        }
        $validated['user_id']  = auth()->id();

        $equipment = Equipment::create($validated);

        if ($request->attachments) {
            
            foreach ($request->file('attachments') as $file) {

                Attachment::create([
                    'path'         => $file->store('equipment_attachments_file', 'public'),
                    'name'         => $file->getClientOriginalName(),
                    'type'         => $file->extension(),
                    'equipment_id' => $equipment->id,
                ]);

            }//end of each

        }//end of check file attachments


        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.equipments.index');

    }//end of store


    public function edit(Equipment $equipment)
    {
        $countrys = Country::all();
        $citys    = City::all();
        $specs    = Spec::where('type', $equipment->type)->get();
        $makes    = ComboBox::where('type', 'make')->get();
        $models   = ComboBox::where('type', 'model')->get();
        $types    = ComboBox::where('type', 'spec_type')->get();

        $equis      = ComboBox::where('type', 'equipment')->get();
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
                                                        'equ','equis',
                                                        'responsible_person',
                                                        'responsible_person_email',
                                                        'allocated_to',
                                                        'project_allocated_to'));

    }// end of edit

    
    public function update(EquipmentRequest $request, Equipment $equipment)
    {
        $validated = $request->validated();
        $validated = $request->safe()->except(['make','model','type','name','operator','email','responsible_person','project_allocated_to','attachments']);

        if ($request->model) {
            $validated['model']    = $this->tagModel($request);
        } else {
            $validated['model']    = null;
        }
        $validated['make']     = $this->tagMake($request);
        $validated['type']     = $this->tagType($request);
        $validated['name']     = $this->tagEquipment($request);
        $validated['operator'] = $this->tagOperator($request);
        $validated['email']    = $this->tagEmail($request);
        $validated['responsible_person'] = $this->tagResponsiblePerson($request);
        if ($request->allocated_to == 'Project') {
            $validated['project_allocated_to'] = json_encode($this->tagProjectAllocatedTo($request));
        }
        $validated['user_id']  = auth()->id();

        dd($request->model, $validated['model']);
        $equipment->update($validated);

        if ($request->attachments) {

            foreach ($request->file('attachments') as $file) {

                Attachment::create([
                    'path'         => $file->store('equipment_attachments_file', 'public'),
                    'name'         => $file->getClientOriginalName(),
                    'type'         => $file->extension(),
                    'equipment_id' => $equipment->id,
                ]);

            }//end of each

        }//end of check file attachments

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

    private function tagMake(EquipmentRequest $request)
    {
        $requestData['make'] = ComboBox::where('name', $request->make)->first();

        if (!$requestData['make']) {
            $type = ComboBox::create(['name' => $request->make, 'type' => 'make','user_id' => auth()->id()]);
            return $requestData['make'] = $type['name'];
        } else {
            return $requestData['make'] = $request->make;
        } 

    }// end of fun


    private function tagModel(EquipmentRequest $request)
    {
        $requestData['model'] = ComboBox::where('name', $request->model)->first();

        if (!$requestData['model']) {
            $type = ComboBox::create(['name' => $request->model, 'type' => 'model','user_id' => auth()->id()]);
            return $requestData['model'] = $type['name'];
        } else {
            return $requestData['model'] = $request->make;
        } 

    }// end of fun

    private function tagType(EquipmentRequest $request)
    {
        $requestData['type'] = ComboBox::where('name', $request->type)->first();

        if (!$requestData['type']) {
            $type = ComboBox::create(['name' => $request->type, 'type' => 'spec_type','user_id' => auth()->id()]);
            return $requestData['type'] = $type['name'];
        } else {
            return $requestData['type'] = $request->type;
        } 

    }// end of fun

    private function tagEquipment(EquipmentRequest $request)
    {
        $requestData['name'] = ComboBox::where('name', $request->name)->first();

        if (!$requestData['name']) {
            $type = ComboBox::create(['name' => $request->name, 'type' => 'equipment','user_id' => auth()->id()]);
            return $requestData['name'] = $type['name'];
        } else {
            return $requestData['name'] = $request->name;
        } 

    }// end of fun

    private function tagOperator(EquipmentRequest $request)
    {
        $requestData['operator'] = ComboBox::where('name', $request->operator ?? 'Driver')->first();

        if (!$requestData['operator']) {
            $type = ComboBox::create(['name' => $request->operator ?? 'Driver', 'type' => 'operator','user_id' => auth()->id()]);
            return $requestData['operator'] = $type['name'];
        } else {
            return $requestData['operator'] = $request->operator ?? 'Driver';
        } 

    }// end of fun

    private function tagEmail(EquipmentRequest $request)
    {
        $requestData['email'] = ComboBox::where('name', $request->email)->first();
        if (!$requestData['email']) {
            $type = ComboBox::create([
                'name' => $request->email, 
                'type' => 'responsible_person_email',
                'user_id' => auth()->id()]);

            return $requestData['email'] = $type['name'];
        } else {
            return $requestData['email'] = $request->email;
        } 

    }// end of fun

    private function tagResponsiblePerson(EquipmentRequest $request)
    {
        $requestData['responsible_person'] = ComboBox::where('name', $request->responsible_person)->first();
        if (!$requestData['responsible_person']) {
            $type = ComboBox::create([
                'name' => $request->responsible_person, 
                'type' => 'responsible_person',
                'user_id' => auth()->id()]);

            return $requestData['responsible_person'] = $type['name'];
        } else {
            return $requestData['responsible_person'] = $request->responsible_person;
        } 

    }// end of fun

    private function tagProjectAllocatedTo(EquipmentRequest $request)
    {

        $requestDataPr = $request->project_allocated_to;

        foreach ($requestDataPr as $key => $data) {
            
            ComboBox::updateOrCreate([
               'name' => ucwords("$data"), 
            ],[
                'type' => 'project_allocated_to',
                'user_id' => auth()->id()
            ]);

        }//end of earch

        return $requestData['project_allocated_to'] = $request->project_allocated_to;

    }// end of fun

    public function type(Request $request)
    {
        $specs = Spec::where('type', $request->type)->get();

        return response()->json($specs);

    }//end of typw

    public function country(Request $request)
    {
        $citys = City::where('country_id', $request->country_id)->get();

        return response()->json($citys);

    }//end of countrys

    public function attachments(Equipment $equipment)
    {
        return view('admin.equipments.attachments', compact('equipment'));

    }//end of fun

}//end of controller