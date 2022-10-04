<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequestPartRequest;
use App\Models\RequestPart;
use App\Models\Eir;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RequestPartController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_request_parts')->only(['index']);
        $this->middleware('permission:create_request_parts')->only(['create', 'store']);
        $this->middleware('permission:update_request_parts')->only(['edit', 'update']);
        $this->middleware('permission:delete_request_parts')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.request_parts.index');

    }//end of index 

    public function data()
    {
        if (request()->old) {

            if (request()->start_data && request()->end_data) {

                $request_parts = RequestPart::query()
                    ->whereDateBetween(request()->start_data, request()->end_data)
                    ->whereYear('created_at', '!=', now()->year);
                
            } else {

                $request_parts = RequestPart::query()->whereYear('created_at', '!=', now()->year);
            }
            
        } else {

            if (request()->start_data && request()->end_data) {

                $request_parts = RequestPart::query()
                    ->whereDateBetween(request()->start_data, request()->end_data)
                    ->whereYear('created_at', now()->year);
                
            } else {

                $request_parts = RequestPart::query()->whereYear('created_at', now()->year);
            }


        }//end of if

        return DataTables::of($request_parts)
            ->addColumn('record_select', 'admin.request_parts.data_table.record_select')
            ->editColumn('created_at', function (RequestPart $requestPart) {
                return $requestPart->created_at->format('m-d-');
            })
            ->addColumn('eir_date', function (RequestPart $requestPart) {
                return $requestPart->eir_id;
            })
            ->addColumn('actions', 'admin.request_parts.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        $eirs = Eir::all();

        return view('admin.request_parts.create', compact('eirs'));

    }//end of create

    
    public function store(RequestPartRequest $request)
    {
        $requestData             = $request->validated();
        $requestData['user_id']  = auth()->id();
        RequestPart::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.request_parts.index');

    }//end of store



    public function edit(RequestPart $request_part)
    {
        $eirs = Eir::all();

        return view('admin.request_parts.edit', compact('request_part','eirs'));

    }//end of edit


    public function update(RequestPartRequest $request, RequestPart $request_part)
    {
        $request_part->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.request_parts.index');

    }//end of store

   
    public function destroy(RequestPart $request_part)
    {
        $this->delete($request_part);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $request_part = RequestPart::FindOrFail($recordId);
            $this->delete($request_part);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(RequestPart $request_part)
    {
        $request_part->delete();

    }// end of delete

}//end of controller