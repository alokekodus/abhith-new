<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    protected $table = "sets";
    protected $guarded = [];

    public function subject(){
        return $this->belongsTo('App\Models\Subject');
    }
}
