<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InsuranceRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Insurance;
use App\Models\Equipment;
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
        $insurances = Insurance::select();

        return DataTables::of($insurances)
            ->addColumn('record_select', 'admin.insurances.data_table.record_select')
            ->editColumn('created_at', function (insurance $insurance) {
                return $insurance->created_at->format('Y-m-d');
            })
            ->addColumn('equipment', function (Insurance $insurance) {
                return $insurance->equipment->name;
            })
            ->addColumn('admin', function (Insurance $insurance) {
                return $insurance->admin->name;
            })
            ->addColumn('actions','admin.insurances.data_table.actions')
            ->rawColumns(['record_select', 'actions','admin','equipment'])
            ->toJson();

    }// end of data

    public function create()
    {
        $equipments = Equipment::all();

        return view('admin.insurances.create', compact('equipments'));

    }// end of create

    public function store(InsuranceRequest $request)
    {
        $requestData                 = $request->except('claim_attachments');
        $requestData['user_id']      = auth()->id();
        $requestData['attachments']  = $request->file('claim_attachments')->store('claim_attachments_image','public');

        Insurance::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.insurances.index');

    }// end of store

    
    public function edit(Insurance $insurance)
    {
        $equipments = Equipment::all();

        return view('admin.insurances.edit', compact('insurance','equipments'));

    }// end of edit

    
    public function update(InsuranceRequest $request, Insurance $insurance)
    {
        $requestData                 = $request->except('claim_attachments');
        $requestData['user_id']      = auth()->id();

        if ($request->attachments) {

            Storage::disk('local')->delete('public/'. $insurance->attachments);

            $requestData['attachments'] = $request->file('claim_attachments')->store('claim_attachments_image','public');
        }

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

}//end of controller