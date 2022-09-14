<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    public function city()
    {
        return $this->hasMany(City::class);
        
    }//end of  belongsTo

    public function getNameAttribute($value)
    {
        return ucwords($value);

    }//end of get last name
    
}//end of model