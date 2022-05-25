<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CityRequest;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_citys')->only(['index']);
        $this->middleware('permission:create_citys')->only(['create', 'store']);
        $this->middleware('permission:update_citys')->only(['edit', 'update']);
        $this->middleware('permission:delete_citys')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.citys.index');

    }//end of index 

    public function data()
    {
        $citys = City::latest()->get();

        return DataTables::of($citys)
            ->addColumn('record_select', 'admin.citys.data_table.record_select')
            ->editColumn('created_at', function (City $city) {
                return $city->created_at->format('Y-m-d');
            })
            ->addColumn('admin', function (City $city) {
                return $city->admin->name;
            })
            ->addColumn('country', function (City $city) {
                return $city->country->name;
            })
            ->addColumn('actions', 'admin.citys.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        $countrys = Country::all();

        return view('admin.citys.create', compact('countrys'));

    }//end of create

    
    public function store(CityRequest $request)
    {
        $requestData             = $request->validated();
        $requestData['user_id']  = auth()->id();
        City::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.citys.index');

    }//end of store



    public function edit(City $city)
    {
        $countrys = Country::all();

        return view('admin.citys.edit', compact('city','countrys'));

    }//end of edit


    public function update(CityRequest $request, City $city)
    {
        $city->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.citys.index');

    }//end of store

   
    public function destroy(City $city)
    {
        $this->delete($city);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $city = City::FindOrFail($recordId);
            $this->delete($city);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(City $city)
    {
        $city->delete();

    }// end of delete

}//end of controller