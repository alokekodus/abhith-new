<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use SoftDeletes;
    protected $table = "lessons";
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'parent_lesson_id',
        'board_id',
        'assign_class_id',
        'assign_subject_id',
        'image_url',
        'video_url',
        'content'

    ];
    public static function getRules($for, $type = null, $id = null)
    {
        $lesson_rules = [
            'name' => 'bailrequired|unique:lessons|max:255',
            'slug' => 'bailrequired|max:255',
            'content' => 'bailrequired',

        ];

        switch ($for) {
            case 'create_lesson_info':
                $lesson_rules['image_url']     = 'bail|required';
                $lesson_rules['board_id'] = 'bail|required';
                $lesson_rules['assign_class_id'] = 'bail|required';
                $lesson_rules['assign_subject_id'] = 'bail|required';

                $rules = $lesson_rules;
                break;
            case 'update_lesson_info':
                $lesson_rules['image_url']     = 'bail|required';
                $lesson_rules['board_id'] = 'bail|required';
                $lesson_rules['assign_class_id'] = 'bail|required';
                $lesson_rules['assign_subject_id'] = 'bail|required';

                $rules = $lesson_rules;
                break;
            case 'create_topic_info':
                $lesson_rules['parent_id']     = 'bail|required';
                $rules = $lesson_rules;
                break;
            case 'update_topic_info':
                $lesson_rules['parent_id']     = 'bail|required';
                $rules = $lesson_rules;
                break;
            case 'create_sub_topic_info':
                $lesson_rules['parent_lesson_id']     = 'bail|required';
                $rules = $lesson_rules;
                break;
            case 'update_sub_topic_info':
                $lesson_rules['parent_lesson_id']     = 'bail|required';
                $rules = $lesson_rules;
                break;
            default:

                break;
        }

        return $rules;
    }
    public function boards()
    {
        return $this->belongsTo(AssignSubject::class);
    }
    public function topics()
    {
        return $this->hasMany(Lesson::class, 'parent_id')->where('parent_lesson_id', null);
    }
    public function subTopics()
    {
        return $this->hasMany(Lesson::class, 'parent_lesson_id');
    }
}
