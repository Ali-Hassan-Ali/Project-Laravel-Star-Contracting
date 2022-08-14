<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Spare;
use App\Models\Country;
use App\Models\City;
use App\Models\Attachment;
use App\Http\Requests\Admin\SpareRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SpareController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_spares')->only(['index']);
        $this->middleware('permission:create_spares')->only(['create', 'store']);
        $this->middleware('permission:update_spares')->only(['edit', 'update']);
        $this->middleware('permission:delete_spares')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.spares.index');

    }//end of index 

    public function data()
    {
        $spares = Spare::latest()->get();

        return DataTables::of($spares)
            ->addColumn('record_select', 'admin.spares.data_table.record_select')
            ->editColumn('created_at', function (Spare $spare) {
                return $spare->created_at->format('Y-m-d');
            })
            ->editColumn('used', function (Spare $spare) {
                return view('admin.spares.data_table._used', compact('spare'));
            })       
            ->editColumn('usage_date', function (Spare $spare) {
                return $spare->usage_date ? date('d-m-Y', strtotime($spare->usage_date)) : '';
            })            
            ->addColumn('admin', function (Spare $spare) {
                return $spare->admin->name ?? '';
            })
            ->addColumn('location', function (Spare $spare) {
                return $spare->city->name ?? '';
            })
            ->editColumn('attachments', function (Spare $spare) {
                return view('admin.spares.data_table._attachments', compact('spare'));
            })
            ->addColumn('equipment', function (Spare $spare) {
                return view('admin.spares.data_table._equipment', compact('spare'));
            })
            ->addColumn('actions', 'admin.spares.data_table.actions')
            ->rawColumns(['record_select', 'actions','equipment'])
            ->toJson();

    }// end of data


    public function create()
    {
        $equipments = Equipment::all();
        $citys      = City::all();
        $countrys   = Country::all();

        return view('admin.spares.create', compact('equipments', 'citys', 'countrys'));

    }//end of create

    
    public function store(SpareRequest $request)
    {

        $validated = $request->validated();
        $validated = $request->safe()->except(['attachments','used','usage_date', 'equipments']);

        $validated['used']       = request()->has('used') ? '1' : '0';
        $validated['user_id']    = auth()->id();
        $validated['equipments'] = json_encode($request->equipments);

        $spare = Spare::create($validated);
        $spare->equipments()->sync($request->equipments);

        foreach ($request->file('attachments') as $file) {
            
            Attachment::create([
                'path'     => $file->store('attachments_attachments_file'),
                'spare_id' => $spare->id,
            ]);

        }//end of rach

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.spares.index');

    }//end of store



    public function edit(Spare $spare)
    {
        $equipments = Equipment::all();
        $citys      = City::all();
        $countrys   = Country::all();

        return view('admin.spares.edit', compact('spare', 'equipments', 'citys', 'countrys'));

    }//end of edit


    public function update(SpareRequest $request, Spare $spare)
    {
        $validated = $request->validated();
        $validated = $request->safe()->except(['attachments','used', 'equipments']);

        $validated['used']       = request()->has('used') ? '1' : '0';
        $validated['user_id']    = auth()->id();
        $validated['equipments'] = json_encode($request->equipments);

        $spare->update($validated);
        $spare->equipments()->sync($request->equipments);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.spares.index');

    }//end of store

   
    public function destroy(Spare $spare)
    {
        $this->delete($spare);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $spare = Spare::FindOrFail($recordId);
            $this->delete($spare);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Spare $spare)
    {
        Storage::disk('local')->delete('public/'. $spare->attachments);
        
        $spare->delete();

    }// end of delete

}//end of controller