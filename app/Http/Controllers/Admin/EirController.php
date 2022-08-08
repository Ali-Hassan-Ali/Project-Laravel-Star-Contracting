<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EirRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Equipment;
use App\Models\Eir;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EirController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_eirs')->only(['index']);
        $this->middleware('permission:create_eirs')->only(['create', 'store']);
        $this->middleware('permission:update_eirs')->only(['edit', 'update']);
        $this->middleware('permission:delete_eirs')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.eirs.index');

    }//end of index 

    public function data()
    {
        $eirs = Eir::latest()->get();

        return DataTables::of($eirs)
            ->addColumn('record_select', 'admin.eirs.data_table.record_select')
            ->editColumn('created_at', function (Eir $eir) {
                return $eir->created_at->format('Y-m-d');
            })
            ->addColumn('admin', function (Eir $eir) {
                return $eir->admin->name;
            })
            ->addColumn('equipment', function (Eir $eir) {
                return $eir->equipment->name ?? '';
            })
            ->addColumn('actions', 'admin.eirs.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        $equipments = Equipment::all();

        return view('admin.eirs.create', compact('equipments'));

    }//end of create

    
    public function store(EirRequest $request)
    {
        $requestData                = $request->validated();
        $requestData['user_id']     = auth()->id();
        $requestData['attachments'] = $request->file('attachments')->store('attachments_eirs_file', 'public');
        eir::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.eirs.index');

    }//end of store



    public function edit(Eir $eir)
    {
        $equipments = Equipment::all();

        return view('admin.eirs.edit', compact('eir','equipments'));

    }//end of edit


    public function update(eirRequest $request, Eir $eir)
    {
        $requestData                 = $request->validated();
        if ($request->attachments) {

            Storage::disk('local')->delete('public/'. $eir->attachments);

            $requestData['attachments'] = $request->file('attachments')->store('attachments_eirs_file','public');
        }
        
        $eir->update($requestData);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.eirs.index');

    }//end of store

   
    public function destroy(Eir $eir)
    {
        $this->delete($eir);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $eir = Eir::FindOrFail($recordId);
            $this->delete($eir);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Eir $eir)
    {
        Storage::disk('local')->delete('public/'. $eir->attachments);
        $eir->delete();

    }// end of delete

}//end of controller