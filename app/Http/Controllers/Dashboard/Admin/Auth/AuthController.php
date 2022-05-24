<?php

namespace App\Http\Controllers\Dashboard\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Admin;

class AuthController extends Controller
{
    public function index()
    {
        if (!auth()->guard('admin')->check()) {
            
            return view('dashboard_admin.auth.login');

        }//end of if

        return redirect()->route('dashboard.admin.welcome');

    }//end of index login function
    

    public function store(Request $request)
    {

       $request->validate([
            'email'     => ['required', 'email'],
            'password'  => ['required'],
        ]);

        // try {

            $credentials = $request->only('email', 'password');

            $auth = auth()->guard('admin')->attempt($credentials);

            if ($auth) {
                
                session()->flash('success', __('dashboard.login_successfully'));
                return redirect()->route('dashboard.admin.welcome');

            }//end of auth

            return back()->withErrors(['email' => 'The email is incorrect']);


            if (auth()->guard('admin')->check()) {

                return redirect()->route('dashboard.admin.welcome');
                
            } else {

                if (Admin::where('email', $request->email)->first()) {

                   return \Auth::guard('admin')->attempt($credentials);

                    if (\Auth::guard('admin')->attempt($credentials)) {
                        // session()->flash('success', __('dashboard.login_successfully'));
                        // return redirect()->route('dashboard.admin.welcome');
                        // return view('dashboard_admin.welcome');
                    }


                    return back()->withErrors([
                        'password' => 'The password is incorrect'
                    ]);

                } else {

                    return back()->withErrors([
                        'email' => 'The email is incorrect'
                    ]);

                }//end of email
                
            }//end of if auth
            
        // } catch (\Exception $e) {

        //     return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            
        // }//end of try catch

    }//end of login store function

    public function logout()
    {
        auth()->guard('admin')->logout();

        session()->flash('success', __('dashboard.logoute_successfully'));
        return view('dashboard_admin.auth.login');

    }//end of logout admin

    public function edit()
    {   
        $Admin = Admin::find(auth()->Admin()->id);

        return view('dashboard.profile.edit',compact('Admin'));

    }//end of edit profile

    public function update(Request $request, Admin $Admin)
    {

        $request->validate([
            'name'        => ['required','max:255'],
            'email'       => ['required', Rule::unique('Admins')->ignore($Admin->id)],
        ]);

        try {

            $request_data             = $request->except(['password', 'password_confirmation', 'image']);
            $request_data['password'] = bcrypt($request->password);

            if ($request->image) {

                if ($Admin->image != 'default.png') {

                    Storage::disk('local')->delete('/Admin_images/' . $Admin->image);

                } //end of inner if

                $request_data['image'] = $request->file('image')->store('Admin_images','public');

            } //end of external if

            $Admin->update($request_data);

            session()->flash('success', __('dashboard.updated_successfully'));
            return redirect()->route('dashboard.admin.welcome');

        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }//end try

    }//end of update profile

}//end of controller