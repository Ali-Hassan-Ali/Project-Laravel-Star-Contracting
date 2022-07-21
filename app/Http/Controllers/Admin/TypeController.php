<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TypeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:read_types')->only(['index']);
        $this->middleware('permission:create_types')->only(['create', 'store']);
        $this->middleware('permission:update_types')->only(['edit', 'update']);
        $this->middleware('permission:delete_types')->only(['delete', 'bulk_delete']);

    }// end of __construct


    public function index()
    {
        return view('admin.types.index');

    }//end of index

    public function data()
    {
        $types = Type::latest()->get();

        return DataTables::of($types)
            ->addColumn('record_select', 'admin.types.data_table.record_select')
            ->editColumn('created_at', function (Type $type) {
                return $type->created_at->format('Y-m-d');
            })
            ->addColumn('admin', function (Type $type) {
                return $type->admin->name;
            })
            ->addColumn('actions','admin.types.data_table.actions')
            ->rawColumns(['record_select', 'actions','admin'])
            ->toJson();

    }// end of data


    public function create()
    {
        return view('admin.types.create'));

    }// end of create

    public function store(TypeRequest $request)
    {
        $requestData             = $request->validated();
        $requestData['user_id']  = auth()->id();
        Type::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.types.index');

    }// end of store

    
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));

    }// end of edit

    
    public function update(TypeRequest $request, Type $type)
    {
        $type->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.types.index');

    }// end of update

    
    public function destroy(Type $type)
    {
        $this->delete($type);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $type = Type::FindOrFail($recordId);
            $this->delete($type);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Type $type)
    {
        $type->delete();

    }// end of delete

}//end of controller