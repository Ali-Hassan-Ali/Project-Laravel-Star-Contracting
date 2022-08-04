<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    //scopes -------------------------------------
    public function scopeWhenSearch($query , $search) 
    {
        return $query->when($search, function ($q) use ($search) {

            return $q->where('name' , 'like', "%$search%");
        });
        
    }//end of scopeWhenSearch`

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
        
    }//end of  belongsTo

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
        
    }//end of  belongsTo

    public function getNameAttribute($value)
    {
        return ucwords($value);

    }//end of get last name

}//end of model
