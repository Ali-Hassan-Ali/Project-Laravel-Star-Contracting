<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['total_cost'];

    //scopes -------------------------------------
    public function scopeWhenSearch($query , $search) 
    {
        return $query->when($search, function ($q) use ($search) {

            return $q->where('name' , 'like', "%$search%");
        });
        
    }//end of scopeWhenSearch`

    public function getTotalCostAttribute()
    {
        $totles = $this->equipments()->select('id')->get();

        $items = 0;
        foreach($totles as $totle) {
            $items += $totle['total'];
        }
        return $items;
        
    }//end of fun

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
        
    }//end of  belongsTo

    public function equipments()
    {
        return $this->hasMany(Equipment::class);
        
    }//end of  belongsTo

    public function getNameAttribute($value)
    {
        return ucwords($value);

    }//end of get last name

}//end of model
