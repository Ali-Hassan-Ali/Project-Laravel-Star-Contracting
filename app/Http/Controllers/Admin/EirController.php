<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EirRequest;
use App\Models\City;
use App\Models\EmailSystem;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\RequestPart;
use App\Models\Attachment;
use App\Models\Equipment;
use App\Models\Eir;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EirController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_eirs')->only(['index']);
        $this->middleware('permission:create_eirs')->only(['create', 'store']);
        $this->middleware('permission:update_eirs')->only(['edit', 'update']);
        $this->middleware('permission:delete_eirs')->only(['delete', 'bulk_delete']);

    }// end of __construct

    public function index()
    {
        return view('admin.eirs.index');

    }//end of index 

    public function data()
    {
        if (request()->old) {

            $eirs = Eir::query()
                ->whereDateBetween(request()->start_data, request()->end_data)
                ->whereYear('created_at', '!=', now()->year);
            
        } else {            

            $eirs = Eir::query()
                ->whereDateBetween(request()->start_data, request()->end_data)
                ->whereYear('created_at', now()->year);

        }//end of if

        return DataTables::of($eirs)
            ->addColumn('record_select', 'admin.eirs.data_table.record_select')
            ->editColumn('date', function (Eir $eir) {
                return $eir->date ? date('d-m-Y', strtotime($eir->date)) : '';
            })
            ->addColumn('attachments', function (Eir $eir) {
                return view('admin.eirs.data_table._attachments', compact('eir'));
            })
            ->editColumn('expected_process_date', function (Eir $eir) {
                return $eir->expected_process_date ? date('d-m-Y', strtotime($eir->expected_process_date)) : '';
            })
            ->editColumn('idle', function (Eir $eir) {
                return view('admin.eirs.data_table._idle', compact('eir'));
            })
            ->editColumn('expected_po_released_date', function (Eir $eir) {
                return $eir->expected_po_released_date ? date('d-m-Y', strtotime($eir->expected_po_released_date)) : '';
            })
            ->editColumn('expected_payment_transfer_date', function (Eir $eir) {
                return $eir->expected_payment_transfer_date ? date('d-m-Y', strtotime($eir->expected_payment_transfer_date)) : '';
            })
            ->editColumn('expected_shipment_pickup_date', function (Eir $eir) {
                return $eir->expected_shipment_pickup_date ? date('d-m-Y', strtotime($eir->expected_shipment_pickup_date)) : '';
            })
            ->editColumn('expected_arrival_to_site_date', function (Eir $eir) {
                return $eir->expected_arrival_to_site_date ? date('d-m-Y', strtotime($eir->expected_arrival_to_site_date)) : '';
            })
            ->editColumn('actual_process_date', function (Eir $eir) {
                return $eir->actual_process_date ? date('d-m-Y', strtotime($eir->actual_process_date)) : '';
            })
            ->editColumn('actual_po_released_date', function (Eir $eir) {
                return $eir->actual_po_released_date ? date('d-m-Y', strtotime($eir->actual_po_released_date)) : '';
            })
            ->editColumn('actual_payment_transfer_date', function (Eir $eir) {
                return $eir->actual_payment_transfer_date ? date('d-m-Y', strtotime($eir->actual_payment_transfer_date)) : '';
            })
            ->editColumn('actual_shipment_pickup_date', function (Eir $eir) {
                return $eir->actual_shipment_pickup_date ? date('d-m-Y', strtotime($eir->actual_shipment_pickup_date)) : '';
            })
            ->editColumn('actual_arrival_to_site_date', function (Eir $eir) {
                return $eir->actual_arrival_to_site_date ? date('d-m-Y', strtotime($eir->actual_arrival_to_site_date)) : '';
            })
            ->addColumn('admin', function (Eir $eir) {
                return $eir->admin->name;
            })
            ->addColumn('equipment', function (Eir $eir) {
                return $eir->equipment ?
                    $eir->equipment->make . ' ' . $eir->equipment->name . ' ' . $eir->equipment->plate_no 
                 : '';
            })
            ->addColumn('actions', 'admin.eirs.data_table.actions')
            ->rawColumns(['record_select', 'actions'])
            ->toJson();

    }// end of data

    public function create()
    {
        $equipments = Equipment::all();
        $countrys   = Country::all();
        $units      = RequestPart::pluck('unit')->unique();

        return view('admin.eirs.create', compact('equipments', 'countrys', 'units'));

    }//end of create

    public function store(EirRequest $request)
    {

        $validated            = $request->safe()->except(['attachments', 'idle','requested_part_eir_no']);
        $validated['user_id'] = auth()->id();
        $validated['idle']    = $request->has('idle') ?? '0';
        
        $eir = Eir::create($validated);        

        if ($request->attachments) {
            
            foreach ($request->file('attachments') as $file) {

                Attachment::create([
                    'path'     => $file->store('eir_attachments_file', 'public'),
                    'name'     => $file->getClientOriginalName(),
                    'type'     => $file->extension(),
                    'eir_id'   => $eir->id,
                ]);

            }//end of rach

        }//end of check file attachments

        if ($request->requested_part_eir_no) {
            
            foreach ($request->requested_part as $key=>$data) {
                
                RequestPart::create([
                    'eir_id'            => $eir->id,
                    'eir_no'            => $request->requested_part_eir_no,
                    'requested_part_no' => $request['requested_part_no'][$key],
                    'requested_part'    => $request['requested_part'][$key],
                    'quantity'          => $request['quantity'][$key],
                    'unit'              => $request['unit'][$key],
                    'parts_for'         => $request['parts_for'][$key],
                ]);

            }//end of each

        }//end of requested part

        $emails = EmailSystem::where('type', 'eir')->pluck('email');
        \App\Jobs\Admin\EIRJob::dispatch($emails, $eir)->delay(now()->addMinutes(10));

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('admin.eirs.index');

    }//end of store

    public function edit(Eir $eir)
    {
        $equipments = Equipment::all();
        $countrys   = Country::all();
        $citys      = City::where('country_id', $eir->equipment->country_id)->get();
        $units      = RequestPart::pluck('unit')->unique();

        return view('admin.eirs.edit', compact('eir','equipments', 'countrys', 'citys', 'units'));

    }//end of edit


    public function update(eirRequest $request, Eir $eir)
    {
        $validated            = $request->safe()->except(['attachments', 'idle','requested_part_eir_no']);
        $validated['user_id'] = auth()->id();
        $validated['idle']    = $request->has('idle') ?? '0';

        if ($request->attachments) {
            
            foreach ($request->file('attachments') as $file) {

                Attachment::create([
                    'path'     => $file->store('eir_attachments_file', 'public'),
                    'name'     => $file->getClientOriginalName(),
                    'type'     => $file->extension(),
                    'eir_id'   => $eir->id,
                ]);

            }//end of each

        }//end of check file attachments


        if ($request->requested_part_eir_no) {

            $eir->RequestPart()->forceDelete();
            
            foreach ($request->requested_part as $key=>$data) {
                
                RequestPart::create([
                    'eir_id'            => $eir->id,
                    'eir_no'            => $request->requested_part_eir_no,
                    'requested_part_no' => $request['requested_part_no'][$key],
                    'requested_part'    => $request['requested_part'][$key],
                    'quantity'          => $request['quantity'][$key],
                    'unit'              => $request['unit'][$key],
                    'parts_for'         => $request['parts_for'][$key],
                ]);

            }//end of each

        }//end of requested part
        
        $eir->update($validated);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.eirs.index');

    }//end of store

   
    public function destroy(Eir $eir)
    {
        $this->delete($eir);
        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of destroy

    public function bulkDelete()
    {
        foreach (json_decode(request()->record_ids) as $recordId) {

            $eir = Eir::FindOrFail($recordId);
            $this->delete($eir);

        }//end of for each

        session()->flash('success', __('site.deleted_successfully'));
        return response(__('site.deleted_successfully'));

    }// end of bulkDelete

    private function delete(Eir $eir)
    {
        Storage::disk('local')->delete('public/'. $eir->attachments);

        $eir->RequestParts()->delete();
        $eir->delete();

    }// end of delete

    public function unit()
    {
        $units = RequestPart::pluck('unit')->unique();

        return response()->json($units);

    }//end of unit

}//end of controller