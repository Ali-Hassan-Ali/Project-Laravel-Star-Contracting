<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\EmailSystem;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\EmailSystemRequest;
use Yajra\DataTables\DataTables;

class EmailSystemController extends Controller
{
    public function __construct()
    {
//        $this->middleware('permission:read_email_systems')->only(['index']);
//        $this->middleware('permission:create_email_systems')->only(['create', 'store']);
//        $this->middleware('permission:update_email_systems')->only(['edit', 'update']);
//        $this->middleware('permission:delete_email_systems')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.email_systems.index');

    }//end of index 

    public function data()
    {
        $EmailSystems = EmailSystem::latest()->get();

        return DataTables::of($EmailSystems)
            ->addColumn('record_select', 'admin.email_systems.data_table.record_select')
            ->editColumn('type', function (EmailSystem $EmailSystem) {
                return __('email_systems.'. $EmailSystem->type);
            })
            ->addColumn('country', function (EmailSystem $EmailSystem) {
                return $EmailSystem->country->name;
            })
            ->addColumn('city', function (EmailSystem $EmailSystem) {
                return $EmailSystem->city->name;
            })
            ->addColumn('actions', 'admin.email_systems.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        $countrys = Country::all();
        $citys    = City::all();

        return view('admin.email_systems.create', compact('countrys', 'citys'));

    }//end of create


    public function store(EmailSystemRequest $request)
    {
        $requestData             = $request->validated();
        $requestData['user_id']  = auth()->id();
        EmailSystem::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.email_systems.index');

    }//end of store



    public function edit(EmailSystem $EmailSystem)
    {
        $countrys = Country::all();
        $citys    = City::all();

        return view('admin.email_systems.edit', compact('EmailSystem','countrys', 'citys'));

    }//end of edit


    public function update(EmailSystemRequest $request, EmailSystem $EmailSystem)
    {
        $EmailSystem->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.email_systems.index');

    }//end of store


    public function destroy(EmailSystem $EmailSystem)
    {
        $this->delete($EmailSystem);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $EmailSystem = EmailSystem::FindOrFail($recordId);
            $this->delete($EmailSystem);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(EmailSystem $EmailSystem)
    {
        $EmailSystem->delete();

    }// end of delete

}//end of controller