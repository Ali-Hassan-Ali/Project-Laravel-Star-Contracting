<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Spare;
use App\Models\ComboBox;
use App\Http\Requests\Admin\SpareRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SpareController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_spares')->only(['index']);
        $this->middleware('permission:create_spares')->only(['create', 'store']);
        $this->middleware('permission:update_spares')->only(['edit', 'update']);
        $this->middleware('permission:delete_spares')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.spares.index');

    }//end of index 

    public function data()
    {
        $spares = Spare::latest()->get();

        return DataTables::of($spares)
            ->addColumn('record_select', 'admin.spares.data_table.record_select')
            ->editColumn('created_at', function (Spare $spare) {
                return $spare->created_at->format('Y-m-d');
            })
            ->addColumn('admin', function (Spare $spare) {
                return $spare->admin->name;
            })
            ->addColumn('equipment', function (Spare $spare) {
                return $spare->equipment->name;
            })
            ->addColumn('actions', 'admin.spares.data_table.actions')
            ->rawColumns(['record_select', 'actions','equipment'])
            ->toJson();

    }// end of data


    public function create()
    {
        $equipments = Equipment::all();
        $locations  = ComboBox::where('type', 'location')->get();

        return view('admin.spares.create', compact('equipments', 'locations'));

    }//end of create

    
    public function store(SpareRequest $request)
    {
        $requestData                 = $request->validated();
        $requestData['user_id']      = auth()->id();
        $requestData['attachments']  = $request->file('attachments')->store('attachments_spares_file', 'public');
        Spare::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.spares.index');

    }//end of store



    public function edit(Spare $spare)
    {
        $equipments = Equipment::all();
        $locations  = ComboBox::where('type', 'location')->get();

        return view('admin.spares.edit', compact('spare', 'equipments', 'locations'));

    }//end of edit


    public function update(SpareRequest $request, Spare $spare)
    {
        $requestData                 = $request->validated();

        if ($request->attachments) {

            Storage::disk('local')->delete('public/'. $spare->attachments);

            $requestData['attachments'] = $request->file('claim_attachments')->store('attachments_spares_file','public');
        }
        
        $spare->update($requestData);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.spares.index');

    }//end of store

   
    public function destroy(Spare $spare)
    {
        $this->delete($spare);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $spare = Spare::FindOrFail($recordId);
            $this->delete($spare);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Spare $spare)
    {
        Storage::disk('local')->delete('public/'. $spare->attachments);
        
        $spare->delete();

    }// end of delete

}//end of controller