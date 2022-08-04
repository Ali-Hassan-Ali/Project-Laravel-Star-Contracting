<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = ['file_path'];

    //relation----------------------------------
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id');
        
    }//end of  belongsTo

    //attributes----------------------------------
    public function getFilePathAttribute()
    {
        return asset('storage/' . $this->path);

    }//end of get image path

    
}//end of modle