<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
                $path_name = 'files/profile/' . $new_imgage_name;
                UserDetails::where('email', auth()->user()->email)->update(['image' => $path_name]);
                $data = [
                    "code" => 200,
                    "message" => "Profile photo uploaded",
                    "path" => $path_name,
                ];
                return response()->json(['status' => 1, 'result' => $data]);
            }
        } catch (\Throwable $th) {
            $data = [
                "code" => 400,
                "message" => "Something went wrong.",

            ];
            return response()->json(['status' => 0, 'result' => $data]);
        }
    }
    public function allCourses(Request $request)
    {
        try {
            $carts = Cart::select('id', 'user_id', 'is_full_course_selected', 'assign_class_id', 'board_id', 'is_paid', 'is_remove_from_cart')
                ->with(['assignClass:id,class', 'board:id,exam_board', 'assignSubject:id,cart_id,assign_subject_id,amount', 'assignSubject.subject:id,subject_name'])
                ->where('user_id', auth()->user()->id)
                ->where('is_paid', 1)
                ->where('is_remove_from_cart', 0)
                ->get();
           
            if (!$carts->isEmpty()) {
                $all_courses = [];
                $subject = [];
                foreach ($carts as $key => $cart) {
                    foreach ($cart->assignSubject as $key => $assign_subject) {
                        $subject[] = $assign_subject->subject->subject_name;
                    }


                    $course_details = [
                        'id' => $cart->id,
                        'user_id' => $cart->user_id,
                        'type' => $cart->is_full_course_selected,
                        'board' => $cart->board->exam_board,
                        'class_name' => $cart->assignClass->class,
                        'total_subject' => $cart->assignSubject->count(),
                        'total_amount' => $cart->assignSubject->sum("amount"),
                        'cart_subject_details' => $subject,
                    ];
                    $all_courses[] = $course_details;
                }
                $data = [
                    "code" => 200,
                    "message" => "Courses Details",
                    "courses" => $all_courses,

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            }else{
                $data = [
                    "code" => 200,
                    "message" => "No data found",
                    "courses" => [],

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            }
        } catch (\Throwable $th) {
            $data = [
                "code" => 400,
                "status" => 0,
                "message" => "Something went wrong",
                "all_subjects" => [],

            ];
            return response()->json(['status' => 0, 'result' => $data]);
        }
    }
    public function resetPassword(Request $request)
    {
        try {
            $user = User::find(auth()->user()->id);
            if (Hash::check($request->old_password, $user->password)) {
                $user->fill([
                    'password' => Hash::make($request->new_password)
                ])->save();

                $data = [
                    "code" => 200,
                    "message" => "Password changed Successfully ",

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            } else {
                $data = [
                    "code" => 200,
                    "message" => "Password does not match. ",

                ];
                return response()->json(['status' => 1, 'result' => $data]);
            }
        } catch (\Throwable $th) {
            $data = [
                "code" => 400,
                "message" => "Something went wrong",

            ];
            return response()->json(['status' => 0, 'result' => $data]);
        }
    }
}
