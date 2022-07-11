<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function findSubject(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'board' => 'required',
                'class'=>'required',
            ]);
            if ($validator->fails()) {
                $data = [
                    "code" => 400,
                    "status" => 0,
                    "message" => $validator->errors(),
    
                ];
                return response()->json(['status' => 0, 'result' => $data]);
            }
          
            $subjects = AssignSubject::whereHas('boards', function ($query) use($request){
                $query->where('exam_board', $request->board);
            })->whereHas('assignClass', function ($query) use($request){
                $query->where('class', $request->class);
            })->select('id','subject_name','image','subject_amount', 'subject_amount')->where('is_activate',1)->get();
            $data=[
                'subjects'=>$subjects,
            ];
            if (!$subjects->isEmpty()) {
                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => "all board",
                    "result" => $data,

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            } else {
                $data = [
                    "code" => 200,
                    "status" => 0,
                    "message" => "No record found",

                ];
                return response()->json(['status' => 0, 'result' => $data]);
            }
        } catch (\Throwable $th) {
            $data = [
                "code" => 400,
                "status" => 0,
                "message" => "Something went wrong",

            ];
            return response()->json(['status' => 0, 'result' => $data]);
        }
    }
}
