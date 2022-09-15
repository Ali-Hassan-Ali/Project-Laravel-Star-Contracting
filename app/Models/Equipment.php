<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $appends = ['total', 'idle', 'spec_name', 'chart_total'];
    
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    public function getIdleAttribute()
    {
        return $this->eir()->count() ?? '';
           
    }//end of fun

    public function getChartTotalAttribute()
    {
        return 0;
        $total = $this->rental_cost_basis + $this->driver_salary + $this->spares->sum('cost') + $this->spares->sum('freight_charges') + !empty($this->fuel->total_cost_of_fuel) ?? '';

        return $total;


    }//end of fun

    public function getSpecNameAttribute()
    {
        return $this->spec->name ?? '';

    }//end of fun

    public function getTotalAttribute()
    {
        return $this->sparesWithNotUse()->sum('cost') + $this->sparesWithNotUse()->sum('freight_charges');
        
    }//end of fun

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

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
        
    }//end of  belongsTo

    public function spares()
    {
        return $this->belongsToMany(Spare::class, 'equipment_has_manies');

    }//end of fun

    public function sparesUsed()
    {
        return $this->belongsToMany(Spare::class, 'equipment_has_manies')->where('used', '1');

    }//end of fun

    public function sparesWithNotUse()
    {
        return $this->belongsToMany(Spare::class, 'equipment_has_manies')->where('used', '0');

    }//end of fun

    public function status()
    {
        return $this->hasMany(Status::class);

    }//end of fun

    public function statusBreakdown()
    {
        return $this->hasMany(Status::class)->where('working_status', 'Breakdown');

    }//end of fun

    public function statusNull()
    {
        return $this->hasMany(Status::class)->where('working_status', 'breakdown');

    }//end of fun

    public function statusone()
    {
        return $this->hasOne(Status::class)->where('working_status', 'breakdown');

    }//end of fun

    public function eir()
    {
        return $this->hasOne(Eir::class)->where('idle', 1);

    }//end of fun

    public function eirs()
    {
        return $this->hasMany(Eir::class)->orderBy('status');

    }//end of fun

    public function fuel()
    {
        return $this->hasOne(Fuel::class);

    }//end of fun

    public function fuels()
    {
        return $this->hasMany(Fuel::class);

    }//end of fun

    public function getProjectAllocatedToAttribute($value)
    {
        return ucwords($value);

    }//end of get last name

    public function scopeWhereDateBetween($query, $startDate, $endDate)
    {
        $startDate = now()->createFromFormat('Y-m-d', $startDate);
        $endDate   = now()->createFromFormat('Y-m-d', $endDate);

        return $query->whereDate('created_at', '>=',$startDate)
                     ->whereDate('created_at','<=',$endDate);

    }//end of fun

    public function scopeWhereBetweenDataRegistrationExpiry($query)
    {

        return $query->whereDate('registration_expiry', '<=', now()->subMonth(1))
                     ->whereDate('registration_expiry', '>=', now()->addMonth(1));

    }//end of fun

}//end of model