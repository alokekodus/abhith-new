<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseManagementController extends Controller
{
    public function board(){
        $board_details = Board::where('is_activate', 1)->orderBy('created_at', 'DESC')->get();
        return view('admin.course-management.board')->with('board', $board_details);
    }

    public function addBoard(Request $request){
        $validator = Validator::make($request->all(),[
            'examBoard' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['message' => 'Whoops! Something went wrong', 'error' => $validator->errors()]);
        }else{
            $create = Board::create([
                'exam_board' => $request->examBoard
            ]);

            if($create){
                return response()->json(['message' => 'Board added successfully', 'status' => 1]);
            }else{
                return response()->json(['message' => 'Whoops! Somethinf went wrong. Failed to add board', 'status' => 2]);
            }
        }
    }
}
