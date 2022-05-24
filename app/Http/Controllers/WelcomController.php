<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categorey;
use App\Models\Owner;

class WelcomController extends Controller
{
    
    public function index()
    {
        return view('dashboard_admin.welcome');

    }//end of index

}//end of controller