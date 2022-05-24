<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\City;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        //create read update delete
        $this->middleware(['permission:admins_read'])->only('index');
        $this->middleware(['permission:admins_create'])->only('create','store');
        $this->middleware(['permission:admins_update'])->only('edit','update');
        $this->middleware(['permission:admins_delete'])->only('destroy');

    } //end of constructor
    
    public function index()
    {
        $admins = Admin::whereRoleIs('admin')->WhenSearch(request()->search)->latest()->paginate(10);

        return view('dashboard_admin.admins.index', compact('admins'));

    }//end of index

    
    public function create()
    {
        $citys = City::all();

        return view('dashboard_admin.admins.create', compact('citys'));

    }//end of create

    
    public function store(Request $request)
    {
         $request->validate([
            'name'        => ['required','max:255'],
            'email'       => ['required','unique:admins'],
            'phone'       => ['required','unique:admins','max:11','min:8'],
            'password'    => ['required','confirmed'],
            'permissions' => ['required','min:1'],
            'city_id'     => ['required','numeric'],
        ]);

        try {

            $request_data             = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
            $request_data['password'] = bcrypt($request->password);

            if ($request->image) {

                $request_data['image'] = $request->file('image')->store('admin_images','public');

            } //end of if
            $request_data['city_id'] = $request->city_id;
            $admin = Admin::create($request_data);
            
            $admin->attachRole('admin');
            $admin->syncPermissions($request->permissions);

            session()->flash('success', __('dashboard.added_successfully'));
            return redirect()->route('dashboard.admin.admins.index');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }//end try

    }//end of store


    public function edit(Admin $admin)
    {
        $citys = City::all();

        return view('dashboard_admin.admins.edit', compact('admin','citys'));

    }//end of edit

   
    public function update(Request $request, Admin $admin)
    {
         $request->validate([
            'name'        => ['required','max:255'],
            'email'       => ['required', Rule::unique('admins')->ignore($admin->id)],
            'phone'       => ['required', Rule::unique('admins')->ignore($admin->id)],
            'permissions' => ['required','min:1'],
            'city_id'     => ['required','numeric'],
        ]);

        try {
            
            $request_data = $request->except(['permissions', 'image','password','password_confirmation']);

            if ($request->image) {

                if ($admin->image != 'admin_images/default.png') {

                    Storage::disk('local')->delete('public/'. $admin->image);

                } //end of inner if

                $request_data['image'] = $request->file('image')->store('admin_images','public');

            } //end of external if
            
            $admin->update($request_data);

            $admin->syncPermissions($request->permissions);
            session()->flash('success', __('dashboard.updated_successfully'));
            return redirect()->route('dashboard.admin.admins.index');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }//end try

    }//end of update


    public function destroy(Admin $admin)
    {
        try {

            if ($admin->image != 'admin_images/default.png') {

                Storage::disk('local')->delete('public/'. $admin->image);

            } //end of inner if

            $admin->delete();

            session()->flash('success', __('dashboard.deleted_successfully'));
            return redirect()->route('dashboard.admin.admins.index');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }//end try

    }//end of destroy
    

}//end of controller
