<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Role;
use App\Models\User;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_admins')->only(['index']);
        $this->middleware('permission:create_admins')->only(['create', 'store']);
        $this->middleware('permission:update_admins')->only(['edit', 'update']);
        $this->middleware('permission:delete_admins')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        $roles = Role::whereNotIn('name', ['super_admin', 'admin', 'user'])->get();
        return view('admin.admins.index', compact('roles'));

    }// end of index

    public function data()
    {
        $admins = User::whereRoleIs('admin')
            ->whenRoleId(request()->role_id);

        return DataTables::of($admins)
            ->addColumn('record_select', 'admin.admins.data_table.record_select')
            ->addColumn('roles', function (User $admin) {
                return view('admin.admins.data_table.roles', compact('admin'));
            })
            ->editColumn('created_at', function (User $admin) {
                return $admin->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.admins.data_table.actions')
            ->rawColumns(['record_select', 'roles', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        $roles = Role::whereNotIn('name', ['super_admin', 'admin'])->get();

        return view('admin.admins.create', compact('roles'));

    }// end of create

    public function store(AdminRequest $request)
    {
        $requestData = $request->validated();
        $requestData['password'] = bcrypt($request->password);

        $admin = User::create($request->all());
        $admin->attachRoles(['admin', $request->role_id]);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.admins.index');

    }// end of store

    public function edit(User $admin)
    {
        $roles = Role::whereNotIn('name', ['super_admin', 'admin'])->get();

        return view('admin.admins.edit', compact('admin', 'roles'));

    }// end of edit

    public function update(AdminRequest $request, User $admin)
    {
        $admin->update($request->validated());
        $admin->syncRoles(['admin', $request->role_id]);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.admins.index');

    }// end of update

    public function destroy(User $admin)
    {
        $this->delete($admin);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $admin = User::FindOrFail($recordId);
            $this->delete($admin);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(User $admin)
    {
        $admin->delete();

    }// end of delete

}//end of controller
