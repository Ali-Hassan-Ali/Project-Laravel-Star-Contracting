<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailSystem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'user_id');

    }//end of hasMany city

    public function country()
    {
        return $this->belongsTo(Country::class);

    }//end of hasMany city

    public function city()
    {
        return $this->belongsTo(City::class);

    }//end of hasMany city

}//end of model
