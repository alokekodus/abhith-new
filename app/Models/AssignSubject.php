<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
    use HasFactory;

    protected $table = "assign_subjects";

    protected $guarded = [];

    public function assignClass(){
        return $this->belongsTo(AssignClass::class, 'assign_class_id', 'id');
    }

    public function boards(){
        return $this->belongsTo(Board::class, 'board_id', 'id');
    }
    public function lesson(){
        return $this->hasMany(Lesson::class)->where('parent_id',null);
    }
}
