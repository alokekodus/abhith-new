<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectLessonVisitor extends Model
{
    use SoftDeletes;
    protected $table = "subject_lesson_visitors";
    protected $fillable = [
        'lesson_subject_id',
        'teacher_id',
        'visitor_id',
        'total_visit',
        'type'
    ];
    public function visitor(){
        return $this->belongsTo(User::class, 'visitor_id', 'id');
    }
    
}
