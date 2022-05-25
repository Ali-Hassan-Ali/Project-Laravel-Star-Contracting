<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_users')->only(['index']);
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:update_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.users.index');

    }// end of index

    public function data()
    {
        $users = User::where('type', 'user')->select();

        return DataTables::of($users)
            ->addColumn('record_select', 'admin.users.data_table.record_select')
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->format('Y-m-d');
            })
            ->addColumn('actions', 'admin.users.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        return view('admin.users.create');

    }// end of create

    public function store(UserRequest $request)
    {
        $requestData = $request->validated();
        $requestData['password'] = bcrypt($request->password);

        User::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.users.index');

    }// end of store

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));

    }// end of edit

    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.users.index');

    }// end of update

    public function destroy(User $user)
    {
        $this->delete($user);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $user = User::FindOrFail($recordId);
            $this->delete($user);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(User $user)
    {
        $user->delete();

    }// end of delete

}//end of controller
