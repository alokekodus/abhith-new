<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TeacherController extends Controller
{
    public function store(Request $request)
    {
        try {
            $resume = $request->resume;
            $teacherdemovideo=$request->teacherdemovideo;
            if (!empty($resume)) {
                $new_name = date('d-m-Y-H-i-s') . '_' . $resume->getClientOriginalName();
                // $new_name = '/images/'.$image.'_'.date('d-m-Y-H-i-s');
                $resume->move(public_path('/files/teacher/resume/'), $new_name);
                $resume_url = 'files/teacher/resume/' . $new_name;
            }
            if (!empty($teacherdemovideo)) {
                $new_name = date('d-m-Y-H-i-s') . '_' . $teacherdemovideo->getClientOriginalName();
                // $new_name = '/images/'.$image.'_'.date('d-m-Y-H-i-s');
                $teacherdemovideo->move(public_path('/files/teacher/demovideo/'), $new_name);
                $teacherdemovideo_url = 'files/teacher/demovideo/' . $new_name;
            }
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'total_experience_year' => $request->total_experience_year,
                'total_experience_month' => $request->total_experience_month,
                'education' => $request->education,
                'assign_board_id' => 1,
                'assign_class_id' => 1,
                'assign_subject_id' => 1,
                'hslc_percentage' => $request->hslc_percentage,
                'hs_percentage' => $request->hs_percentage,
                'current_organization' => $request->current_organization,
                'current_designation' => $request->current_designation,
                'current_ctc' => $request->current_ctc,
                'resume_url' => $resume_url,
                'teacherdemovideo_url' => $teacherdemovideo_url,
                'status'=>1,

            ];
            $user_details = UserDetails::where('user_id', auth()->user()->id)->where('status','!=',0)->get();
            if ($user_details == true) {
                UserDetails::where('user_id', auth()->user()->id)
                    ->update(
                        $data
                    );
            } else {
                UserDetails::create($data);
            }


            return response()->json(['message' => 'Application submitted successfully']);
            
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function index(Request $request){
          $applications=UserDetails::with('user')->where('status','!=',0)->get();
          return view('admin.teacher.index',compact('applications'));
    }
    public function details($teacher_id){
        try {
            $user_details=UserDetails::with('user')->where('id',Crypt::decrypt($teacher_id))->first();
            return view('admin.teacher.application',compact('user_details'));
           
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function approvedApplication($user_detail_id){
        try {
            $data=[
                'status'=>2,
                'referral_id'=>teacherReferralId(),
            ];
            $user_details=UserDetails::find(Crypt::encrypt($user_detail_id));
            $user_details->update($data);
            Toastr::success('Application approved sccessfully.', '', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
