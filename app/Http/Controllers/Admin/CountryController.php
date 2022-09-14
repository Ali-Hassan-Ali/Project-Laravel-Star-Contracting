<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CountryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:read_countrys')->only(['index']);
        $this->middleware('permission:create_countrys')->only(['create', 'store']);
        $this->middleware('permission:update_countrys')->only(['edit', 'update']);
        $this->middleware('permission:delete_countrys')->only(['delete', 'bulk_delete']);

    }// end of __construct


    public function index()
    {
        return view('admin.countrys.index');

    }//end of index

    public function data()
    {
        $countrys = Country::latest()->get();

        return DataTables::of($countrys)
            ->addColumn('record_select', 'admin.countrys.data_table.record_select')
            ->editColumn('created_at', function (Country $country) {
                return $country->created_at->format('Y-m-d');
            })
            ->addColumn('admin', function (Country $country) {
                return $country->admin->name;
            })
            ->addColumn('actions','admin.countrys.data_table.actions')
            ->rawColumns(['record_select', 'actions','admin'])
            ->toJson();

    }// end of data


    public function create()
    {
        return view('admin.countrys.create');

    }// end of create

    
    public function store(CountryRequest $request)
    {
        $requestData             = $request->validated();
        $requestData['user_id']  = auth()->id();
        Country::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.countrys.index');

    }// end of store

    
    public function edit(Country $country)
    {
        return view('admin.countrys.edit', compact('country'));

    }// end of edit

    
    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.countrys.index');

    }// end of update

    
    public function destroy(Country $country)
    {
        $this->delete($country);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $country = Country::FindOrFail($recordId);
            $this->delete($country);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Country $country)
    {
        $country->delete();

    }// end of delete

}//end of controller