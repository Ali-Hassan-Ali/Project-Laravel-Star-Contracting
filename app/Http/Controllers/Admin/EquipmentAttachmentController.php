<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentAttachmentController extends Controller
{

    public function index(Equipment $equipment)
    {
        return view('admin.equipments.attachments.index', compact('equipment'));

    }//end of index


    public function create(Equipment $equipment)
    {
        return view('admin.equipments.attachments.create', compact('equipment'));

    }//end of create

    
    public function store(Request $request, Equipment $equipment)
    {

        if ($request->attachments) {

            foreach ($request->file('attachments') as $file) {

                Attachment::create([
                    'path'         => $file->store('equipment_attachments_file'),
                    'name'         => $file->getClientOriginalName(),
                    'equipment_id' => $equipment->id,
                ]);

            }//end of rach

        }//end of check file attachments

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('admin.equipments.attachment.index', ['equipment' => $equipment->id]);

    }//end of store

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {

        return view('admin.equipment.attachments.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment, Attachment $attachment)
    {
        $attachment->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('admin.equipments.attachment.index', ['equipment' => $equipment->id]);

    }//end of destroy

}//end ofcontroller
