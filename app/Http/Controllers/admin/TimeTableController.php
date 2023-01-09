<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Order;
use App\Common\Activation;
use App\Models\AssignClass;
use App\Models\Board;
use App\Models\TimeTable;

use Illuminate\Support\Facades\Auth;

class TimeTableController extends Controller
{

    public function websiteViewTimeTable(Request $request){
        $new_table = [];
        if(Auth::check()){
            $details = Order::where('user_id', Auth::user()->id)->where('payment_status','paid')->get();
            if($details->isEmpty()){
                return view('website.time-table.time-table')->with(['time_data' =>  $new_table]);            
            }else{

                foreach($details as $item){
                    $time_data = TimeTable::with('course', 'chapter')->where('course_id',$item->course_id)->where('chapter_id', $item->chapter_id)->where('is_activate', 1)->orderBy('created_at','DESC')->get();                    
                    array_push($new_table,$time_data->toArray());
                }
            }
        
            
        }

        return view('website.time-table.time-table')->with(['time_data' =>  $new_table]);            
    }



    public function adminViewTimeTable(Request $request){
        $getTimeTables = TimeTable::where('is_activate',1)->orderBy('created_at','DESC')->get();
        return view('admin.time-table.view-time-table')->with(['getTimeTables' => $getTimeTables]);
    }

    public function adminCreateTimeTable(Request $request){
        // $class_details =  AssignClass::with('boards')->where('is_activate', 1)->orderBy('id', 'DESC')->get();
        $boards =  Board::orderBy('id', 'DESC')->get();
        // $chapters = [];
        // if($request->ajax()){
        //         $chapters = Chapter::where('course_id', $request->course_id)->get();
        //     return response()->json(['chapter' => $chapters]);
        // }
        
        return view('admin.time-table.add-time-table')->with(['boards' => $boards]);
    }

    public function saveTimeTable(Request $request){
        $chapter = $request->chapter;
        $course = $request->course;
        $zoom_link = $request->zoom_link;
        $add_time = $request->add_time;
        $add_date = $request->add_date;


        $request->validate([
            'chapter' => 'required',
            'course' => 'required',
            'zoom_link' => 'required',
            'add_time' => 'required',
            'add_date' => 'required',
        ]);

        

        $create = TimeTable::create([
            'chapter_id' => $chapter,
            'course_id' => $course,
            'time' => $add_time,
            'date' => $add_date,
            'zoom_link' => $zoom_link,
            'is_activate' => Activation::Activate,

        ]);

        if($create){
            return response()->json(['message' => 'Time Table created successfully']);
        }else{
            return response()->json(['message' => 'Oops! Something went wrong']);
        }
    }


    public function changeVisibility(Request $request){
        $timeTable = $request->timeTable;
        $status = $request->active;
        TimeTable::where('id',$timeTable)->update([
            'is_activate' =>  $status
        ]);
        if($status == 0){
            return response()->json(['message' => 'Time-Table visibility updated from show to hide']);
        }else{
            return response()->json(['message' => 'Time-Table visibility updated from hide to show']);
        }
    }
}
