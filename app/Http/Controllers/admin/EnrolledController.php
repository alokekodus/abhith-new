<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class EnrolledController extends Controller
{
    public function getEnrolledStudents(){
        $stu_details = Order::with('course','chapter', 'user')->orderBy('created_at','DESC')->get();
        return view('admin.enrolled.students')->with('details', $stu_details);
    }
}
