<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
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

    public function scopeWhereDateBetween($query, $startDate, $endDate)
    {
        $startDate = now()->createFromFormat('Y-m-d', $startDate);
        $endDate   = now()->createFromFormat('Y-m-d', $endDate);

        return $query->whereDate('created_at', '>=',$startDate)
                     ->whereDate('created_at','<=',$endDate);

    }//end of fun
    
}//end of model