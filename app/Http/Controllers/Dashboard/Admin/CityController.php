<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:citys_read'])->only('index');
        $this->middleware(['permission:citys_create'])->only('create','store');
        $this->middleware(['permission:citys_update'])->only('edit','update');
        $this->middleware(['permission:citys_delete'])->only('destroy');

    } //end of constructor

    public function index()
    {
        $citys = City::WhenSearch(request()->search)->latest()->paginate(10);

        return view('dashboard_admin.citys.index', compact('citys'));

    }//end of index 


    public function create()
    {
        return view('dashboard_admin.citys.create');

    }//end of create

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:255'],
        ]);

        try {
            
            City::create($request->all());

            session()->flash('success', __('dashboard.added_successfully'));
            return redirect()->route('dashboard.admin.citys.index');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }//end try

    }//end of store



    public function edit(City $city)
    {
        return view('dashboard_admin.citys.edit', compact('city'));

    }//end of edit


    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => ['required','max:255'],
        ]);

        try {
            
            $city->update($request->all());

            session()->flash('success', __('dashboard.updated_successfully'));
            return redirect()->route('dashboard.admin.citys.index');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }//end try

    }//end of store

   
    public function destroy(City $city)
    {
        try {

            $city->delete();

            session()->flash('success', __('dashboard.deleted_successfully'));
            return redirect()->route('dashboard.admin.citys.index');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }//end try

    }//end of destroy

}//end of controller
