<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ComboBoxRequest;
use App\Models\ComboBox;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ComboBoxController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read_combo_boxs')->only(['index']);
        $this->middleware('permission:create_combo_boxs')->only(['create', 'store']);
        $this->middleware('permission:update_combo_boxs')->only(['edit', 'update']);
        $this->middleware('permission:delete_combo_boxs')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.combo_boxs.index');

    }//end of index 

    public function data()
    {
        if (request()->type) {

            $ComboBoxs = ComboBox::where('type', request()->type)->latest()->get();
            
        } else {

            $ComboBoxs = ComboBox::latest()->get();
        }

        return DataTables::of($ComboBoxs)
            ->addColumn('record_select', 'admin.combo_boxs.data_table.record_select')
            ->editColumn('created_at', function (ComboBox $ComboBox) {
                return $ComboBox->created_at->format('Y-m-d');
            })
            ->addColumn('admin', function (ComboBox $ComboBox) {
                return $ComboBox->admin->name;
            })
            ->addColumn('actions', 'admin.combo_boxs.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data


    public function create()
    {
        return view('admin.combo_boxs.create');

    }//end of create

    
    public function store(ComboBoxRequest $request)
    {
        $requestData             = $request->validated();
        $requestData['user_id']  = auth()->id();
        ComboBox::create($requestData);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.combo_boxs.index');

    }//end of store



    public function edit(ComboBox $ComboBox)
    {
        return view('admin.combo_boxs.edit', compact('ComboBox'));

    }//end of edit


    public function update(ComboBoxRequest $request, ComboBox $ComboBox)
    {
        $ComboBox->update($request->validated());

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.combo_boxs.index');

    }//end of store

   
    public function destroy(ComboBox $ComboBox)
    {
        $this->delete($ComboBox);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $ComboBox = ComboBox::FindOrFail($recordId);
            $this->delete($ComboBox);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(ComboBox $ComboBox)
    {
        $ComboBox->delete();

    }// end of delete

}//end of controller