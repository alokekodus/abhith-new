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

class CourseController extends Controller
{
    public function index()
    {
        $board_details = Board::where('is_activate', 1)->get();
        $subject_details = AssignSubject::with('assignClass', 'boards')->where('is_activate', 1)->get();
        return view('website.course.course')->with(['boards' => $board_details, 'subjects' => $subject_details]);
    }
    //
    // protected function index()
    // {
    //     # code...
    //     // $courses = Course::where('is_activate',Activation::Activate)->paginate(10);
    //     $publishCourse = [];
    //     $upComingCourse = [];
    //     $price = [];

    //     $courses = Course::where('is_activate', Activation::Activate)->with('priceList')->orderBy('id', 'DESC')->get();

    //     foreach ($courses as $key => $value) {
    //         # code...
    //         $price = [];
    //         $publishDate = Carbon::parse($value->publish_date)->format('Y-m-d') ;
    //         $Today = Carbon::today()->format('Y-m-d');
    //         if ($publishDate < $Today) {
    //             //  dd('less today', $value->publish_date);
    //             $chapters = Chapter::where([['course_id', $value->id],['is_activate',Activation::Activate]])->get();
    //             foreach ($chapters as $key => $value2) {
    //                 # code...
    //                 $price [] = $value2->price;
    //             }
    //             $final_price = array_sum($price);
    //             $published['final_price']=$final_price;
    //             $published['id']=$value->id;
    //             $published['name']=$value->name;
    //             $published['course_pic']=$value->course_pic;
    //             $published['duration']=$value->durations;
    //             $published['publish_date']=$value->publish_date;
    //             $publishCourse[] = $published;
    //         } elseif ($publishDate == $Today) {
    //             //    dd('Not Today', $value->publish_date);
    //             $publishTime = Carbon::parse($value->publish_date)->format('H:i');
    //             $presentTime = Carbon::now()->format('H:i');
    //             if ($publishTime < $presentTime) {
    //             $chapters = Chapter::where([['course_id', $value->id],['is_activate',Activation::Activate]])->get();
    //                 foreach ($chapters as $key => $value3) {
    //                     # code...
    //                     $price [] = $value3->price;
    //                 }
    //                 $final_price = array_sum($price);
    //                 $published['final_price']=$final_price;
    //                 $published['id']=$value->id;
    //                 $published['name']=$value->name;
    //                 $published['course_pic']=$value->course_pic;
    //                 $published['duration']=$value->durations;
    //                 $published['publish_date']=$value->publish_date;
    //                 $publishCourse[] = $published;
    //             } else {
    //                 $upcoming['id']=$value->id;
    //                 $upcoming['name']=$value->name;
    //                 $upcoming['course_pic']=$value->course_pic;
    //             $upcoming['duration']=$value->durations;
    //                 $upcoming['publish_date']=$value->publish_date;
    //                 $upComingCourse[] = $upcoming;
    //             }
    //         } elseif ($publishDate > $Today) {
    //             // dd('GRATER Today', $value->publish_date);
    //             $upcoming['id']=$value->id;
    //             $upcoming['name']=$value->name;
    //             $upcoming['duration']=$value->durations;
    //             $upcoming['course_pic']=$value->course_pic;
    //             $upcoming['publish_date']=$value->publish_date;
    //             $upComingCourse[] = $upcoming;
    //         }
    //     }
    //     $subjects = Subject::where('is_activate',Activation::Activate)->get();
    //     // dd($publishCourse);
    //     return view('website.course.course',\compact('subjects','publishCourse'));
    // }

    // protected function details(Request $request, $id)
    // {
    //     $course_id = 0;

    //     if($id == null){
    //         $course_id = Crypt::decrypt($request->id);
    //     }else{
    //         $course_id = Crypt::decrypt($id);
    //     }
    //     # code...
    //     $course_id = Crypt::decrypt($request->id);
    //     $course = Course::find($course_id);
    //     $chapters = Chapter::with('cart')->where([['course_id',$course_id],['is_activate',Activation::Activate]])->get();
    //     $multiChoice = Set::inRandomOrder()->where('subject_id', $course->subject->id)->where('is_activate', 1)->limit(1)->get();

    //     $countMultiChoice = 0;
    //     $mcqRandom = [];
    //     foreach( $multiChoice as $item){
    //         $mcqRandom = Question::where('set_id', $item->id)->where('is_activate', 1)->paginate(1);
    //         if($request->ajax()){
    //             $view = view('website.multiple-choice.mcq', compact('mcqRandom'))->render();
    //             return response()->json(['mcq' => $view]);
    //         }
    //         $countMultiChoice = Question::where('set_id', $item->id)->where('is_activate', 1)->count();
    //     }

    //     $cart = []; $order = [];
    //     if(Auth::check()){
    //         $cart = Cart::where('user_id', Auth::user()->id )->where('is_remove_from_cart',0)->where('is_paid',0)->get();
    //         $order = Order::where('user_id', Auth::user()->id )->get();
    //     }


    //     return view('website.course.courseDetails')->with(['course' => $course, 'chapters' => $chapters,'multiChoice' => $multiChoice, 'mcqRandom' => $mcqRandom,'countMultiChoice' => $countMultiChoice, 'cart' => $cart, 'order' => $order]);

    // }
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
                    $datas=
                    [
                        'all_subjects'=>$all_subjects,
                        'total_amount'=>$total_amount,
                    ];
                    $data=
                    [
                        'code'=>200,
                        'message'=>'All filtering data are Display',
                        'datas'=>$datas,
                    ];
                    return response()->json(['data'=>$data]);
                } else {
                    $data=
                    [
                        'code'=>500,
                        'message'=>'Sorry! subject is not available for this time.',
                        
                    ];
                    return response()->back()->json(['datas' => $data]);
                }
               
                $data=
                [
                    'code'=>500,
                    'message'=>'Sorry! subject is not available for this time.',
                    
                ];
                return response()->back()->json(['datas' => $data]);
            }
        } catch (\Throwable $th) {
            return response()->back()->json(['message' => 'Whoops! Something went wrong. Failed to Find Packages.', 'status' => 2]);
        }
    }
    public function coursePackageAll(Request $request){
       
          
        $board=Board::find($request->assignedBoard);
         $class=AssignClass::with('boards','subjects')->where('id',$request->class_id)->first();
         $subjects=$class->subjects;
         $total_amount=$subjects->sum('subject_amount');
       
        
        return view('website.course.filter-course',compact('board','class','subjects','total_amount'));
    }
    public function  subjectDetails($subject_id){
        $subject_id=Crypt::decrypt($subject_id);
        $subject = AssignSubject::find($subject_id);
        $lessons=$subject->lesson;
      
        return view('website.user.lesson-details', compact('lessons','subject'));
    }
}
