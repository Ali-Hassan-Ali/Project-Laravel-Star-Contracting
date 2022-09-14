<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Eir;
use Illuminate\Http\Request;

class EirAttachmentController extends Controller
{
    
    public function index(Eir $eir)
    {
        return view('admin.eirs.attachments.index', compact('eir'));

    }//end of index


    public function create(Eir $eir)
    {
        return view('admin.eirs.attachments.create', compact('eir'));

    }//end of create

    
    public function store(Request $request, Eir $eir)
    {

        if ($request->attachments) {

            foreach ($request->file('attachments') as $file) {

                Attachment::create([
                    'path'         => $file->store('eir_attachments_file', 'public'),
                    'name'         => $file->getClientOriginalName(),
                    'type'         => $file->extension(),
                    'eir_id'       => $eir->id,
                ]);

            }//end of rach

        }//end of check file attachments

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('admin.eirs.attachment.index', ['eir' => $eir->id]);

    }//end of store

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
    public function edit(Attachment $attachment, Eir $eir)
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
    public function update(Request $request, Attachment $attachment, Eir $eir)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Eir $eir, Attachment $attachment)
    {
        $attachment->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('admin.eirs.attachment.index', ['eir' => $eir->id]);

    }//end of destroy
}
