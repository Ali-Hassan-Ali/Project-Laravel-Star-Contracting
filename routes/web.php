<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Attachment;
use App\Models\Equipment;
use App\Models\Spare;
use Illuminate\Support\Facades\Storage;

Route::prefix(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale())->group(function () {
    
    Auth::routes();

    Route::get('/dd', function () {

        $eir = \App\Models\Eir::first();

        dd($eir->RequestParts());

        // curl -X 'DELETE' 'https://test-api.kashier.io/orders/:orderId/transactions/:transactionId?operation=refund'
        
        $response = Http::get('http://example.com');


        //Copy and paste this code in your Backend
        function generateKashierOrderHash($order){
            $mid = "MID-123-123"; //your merchant id
            $amount = $order->amount; //eg: 100
            $currency = $order->currency; //eg: "EGP"
            $orderId = $order->merchantOrderId; //eg: 99, your system order ID
            $secret = "yourApiKey";

            $path = "/?payment=".$mid.".".$orderId.".".$amount.".".$currency;
            $hash = hash_hmac('sha256' , $path , $secret ,false);
            return $hash;
        }
        //The Result Hash for /?payment=mid-0-1.99.20.EGP with secret 11111 should result 606a8a1307d64caf4e2e9bb724738f115a8972c27eccb2a8acd9194c357e4bec


    });




























    Route::get('/test', function () {

        return $pdf = Equipment::withCount('status')->having('status_count', '0')->get();

        $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();

        dd($equipments->fuels()->count());

        return $equipments;

        $spares = Spare::with('equipmentsFirst')
                        ->whereRelation('equipmentsFirst.city', 'id', 1)
                        ->get();

        return $spares;

        $collection = collect();

        foreach($spares as $spare) {

            $total = $spare->cost + $spare->freight_charges;

            $collection->push(['premium' => $total]);

        }//end of each

        return $collection->sum('premium');     

        dd($spares);

        $name = 'fgg';
        dd(empty($name));

        $collection = collect();

        $equipments = Equipment::with('fuel','spares')->orderBy('city_id')->get();

        foreach($equipments as $equipment) {
            
            $total = $equipment->rental_cost_basis + 
                     $equipment->driver_salary + 
                     $equipment->spares->sum('cost') + 
                     $equipment->spares->sum('freight_charges') + 
                     !empty($equipment->fuel->total_cost_of_fuel) ?? 0;

            $month = $equipment->created_at->format('F');

            $collection->push([
                'total' => $total,
                'month' => $month,
            ]);

        }//end of each

        $stats = $collection->groupBy('month');

        $grouped = $collection->groupBy('month')->map(function ($row) {
                        return $row->sum('total');
                    });

        dd($collection->all(), $grouped, $grouped->keys(), $grouped->values());


        $equipmens = Equipment::WhereBetweenDataRegistrationExpiry()->get();
        dd($equipmens, now(), now()->addMonth(1));

        // 2022-08-17 > 2022-08-16

    $equipments = DB::table('equipment')->join('fuels', 'equipment.id', '=', 'fuels.equipment_id')
                ->get(['equipment.*', 'fuels.total_cost_of_fuel']);

    return $equipments;

    $equipments = DB::table('equipment')
                    ->select('equipment.*', 'fuels.total_cost_of_fuel', 'equipment.driver_salary')
                    ->leftJoin('fuels', 'equipment.id', '=', 'fuels.equipment_id')
                    ->select(
                        DB::raw('MONTHNAME(equipment.created_at) AS month'),
                        DB::raw('YEAR(equipment.created_at) AS year'),
                        DB::raw('SUM(equipment.rental_cost_basis + equipment.driver_salary + fuels.total_cost_of_fuel) AS totaling'),
                    )->groupBy('month')
                     ->get();

    return $equipments;


    $equipments = Equipment::leftJoin('fuels', 'fuels.equipment_id', '=', 'equipment.id')
                             ->select('*', 'fuels.total_cost_of_fuel', DB::raw('SUM(fuels.total_cost_of_fuel) As revenue'))
                             ->get();

    dd($equipments);

    $equipments = Equipment::leftJoin('fuels', 'equipment.id', '=', 'fuels.equipment_id')
                            ->select('equipment.*', 'fuels.total_cost_of_fuel')
                            ->get();

    return $equipments;

    $mprs = Estimate::join('mprs', 'estimates.id', '=', 'mprs.estimate_id')
                    ->join('materials', 'estimates.material_id', '=', 'materials.id')
                    ->select('estimates.material_id','mprquantity')
                    ->get();
                    return $mprs;

    return $equipments;

        $devlist = DB::table("cities")
                       ->select(
                            '*',
                            'commodities.*',
                            DB::raw('MONTHNAME(created_at) AS month')
                        )->groupBy('month')
                         ->get();

        return $devlist->pluck('month','name');

        dd(\App\Models\Equipment::count());

        // $attachment = \App\Models\Spec::all();
        return $statuss = \App\Models\Status::query()->whereYear('created_at', now()->year)->latest()->get();
        return $attachment;

        return now()->createFromFormat('Y-m-d', '2021-06-01');


        return view('admin.test');
        $equipments = Equipment::whereYear('created_at', request()->year)
            ->select(
                '*',
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(id) as total'),
            )
            ->groupBy('month')
            ->get();
        $attachment = \App\Models\Spec::all();
        return $attachment;
        $filename = 'Ali-Hassan.pdf';
        $path = public_path($filename);
//        return $attachment;
        return 'ffffffffffff';
//        $path = 'http://star-contracting.test/storage/equipment_attachments_file/M0E06161TvfbGHjH5oEM23kvmu8zcawI1sRwVYTk.pdf';
//         header
//        $data["info"] = $user;
//        $pdf = \PDF::loadView('whateveryourviewname', $data);
//        return $pdf->stream('whateveryourviewname.pdf');


        return $equipments = \App\Models\Equipment::withCount('status')->having('status_count', '>', '0')->orderBy('city_id')->get();

        dd($equipments);

        $date = date('Y-d-m', strtotime(now()->subDays(30)));

        $equipments = \App\Models\Equipment::where('registration_expiry', '>=', now()->subDays(30))->get();
        dd($equipments);

        $users = \App\Models\EmailSystem::where('type', 'eir')->pluck('email');
        $eir = \App\Models\Eir::first();
        \App\Jobs\Admin\EIRJob::dispatch($users,$eir);
        dd('doney');

        $data = ['name' => 'name', 'id' => '1'];
        $user = 'ah965961@gmail.com';
        \Illuminate\Support\Facades\Mail::send('admin.reports.emails.eir_email', ['data' => $data], function($message) use ($data,$user) {
            $message->to($user)->subject('report star-contracting');
        });


        dd('done');

        return ucwords('foo bar');

    });


    Route::get('/', 'WelcomeController@index')->name('welcome');

    Route::get('/home', 'HomeController@index')->name('home');

});