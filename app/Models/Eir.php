<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Eir extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['total_break_down_duration', 'equipment_name'];

    public function getEquipmentNameAttribute()
    {
        if ($this->equipment)
        {
            return $this->equipment->name .' '. $this->equipment->make .' '. $this->equipment->plate_no;
        }

    }//end of fun

    public function gettotalBreakDownDurationAttribute()
    {
        $firstDate = strtotime($this->date ?? null);
        $lastDate  = strtotime($this->actual_arrival_to_site_date ?? null);
        $daycount  = date('z', ($lastDate - $firstDate));

        return $daycount ?? 0;

    }//end of fun

    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
        
    }//end of  belongsTo

    public function RequestPart()
    {
        return $this->hasMany(RequestPart::class);
        
    }//end of  belongsTo

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
        
    }//end of  belongsTo

    public function scopeWhenCityId($query, $cityId)
    {
        return $query->when($cityId, function ($q) use ($cityId) {

            return $q->whereHas('equipment', function ($qu) use ($cityId) {

                return $qu->where('city_id', $cityId);

            });

        });

    }// end of scopeWhenCityId

    public function scopeWhenEquipmentId($query, $equipmentId)
    {
        return $query->when($equipmentId, function ($q) use ($equipmentId) {

            return $q->whereHas('equipment', function ($qu) use ($equipmentId) {

                return $qu->where('id', $equipmentId);

            });

        });

    }// end of scopeWhenEquipmentId

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