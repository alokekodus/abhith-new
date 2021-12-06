<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeTable extends Model
{
    use HasFactory;

    protected $table = 'time_tables';
    protected $guarded = [];


    public function chapter(){
        return $this->belongsTo('App\Models\Chapter');
    }

    public function course(){
        return $this->belongsTo('App\Models\Course');
    }
}
