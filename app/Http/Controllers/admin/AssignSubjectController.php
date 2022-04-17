<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssignClass;
use App\Models\AssignSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AssignSubjectController extends Controller
{
    public function allSubjects(){
        $class_details =  AssignClass::with('boards')->where('is_activate', 1)->get();
        $assign_subject = AssignSubject::with('assignClass','boards')->where('is_activate', 1)->orderBy('created_at', 'DESC')->get();
        return view('admin.course-management.subjects.subject')->with(['subjects' => $assign_subject, 'classes' => $class_details]);
    }

    public function assignSubject(Request $request){
        $validator = Validator::make($request->all(),[
            'subjectName' => 'required',
            'assignedClass' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'Whoop! Something went wrong.', 'error' => $validator->errors()]);
        }else{
            $split_assignedClass = str_split($request->assignedClass);
            $assignedClass = $split_assignedClass[0];
            $assignedBoard = $split_assignedClass[1];

            $is_subject_assigned_already = AssignSubject::where('subject_name', $request->subjectName)->where('assign_class_id', $assignedClass)->where('board_id', $assignedBoard)->exists();
            if($is_subject_assigned_already){
                return response()->json(['message' => 'Whoops! Subject already assigned with the class.', 'status' => 2]);
            }else{
               
                $create = AssignSubject::create([
                    'subject_name' => $request->subjectName,
                    'assign_class_id' => $assignedClass,
                    'board_id' => $assignedBoard
                ]);

                if($create){
                    return response()->json(['message' => 'Subject assigned successfully', 'status' => 1]);
                }else{
                    return response()->json(['message' => 'Whoops! Something went wrong. Failed to assign subject.', 'status' => 2]);
                }
            }
        }
    }
}
