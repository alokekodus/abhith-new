<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssignClass;
use App\Models\AssignSubject;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BoardController extends Controller
{
    public function allBoard(){
        $board_details = Board::orderBy('created_at', 'DESC')->where('is_activate',1)->get();
        return view('admin.course-management.board.board')->with('board', $board_details);
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

    public function updateBoardStatus(Request $request){
        
        $update = Board::where('id', $request->board_id)->update([
            'is_activate' => $request->active
        ]);

        AssignClass::where('board_id', $request->board_id)->update([
            'is_activate' => $request->active
        ]);

        AssignSubject::where('board_id', $request->board_id)->update([
            'is_activate' => $request->active
        ]);

        if($update){
            if($request->active == 0){
                return response()->json(['message' => 'Visibility changed from show to hide', 'status' => 1]);
            }else{
                return response()->json(['message' => 'Visibility changed from hide to show', 'status' => 1]);
            }
        }else{
            return response()->json(['message' => 'Whoops! Something went wrong. Failed to update status', 'status' => 2]);
        }
    }
}
