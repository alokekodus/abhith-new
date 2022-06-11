<?php

use App\Models\AssignSubject;
use App\Models\Lesson;
use App\Models\SubjectLessonVisitor;

function attachmenetPath($path){
return base_path().$path;
}
//store visitor details
function  visitorRecord($subject_lesson_id,$type){
    if(auth()->check()){
        if($type==1){
            $subject=AssignSubject::find($subject_lesson_id);
            $subject_lesson_id=$subject->id;
            $teacher_id=$subject->assignTeacher->id;
        }else{
            $lesson=Lesson::find($subject_lesson_id);
            $subject_lesson_id=$lesson->id;
            $teacher_id=$lesson->assignSubject->assignTeacher->id;
        }
      
        $is_available=SubjectLessonVisitor::where([
        'lesson_subject_id'=>$subject_lesson_id,
        'teacher_id'=>$teacher_id,
        'visitor_id'=>auth()->user()->id,
        'type'=>$type])->first();

        if($is_available!=null){
            $is_available->update(['total_visit'=>$is_available->total_visit+1]);
        }else{
            $data=[
                'lesson_subject_id'=>$subject_lesson_id,
                'teacher_id'=>$teacher_id,
                'visitor_id'=>auth()->user()->id,
                'total_visit'=>1,
                'type'=>$type,
               ];
              
               SubjectLessonVisitor::create($data);
        }
      
    }else{
        return false;
    }

}