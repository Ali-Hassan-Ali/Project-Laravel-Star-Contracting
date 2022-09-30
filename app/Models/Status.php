<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = ['equipment_name'];

    public function getEquipmentNameAttribute()
    {
        if ($this->equipment)
        {
            return $this->equipment->name .' '. $this->equipment->make .' '. $this->equipment->plate_no;
        }

    }//end of fun

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
        
    }//end of  belongsTo

    public function getAsOfAttribute($value)
    {
        return date('Y-m-d\TH:i', strtotime($value));

    }//end oi fn

    public function getBreakDownDateAttribute($value)
    {
        return date('Y-m-d\TH:i', strtotime($value));
        
    }//end of fun

    public function getWorkingStatusAttribute($value)
    {
        return ucwords($value);

    }//end of get last name

    public function scopeWhereDateBetween($query, $startDate, $endDate)
    {
        if ($startDate && $endDate) {

            return $query->whereDate('created_at', '>=',$startDate)
                         ->whereDate('created_at','<=',$endDate);
            
        } else {

            return $query;

        } //end of if

    }//end of fun
    
}//end of model
