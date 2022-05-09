<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;
    protected $table="lessons";
    protected $fillable=[
    'name',
    'slug',
    'parent_id',
    'board_id',
    'assign_class_id',
    'assign_subject_id',
    'image_url',
    'video_url',
    'content'
];
public function boards(){
    return $this->belongsTo(AssignSubject::class);
}
public function topics()
{
  return $this->hasMany(Lesson::class, 'parent_id');
}
}
