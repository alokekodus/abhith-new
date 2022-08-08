<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class EnrolledController extends Controller
{
    public function getEnrolledStudents(){
        $stu_details = Order::with('board','assignClass','assignSubject','user')->orderBy('created_at','DESC')->get();
        return view('admin.enrolled.students')->with('details', $stu_details);
    }
    public function getRegisterdStudents(){
        $students=User::where('type',2)->get();
    }
}
