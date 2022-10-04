<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceAttachmentController extends Controller
{
    
    public function index(Insurance $insurance)
    {
        return view('admin.insurances.attachments.index', compact('insurance'));

    }//end of index

    
    public function create(Insurance $insurance)
    {
        return view('admin.insurances.attachments.create', compact('insurance'));

    }//end of create

   
    public function store(Request $request, Insurance $insurance)
    {
        if ($request->attachments) {

            foreach ($request->file('attachments') as $file) {

                Attachment::create([
                    'path'         => $file->store('insurances_attachments_file', 'public'),
                    'name'         => $file->getClientOriginalName(),
                    'type'         => $file->extension(),
                    'insurance_id' => $insurance->id,
                ]);

            }//end of rach

        }//end of check file attachments

        session()->flash('success', __('site.added_successfully'));

        return redirect()->route('admin.insurances.attachment.index', ['insurance' => $insurance->id]);

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
    public function destroy(Attachment $attachment, Insurance $insurance)
    {
        dd($insurance);
        
        $insurance->delete();

        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('admin.insurances.attachment.index', ['insurance' => $insurance->id]);

    }//end of destroy

}//end ofcontroller