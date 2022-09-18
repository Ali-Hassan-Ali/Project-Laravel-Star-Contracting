<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Attachment;
use App\Models\Equipment;
use Illuminate\Support\Facades\Storage;

Route::prefix(\Mcamara\LaravelLocalization\Facades\LaravelLocalization::setLocale())->group(function () {
    
    Auth::routes();

    Route::get('/testing/{id}', function ($id) {
        
        $pdf = Attachment::find($id);

        // dd($pdf->path, Storage::disk('public')->getDriver()->getAdapter(), Storage::disk('public')->path($pdf->path));

        return $book_file = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($pdf->path);

        return response()->file($book_file);

    })->name('view.pdf');

    Route::get('/test', function () {

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

        dd($collection->all(), $collection->first());


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
