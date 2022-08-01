<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
        
    }//end of  belongsTo

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
        
    }//end of  belongsTo

    public function spec()
    {
        return $this->belongsTo(Spec::class);
        
    }//end of  belongsTo

}//end of model