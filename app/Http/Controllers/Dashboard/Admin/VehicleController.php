<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\City;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:vehicles_read'])->only('index');
        $this->middleware(['permission:vehicles_create'])->only('create','store');
        $this->middleware(['permission:vehicles_update'])->only('edit','update');
        $this->middleware(['permission:vehicles_delete'])->only('destroy');

    } //end of constructor

    public function index()
    {
        $vehicles = Vehicle::WhenSearch(request()->search)->latest()->paginate(10);

        return view('dashboard_admin.vehicles.index', compact('vehicles'));

    }//end of index

        
    public function create()
    {
        $citys = City::all();

        return view('dashboard_admin.vehicles.create', compact('citys'));

    }//end of create


    public function store(Request $request)
    {
        $request->validate([
            // 'plate'           => ['required'],
            // 'car_model'       => ['required','max:255'],
            // 'car_brand'       => ['required','max:255'],
            // 'mechanic_name'   => ['required'],
            // 'maifunction'     => ['required'],
            // 'date_of_send'    => ['required'],
            // 'city_id'         => ['required','numeric'],
            // 'date_of_recieve' => ['required'],
            // 'services_cost'   => ['required'],
        ]);

        // try {

            $request_data['city_id']                  = 1;
            $request_data['admin_id']                 = auth()->guard('admin')->user()->id;
            $request_data['insurance_scan']     = $request->file('insurance_scan')->store('insurance_scan_image','public');
            $request_data['registeration_scan'] = $request->file('registeration_scan')->store('registeration_scan_image','public');
            Vehicle::create($request_data);

            session()->flash('success', __('dashboard.added_successfully'));
            return redirect()->route('dashboard.admin.vehicles.index');

        // } catch (\Exception $e) {

            // return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        // }//end try

    }//end of store

    
    public function show(Vehicle $vehicle)
    {
        return view('dashboard_admin.vehicles.show', compact('vehicle'));

    }//end of show

    
    public function edit(Vehicle $vehicle)
    {
        return view('dashboard_admin.vehicles.edit', compact('vehicle'));

    }//end of  edit


    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'plate_no'        => ['required','max:255'],
            'car_model'       => ['required','max:255'],
            'car_brand'       => ['required','max:255'],
            'mechanic_name'   => ['required'],
            'maifunction'     => ['required'],
            'date_of_send'    => ['required'],
            'city_id'         => ['required','numeric'],
            'date_of_recieve' => ['required'],
            'services_cost'   => ['required'],
        ]);

        try {

            if ($request->registeration_scan) {
                
                $request_data['registeration_scan_image'] = $request->file('registeration_scan')->store('registeration_scan_image','public');

            }//end of if

            if ($request->insurance_scan) {

                $request_data['insurance_scan_image']     = $request->file('insurance_scan')->store('insurance_scan_image','public');

            }//end of if

            $request_data['admin_id'] = auth()->guard('admin')->user()->id;
            Vehicle::create($request_data);

            session()->flash('success', __('dashboard.updated_successfully'));
            return redirect()->route('dashboard.admin.vehicles.index');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }//end try

    }//end of update

    
    public function destroy(Vehicle $vehicle)
    {
        try {

            if ($vehicle->registeration_scan != 'registeration_scan_image/default.png') {

                Storage::disk('local')->delete('public/'. $vehicle->registeration_scan);

            } //end of inner if

            if ($vehicle->insurance_scan != 'insurance_scan_image/default.png') {

                Storage::disk('local')->delete('public/'. $vehicle->insurance_scan);

            } //end of inner if

            $vehicle->delete();

            session()->flash('success', __('dashboard.deleted_successfully'));
            return redirect()->route('dashboard.admin.admins.index');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }//end try

    }//end of destroy
    

}//end of controller
