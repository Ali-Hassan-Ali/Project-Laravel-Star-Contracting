<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SpecRequest;
use App\Models\Spec;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class SpecController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_specs')->only(['index']);
        $this->middleware('permission:create_specs')->only(['create', 'store']);
        $this->middleware('permission:update_specs')->only(['edit', 'update']);
        $this->middleware('permission:delete_specs')->only(['delete', 'bulk_delete']);

    }// end of __construct


    public function index()
    {
        return view('admin.specs.index');

    }//end of index

    public function data()
    {
        $specs = Spec::latest()->get();

        return DataTables::of($specs)
            ->addColumn('record_select', 'admin.specs.data_table.record_select')
            ->editColumn('created_at', function (Spec $spec) {
                return $spec->created_at->format('Y-m-d');
            })
            ->editColumn('country', function (Spec $spec) {
                return $spec->country->name;
            })
            ->editColumn('city', function (Spec $spec) {
                return $spec->city->name;
            })
            ->addColumn('admin', function (Spec $spec) {
                return $spec->admin->name;
            })
            ->addColumn('description', function (Spec $spec) {
                return Str::of($spec->description)->limit(70);
            })
            ->addColumn('actions','admin.specs.data_table.actions')
            ->rawColumns(['record_select', 'actions','admin','equipment'])
            ->toJson();

    }// end of data


    public function create()
    {
        $countrys   = Country::all();
        $citys      = City::all();

        return view('admin.specs.create', compact('countrys', 'citys'));

    }// end of create

    public function store(SpecRequest $request)
    {
        $requestData             = $request->validated();
        $requestData['user_id']  = auth()->id();
        spec::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.specs.index');

    }// end of store

    
    public function edit(Spec $spec)
    {
        $countrys   = Country::all();
        $citys      = City::all();

        return view('admin.specs.edit', compact('spec', 'countrys', 'citys'));

    }// end of edit

    
    public function update(SpecRequest $request, Spec $spec)
    {
        $spec->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.specs.index');

    }// end of update

    
    public function destroy(Spec $spec)
    {
        $this->delete($spec);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $spec = Spec::FindOrFail($recordId);
            $this->delete($spec);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Spec $spec)
    {
        $spec->delete();

    }// end of delete

}//end of controller