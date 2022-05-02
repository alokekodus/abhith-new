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
        
        try {
            $validator = Validator::make($request->all(),[
                'subjectName' => 'required',
                'subjectCoverPic' => 'required',
                'assignedClass' => 'required',
                'subjectAmount'=>'required'
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
    
                    $document = $request->subjectCoverPic;
                    $file = '';
                    if (isset($document) && !empty($document)) {
                        $new_name = date('d-m-Y-H-i-s') . '_' . $document->getClientOriginalName();
                        $document->move(public_path('/files/course/subject/'), $new_name);
                        $file = '/files/course/subject/' . $new_name;
                    }
                   
                    $create = AssignSubject::create([
                        'subject_name' =>strtoupper($request->subjectName) ,
                        'image' => $file,
                        'assign_class_id' => $assignedClass,
                        'board_id' => $assignedBoard,
                        'subject_amount'=>$request->subjectAmount,
                    ]);
    
                    if($create){
                        return response()->json(['message' => 'Subject assigned successfully', 'status' => 1]);
                    }else{
                        return response()->json(['message' => 'Whoops! Something went wrong. Failed to assign subject.', 'status' => 2]);
                    }
                }
            }
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Whoops! Something went wrong. Failed to assign subject.', 'status' => 2]);
        }
       
    }
}
