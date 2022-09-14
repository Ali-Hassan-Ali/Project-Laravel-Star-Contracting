<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index($name)
    {
        return view('admin.tables.' . $name . '.index');

    }//end of index fun

}//end of class