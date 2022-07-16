<?php

use App\Models\AssignSubject;
use App\Models\Lesson;
use App\Models\LessonAttachment;
use App\Models\SubjectLessonVisitor;
use App\Models\User;
use App\Models\UserDetails;

function attachmenetPath($path)
{
    return base_path() . $path;
}
//store visitor details
function  visitorRecord($subject_lesson_id, $type)
{
    if (auth()->check()) {
        if ($type == 1) {
            $subject = AssignSubject::find($subject_lesson_id);
            $subject_lesson_id = $subject->id;
            $teacher_id = $subject->assignTeacher->id;
        } else {
            $lesson = Lesson::find($subject_lesson_id);
            $subject_lesson_id = $lesson->id;
            $teacher_id = $lesson->assignSubject->assignTeacher->id;
        }

        $is_available = SubjectLessonVisitor::where([
            'lesson_subject_id' => $subject_lesson_id,
            'teacher_id' => $teacher_id,
            'visitor_id' => auth()->user()->id,
            'type' => $type
        ])->first();

        if ($is_available != null) {
            $is_available->update(['total_visit' => $is_available->total_visit + 1]);
        } else {
            $data = [
                'lesson_subject_id' => $subject_lesson_id,
                'teacher_id' => $teacher_id,
                'visitor_id' => auth()->user()->id,
                'total_visit' => 1,
                'type' => $type,
            ];

            SubjectLessonVisitor::create($data);
        }
    } else {
        return false;
    }
}
function dateFormat($dateTime, $format = "d-m-Y")
{
    if ($dateTime == "0000-00-00" || $dateTime == "0000-00-00 00:00:00") {
        return " ";
    }
    $date = strtotime($dateTime);
    if (date('d-m-Y', $date) != '01-01-1970') {
        return date($format, $date);
    } else {
        return " ";
    }
}
function subjectTotalResource($subject_id, $type)
{
    if ($type == "content") {
        return Lesson::where('assign_subject_id', $subject_id)->get()->count();
    } elseif ($type == "image") {
        return LessonAttachment::whereHas('lesson')->where('img_url', '!=', null)->get()->count();
    } else {
        return LessonAttachment::whereHas('lesson')->where('origin_video_url', '!=', null)->get()->count();
    }
}
function lessonTotalVisite($lesson_id)
{
    $total_visit = SubjectLessonVisitor::where('lesson_subject_id', $lesson_id)->where('visitor_id', auth()->user()->id)->where('type', 2)->first();
    return $total_visit->total_visit;
}
function getPrefix($request)
{
    return  $request->route()->getPrefix();
}
function getAssignSubjects()
{
    return AssignSubject::with('assignClass', 'boards')->where('is_activate', 1)->limit(9)->get();
}
function isSubjectAlreadyInCart($check_item_exists_inside_cart, $all_subjects)
{
    $subject_already_in_cart = $check_item_exists_inside_cart;
    dd($subject_already_in_cart);
}
function isTeacherApply()
{
     $user_details = UserDetails::where('user_id', auth()->user()->id)->where('status', '!=', 0)->count();
    if($user_details==0){
        return false;
    }else{
        return true;
    }
}
function userFirstName()
{
    $words = explode(" ", auth()->user()->name);

    return $words[0];
}
function teacherReferralId(){
    
    $referralId         = 'ABHITHSIKSHA' . date('dmY') . '/' . random_int(10000000, 99999999);
    return $referralId;
}
function getlessonAttachment($lesson_id){
 $lesson=Lesson::with('lessonAttachment')->where('id',$lesson_id)->first();
 if($lesson->type==1){
    $url_name=$lesson->lessonAttachment->img_url;
    $type=1;
    $extension=pathinfo($url_name, PATHINFO_EXTENSION);
    return $data=[
        'url_name'=>$url_name,
        'type'=>$type,
        'extension'=>$extension,
    ];
 }
}
function otpSend($phone, $otp)
    {
        $isError = 0;
        $errorMessage = true;

        //Your message to send, Adding URL encoding.
        $message = urlencode("<#> Use $otp as your verification code. The OTP expires within 10 mins. Do not share it with anyone. -regards Abhith Siksha");


        //Preparing post parameters
        $postData = array(
            'authkey' => '19403ARfxb6xCGLJ619221c6P15',
            'mobiles' => $phone,
            'message' => $message,
            'sender' => 'ABHSKH',
            'DLT_TE_ID' => 1207164006513329391,
            'route' => 4,
            'response' => 'json'
        );

        $url = "http://login.yourbulksms.com/api/sendhttp.php";

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //get response
        $output = curl_exec($ch);
        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);
        if ($isError) {
            return false;
        } else {
            return true;
        }
    }
