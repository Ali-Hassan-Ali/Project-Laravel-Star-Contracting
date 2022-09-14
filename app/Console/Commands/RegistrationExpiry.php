<?php

namespace App\Console\Commands;

use App\Models\EmailSystem;
use App\Models\Equipment;
use Illuminate\Console\Command;

class RegistrationExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registration:expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'registration expiry';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $equipments = Equipment::where('registration_expiry', '>=',now()->subDays(30))->get();
        $emails = EmailSystem::where('type', 'expiry')->pluck('email');
        \App\Jobs\Admin\RegistrationExpiryJob::dispatch($emails, $equipments)->delay(now()->addMinutes(10));

    }//end of handle

}//end of class
