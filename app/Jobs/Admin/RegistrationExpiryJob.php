<?php

namespace App\Jobs\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class RegistrationExpiryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $emails;
    public $equipments;

    public function __construct($emails, $equipments)
    {
        $this->emails = $emails;
        $this->equipments = $equipments;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data   = $this->equipments;
        $emails = $this->emails;

        foreach ($emails as $index=>$email) {

            Mail::send('admin.reports.emails.registration_expiry', ['data' => $data], function($message) use ($data,$email) {
                $message->to($email)->subject('report star-contracting');
            });

        }//end of each

    }//end of handle

}//end of class