<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;

class AjaxController extends Controller
{
    public function ajaxCountry(Country $country)
    {
        return $country->city;   

    }//end of country to city

    public function ajaxCity(City $city)
    { 
        return $city->equipments;

    }//end of city to equipments

}//end of controller
