<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Common\Activation;
use App\Models\AssignClass;
use App\Models\AssignSubject;
use App\Models\Board;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Cart;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\MultipleChoice;
use App\Models\Set;
use App\Models\Question;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Expr\Assign;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $class_id=null;
        $board_details = Board::where('is_activate', 1)->get();
        $subject_details = AssignSubject::with('assignClass', 'boards')->where('is_activate', 1)->get();
        
        if ($request->has('assignedBoard') && $request->has('class_id')) {
            $class_id=$request->has('class_id');
            $subject_details =  AssignSubject::with('assignClass', 'boards')->where('assign_class_id', $request->class_id)->where('board_id', $request->assignedBoard)->where('is_activate', 1)->get();
        }


        return view('website.course.course')->with(['boards' => $board_details, 'subjects' => $subject_details,'class_id'=>$class_id]);
    }



    public function coursePackageFilter(Request $request)
    {
        try {

            $board_id = $request->assignedBoard;
            $assign_class_id = $request->class_id;
            $data = [
                'board_id' => $board_id,
                'class_id' => $assign_class_id,
            ];
            $board = Board::find($board_id);
            $assign_subject = AssignSubject::find($assign_class_id);
            if (($board_id == null) || ($assign_class_id == null)) {

                $datas['code'] = 500;
                $datas['message'] = 'Whoop! Something went wrong.';
                return response()->back()->json(['datas' => $datas]);
            } else {

                $all_subjects = AssignSubject::where(['board_id' => $board_id, 'assign_class_id' => $assign_class_id, 'is_activate' => 1])->get();


                if ($all_subjects != null) {
                    $total_amount = $all_subjects->sum('subject_amount');
                    $datas =
                        [
                            'all_subjects' => $all_subjects,
                            'total_amount' => $total_amount,
                        ];
                    $data =
                        [
                            'code' => 200,
                            'message' => 'All filtering data are Display',
                            'datas' => $datas,
                        ];
                    return response()->json(['data' => $data]);
                } else {
                    $data =
                        [
                            'code' => 500,
                            'message' => 'Sorry! subject is not available for this time.',

                        ];
                    return response()->back()->json(['datas' => $data]);
                }

                $data =
                    [
                        'code' => 500,
                        'message' => 'Sorry! subject is not available for this time.',

                    ];
                return response()->back()->json(['datas' => $data]);
            }
        } catch (\Throwable $th) {
            return response()->back()->json(['message' => 'Whoops! Something went wrong. Failed to Find Packages.', 'status' => 2]);
        }
    }
    public function enrollPackage($subject_id)
    {
        $subject = AssignSubject::find(Crypt::decrypt($subject_id));
        $subject_id=$subject->id;
        $board = Board::find($subject->board_id);
        $class = AssignClass::with(['boards','subjects'=>function($q){
            $q->where('is_activate',1);
        }])->where('id',$subject->assign_class_id)->first();
        $subjects = $class->subjects;
        $total_subject=$subjects->count();
      
        $custom_package_active=true;
        if($custom_package_active){
            $total_amount = $subject->subject_amount;
        }else{
            $total_amount = $subjects->sum('subject_amount');
        }
        return view('website.course.enroll', compact('board', 'class', 'subjects','total_subject', 'total_amount','custom_package_active','subject_id','subject'));

        // return view('website.course.filter-course', compact('board', 'class', 'subjects', 'total_amount'));
    }
    public function  subjectDetails($subject_id)
    {
        $subject_id = Crypt::decrypt($subject_id);

        $subject = AssignSubject::with(['lesson' => function ($query) {
            $query->with('lessonAttachment');
        }, 'subjectAttachment','assignClass','boards'])->where('id', $subject_id)->first();
        $lessons = $subject->lesson;

        return view('website.user.lesson-details', compact('lessons', 'subject'));
    }
}
