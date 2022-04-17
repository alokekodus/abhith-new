<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssignClass;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssignClassController extends Controller
{
    public function allClasses(){
        $board_details = Board::where('is_activate', 1)->orderBy('created_at', 'DESC')->get();
        $assigned_classes_details = AssignClass::with('boards')->where('is_activate', 1)->orderBy('created_at', 'DESC')->get();
        return view('admin.course-management.classes.class')->with(['boards' => $board_details, 'assignedClass' => $assigned_classes_details]);
    }

    public function assignClass(Request $request){
        $validator = Validator::make($request->all(),[
            'board' => 'required',
            'assignedClass' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'Whoop! Something went wrong.', 'error' => $validator->errors()]);
        }else{
            $is_class_assigned_already = AssignClass::where('class', $request->assignedClass)->where('board_id', $request->board)->exists();
            if($is_class_assigned_already){
                return response()->json(['message' => 'Whoops! Class already assigned with the board.', 'status' => 2]);
            }else{
                $create = AssignClass::create([
                    'class' => $request->assignedClass,
                    'board_id' => $request->board
                ]);

                if($create){
                    return response()->json(['message' => 'Class assigned successfully', 'status' => 1]);
                }else{
                    return response()->json(['message' => 'Whoops! Something went wrong. Failed to assign class.', 'status' => 2]);
                }
            }
        }
    }
}
