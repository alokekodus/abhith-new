<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    use HasFactory;

    protected $table = "sets";
    protected $guarded = [];
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
    public function assignClass()
    {
        return $this->belongsTo(assignClass::class);
    }
    public function assignTeacher(){
        return $this->belongsTo(User::class, 'teacher_id', 'id');
    }
    public function assignSubject()
    {
        return $this->belongsTo(assignSubject::class);
    }
    public function question(){
        return $this->hasMany(Question::class);
    }
}
