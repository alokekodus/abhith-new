<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonAttachment extends Model
{
    use SoftDeletes;
    protected $table="lesson_attachments";
    protected $fillable=[
    'lesson_id',
    'img_url',
    'origin_video_url',
    'video_resize_480',
    'video_resize_720',
    'video_resize_1080',
    'created_at',
    'updated_at',
    'deleted_at',

];

    
}
