<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spare;
use App\Models\Attachment;
use Illuminate\Http\Request;

class SpareAttachmentController extends Controller
{
    public function index(Spare $spare)
    {
        return view('admin.spares.attachments.index', compact('spare'));

    }//end of index


    public function create(Spare $spare)
    {
        return view('admin.spares.attachments.create', compact('spare'));

    }//end of create

    
    public function store(Request $request, Spare $spare)
    {

        if ($request->attachments) {

            foreach ($request->file('attachments') as $file) {

                Attachment::create([
                    'path'         => $file->store('equipment_attachments_file', 'public'),
                    'name'         => $file->getClientOriginalName(),
                    'type'         => $file->extension(),
                    'spare_id'     => $spare->id,
                ]);

            }//end of rach

        }//end of check file attachments

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('admin.spares.attachment.index', ['spare' => $spare->id]);

    }//end of store

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        //
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
    public function destroy(Spare $spare, Attachment $attachment)
    {
        $attachment->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('admin.spares.attachment.index', ['spare' => $spare->id]);

    }//end of destroy
}
