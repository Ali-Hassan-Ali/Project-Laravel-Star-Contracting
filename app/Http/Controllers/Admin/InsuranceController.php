<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InsuranceRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Insurance;
use App\Models\Country;
use App\Models\Equipment;
use App\Models\ComboBox;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InsuranceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_insurances')->only(['index']);
        $this->middleware('permission:create_insurances')->only(['create', 'store']);
        $this->middleware('permission:update_insurances')->only(['edit', 'update']);
        $this->middleware('permission:delete_insurances')->only(['delete', 'bulk_delete']);

    }// end of __construct


    public function index()
    {
        return view('admin.insurances.index');

    }//end of index

    public function data()
    {
        if (request()->old) {

            if (request()->start_data && request()->end_data) {

                $insurances = Insurance::query()
                    ->whereDateBetween(request()->start_data, request()->end_data)
                    ->whereYear('created_at', '!=', now()->year);
                
            } else {

                $insurances = Insurance::query()->whereYear('created_at', '!=', now()->year);
            }

            
        } else {

            if (request()->start_data && request()->end_data) {

                $insurances = Insurance::query()
                    ->whereDateBetween(request()->start_data, request()->end_data)
                    ->whereYear('created_at', now()->year);
                
            } else {

                $insurances = Insurance::query()->whereYear('created_at', now()->year);
            }


        }//end of if

        return DataTables::of($insurances)
            ->addColumn('record_select', 'admin.insurances.data_table.record_select')
            ->editColumn('created_at', function (insurance $insurance) {
                return $insurance->created_at->format('d-m-Y');
            })
            ->editColumn('insurance_expiry', function (insurance $insurance) {
                return $insurance->insurance_expiry ? date('d-m-Y', strtotime($insurance->insurance_expiry)) : '';
            })
            ->editColumn('claim_date', function (insurance $insurance) {
                return $insurance->claim_date ? date('d-m-Y', strtotime($insurance->claim_date)) : '';
            })
            ->editColumn('insurance_start_date', function (insurance $insurance) {
                return $insurance->insurance_start_date ? date('d-m-Y', strtotime($insurance->insurance_start_date)) : '';
            })            
            ->editColumn('claim', function (insurance $insurance) {
                return view('admin.insurances.data_table._claim', compact('insurance'));
            })
            ->editColumn('attachments', function (insurance $insurance) {
                return view('admin.insurances.data_table._attachments', compact('insurance'));
            })
            ->addColumn('equipment', function (Insurance $insurance) {
                return $insurance->equipment ?
                    $insurance->equipment->name . ' ' . $insurance->equipment->make . ' ' . $insurance->equipment->plate_no 
                 : '';
            })
            ->addColumn('admin', function (Insurance $insurance) {
                return $insurance->admin->name ?? '';
            })
            ->addColumn('actions','admin.insurances.data_table.actions','claim','attachments')
            ->rawColumns(['record_select', 'actions','admin','equipment'])
            ->toJson();

    }// end of data

    public function create()
    {
        $equipments = Equipment::all();
        $insurers   = ComboBox::where('type', 'insurer')->get();
        $countrys   = Country::all();
        $type_insurances  = ComboBox::where('type', 'type_of_insurance')->get();

        return view('admin.insurances.create', compact('equipments', 'insurers', 'type_insurances', 'countrys'));

    }// end of create

    public function store(InsuranceRequest $request)
    {
        $validated = $request->validated();
        $validated = $request->safe()->except(['attachments','insurer','type_of_insurance','claim']);
        
        $validated['insurer']           = $this->tagInsurer($request);
        $validated['type_of_insurance'] = $this->tagInsurerType($request);
        $validated['user_id']           = auth()->id();
        $validated['claim']             = request()->has('claim') ? '1' : '0';

        $insurance = Insurance::create($validated);

        foreach ($request->file('attachments') as $file) {
            
            Attachment::create([
                'path'         => $file->store('insurances_attachments_file'),
                'name'         => $file->getClientOriginalName(),
                'insurance_id' => $insurance->id,
            ]);

        }//end of rach

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.insurances.index');

    }// end of store

    
    public function edit(Insurance $insurance)
    {
        $equipments       = Equipment::all();
        $insurers         = ComboBox::where('type', 'insurer')->get();
        $type_insurances  = ComboBox::where('type', 'type_of_insurance')->get();
        $countrys         = Country::all();

        return view('admin.insurances.edit', compact('insurance', 'equipments', 'insurers', 'type_insurances', 'countrys'));

    }// end of edit

    
    public function update(InsuranceRequest $request, Insurance $insurance)
    {

        $validated = $request->validated();
        dd($validated);
        $validated = $request->safe()->except(['claim_attachments','insurer','type_of_insurance','claim']);

        $validated['insurer']           = $this->tagInsurer($request);
        $validated['type_of_insurance'] = $this->tagInsurerType($request);
        $validated['user_id']           = auth()->id();
        $validated['claim']             = request()->has('claim') ? '1' : '0';

        $insurance->update($validated);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.insurances.index');

    }// end of update

    
    public function destroy(Insurance $insurance)
    {
        $this->delete($insurance);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $insurance = Insurance::FindOrFail($recordId);
            $this->delete($insurance);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(insurance $insurance)
    {
        Storage::disk('local')->delete('public/'. $insurance->attachments);
        
        $insurance->delete();

    }// end of delete

    private function tagInsurer(InsuranceRequest $request)
    {

        $requestData['insurer'] = ComboBox::where('name', $request->insurer)->first();
        
        if (!$requestData['insurer']) {
            $insurer = ComboBox::create(['name' => $request->insurer, 'type' => 'insurer','user_id' => auth()->id()]);
            return $requestData['insurer'] = $insurer['name'];
        } else {
            return $requestData['insurer'] = $request->insurer;
        } 

    }// end of fun

    private function tagInsurerType(InsuranceRequest $request)
    {
        $requestData['type_of_insurance'] = ComboBox::where('name', $request->type_of_insurance)->first();

        if (!$requestData['type_of_insurance']) {
            $type_of_insurance = ComboBox::create(['name' => $request->type_of_insurance, 'type' => 'type_of_insurance','user_id' => auth()->id()]);
            return $requestData['type_of_insurance'] = $type_of_insurance['name'];
        } else {
            return $requestData['type_of_insurance'] = $request->type_of_insurance;
        } 

    }// end of fun

    public function claim(Request $request)
    {
        $insurance = insurance::FindOrFail($request->id);
        $insurance->update(['claim' => $request->claim]);

        session()->flash('success', __('site.updated_successfully'));
        return response(__('site.updated_successfully'));
        

    }// end of delete

}//end of controller