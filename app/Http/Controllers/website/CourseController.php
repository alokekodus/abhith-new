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
        $class_id = null;
        $board_details = Board::where('is_activate', 1)->get();
        $subject_details = AssignSubject::with('assignClass', 'boards')->where('is_activate', 1)->get();

        if ($request->has('assignedBoard') && $request->has('class_id')) {
            $class_id = $request->has('class_id');
            $subject_details =  AssignSubject::with('assignClass', 'boards')->where('assign_class_id', $request->class_id)->where('board_id', $request->assignedBoard)->where('is_activate', 1)->get();
        }


        return view('website.course.course')->with(['boards' => $board_details, 'subjects' => $subject_details, 'class_id' => $class_id]);
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
        try {
            $subject = AssignSubject::find(Crypt::decrypt($subject_id));
            $subject_id=$subject->id;

            $subjects = AssignSubject::with('review')->select('id', 'subject_name', 'image', 'subject_amount', 'subject_amount')->where('board_id', $subject->board_id)->where('assign_class_id', $subject->assign_class_id)->where('is_activate', 1)->where('published', 1)->get();
            $total_subject=$subjects->count();
            $board = Board::find($subject->board_id);
            $Assignclass = AssignClass::find($subject->assign_class_id);
            $total_amount = 0;
            foreach ($subjects as $key => $subject) {
                if (subjectAlreadyPurchase($subject->id) == 1) {
                    $total_amount = $total_amount + 0;
                } else {
                    $total_amount = $total_amount + $subject->subject_amount;
                }
            }

            $all_subject = [];
            foreach ($subjects as $key => $subject) {
                if ($subject->review->count() > 0) {
                    $total_rating = $subject->review()->count() * 5;
                    $rating_average = $subject->review()->sum('rating') / $total_rating * 5;
                } else {
                    $rating_average = "No reviews yet";
                }

                $data = [
                    'id' => $subject->id,
                    'subject_name' => $subject->subject_name,
                    'image' => $subject->image,
                    'subject_amount' => $subject->subject_amount,
                    'rating' => $rating_average,
                    'already_purchase' => subjectAlreadyPurchase($subject->id),

                ];
                $all_subject[] = $data;
            }




            $data = [
                'subjects' => $all_subject,
                'total_amount' => $total_amount,
                'board' => $board,
                'assignclass' => $Assignclass,
                'subjectamount'=>$subject->subject_amount,
            ];

            return view('website.course.enroll', compact('data','subject_id','total_subject'));
        } catch (\Throwable $th) {
            //throw $th;
        }











        // return view('website.course.filter-course', compact('board', 'class', 'subjects', 'total_amount'));
    }
    public function  subjectDetails($subject_id)
    {
        $subject_id = Crypt::decrypt($subject_id);

        $subject = AssignSubject::with(['lesson' => function ($query) {
            $query->with('lessonAttachment');
        }, 'subjectAttachment', 'assignClass', 'boards'])->where('id', $subject_id)->first();
        $lessons = $subject->lesson;

        return view('website.user.lesson-details', compact('lessons', 'subject'));
    }
}
