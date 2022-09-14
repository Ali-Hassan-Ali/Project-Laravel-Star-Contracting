<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    public function country()
    {
        return $this->belongsTo(Country::class);
        
    }//end of  belongsTo

    public function city()
    {
        return $this->belongsTo(City::class);
        
    }//end of  belongsTo

    // Attribute-------------------
    public function getTypeAttribute($value)
    {
        return ucfirst($value);

    }//end of get last name

    public function scopeWhereDateBetween($query, $startDate, $endDate)
    {
        $startDate = now()->createFromFormat('Y-m-d', $startDate);
        $endDate   = now()->createFromFormat('Y-m-d', $endDate);

        return $query->whereDate('created_at', '>=',$startDate)
                     ->whereDate('created_at','<=',$endDate);

    }//end of fun
    
}//end of model
