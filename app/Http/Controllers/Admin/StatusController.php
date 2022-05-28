<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StatusRequest;
use App\Models\Equipment;
use App\Models\Status;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_status')->only(['index']);
        $this->middleware('permission:create_status')->only(['create', 'store']);
        $this->middleware('permission:update_status')->only(['edit', 'update']);
        $this->middleware('permission:delete_status')->only(['delete', 'bulk_delete']);

    }// end of __construct


    public function index()
    {
        return view('admin.status.index');

    }//end of index

    public function data()
    {
        $statuss = Status::latest()->get();

        return DataTables::of($statuss)
            ->addColumn('record_select', 'admin.status.data_table.record_select')
            ->editColumn('created_at', function (Status $status) {
                return $status->created_at->format('Y-m-d');
            })
            ->addColumn('admin', function (Status $status) {
                return $status->admin->name;
            })
            ->addColumn('actions','admin.status.data_table.actions')
            ->rawColumns(['record_select', 'actions','admin'])
            ->toJson();

    }// end of data


    public function create()
    {
        $equipments = Equipment::all();

        return view('admin.status.create', compact('equipments'));

    }// end of create

    
    public function store(StatusRequest $request)
    {
        $requestData             = $request->validated();
        $requestData['user_id']  = auth()->id();
        Status::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.status.index');

    }// end of store

    
    public function edit(Status $status)
    {
        $equipments = Equipment::all();

        return view('admin.status.edit', compact('status','equipments'));

    }// end of edit

    
    public function update(StatusRequest $request, Status $status)
    {
        $status->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.status.index');

    }// end of update

    
    public function destroy(Status $status)
    {
        $this->delete($status);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $status = Status::FindOrFail($recordId);
            $this->delete($status);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Status $status)
    {
        $status->delete();

    }// end of delete

}//end of controller