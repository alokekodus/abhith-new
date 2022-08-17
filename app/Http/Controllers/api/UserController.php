<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        try {
            $user_details = UserDetails::select('name', 'email', 'phone', 'education', 'gender', 'image', 'address')->where('email', auth()->user()->email)->first();

            $result = ["user_details" => $user_details];
            if (!$user_details = null) {
                $data = [
                    "code" => 200,
                    "status" => 1,
                    "message" => "Your Details",
                    "result" => $result,

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
            return response()->json(['status' => 1, 'result' => $data]);
        }
    }
    public function updateDetails(Request $request)
    {
        try {
            $user_details = UserDetails::where('user_id', auth()->user()->id)->first();
            $data = [
                'education' => $request->education ?? $user_details->education,
                'name' => $request->name ?? $user_details->name,
                'address' => $request->address ?? $user_details->email,
            ];
            $user_details->update($data);

            $data = [
                "code" => 200,
                "status" => 1,
                "message" => "User Details updated successfully",

            ];
            return response()->json(['status' => 1, 'result' => $data]);
        } catch (\Throwable $th) {
            $data = [
                "code" => 400,
                "status" => 0,
                "message" => "Something went wrong",

            ];
            return response()->json(['status' => 0, 'result' => $data]);
        }
    }
    public function profileUpdate(Request $request)
    {
        try {

            $image = $request->file('image');

            $validator = Validator::make($request->all(), [
                'image' => 'required|mimes:jpg,png|max:2048',
            ]);

            if ($validator->fails()) {

                return response()->json(['error' => $validator->errors()], 401);
            }
            if ($file = $request->file('image')) {
                $new_imgage_name = time() . '-' . auth()->user()->name . '.' . $image->extension();
                $image_path = $image->move(public_path('files/profile'), $new_imgage_name);
                $path_name= 'files/profile/'. $new_imgage_name;
                UserDetails::where('email', auth()->user()->email)->update(['image' => $path_name]);
                $data=[
                    "code" => 200,
                    "message" => "Profile photo uploaded",
                    "path"=>$path_name,
                ];
                return response()->json(['status' => 1, 'result' => $data]);
            }
        } catch (\Throwable $th) {
            $data=[
                "code" => 400,
                "message" => "Something went wrong.",
                
            ];
            return response()->json(['status' => 0, 'result' => $data]);
        }
    }
}
