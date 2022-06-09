<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LessonAttachment extends Model
{
    use SoftDeletes;
    protected $table = "lesson_attachments";
    protected $fillable = [
        'subject_lesson_id',
        'img_url',
        'video_thumbnail_image',
        'origin_video_url',
        'video_resize_480',
        'video_resize_720',
        'video_resize_1080',
        'type'

    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function assignSubject()
    {
        return $this->belongsTo(assignSubject::class);
    }
}
