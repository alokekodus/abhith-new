<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class StudentController extends Controller
{
  public function index()
  {
    $assign_subjects = AssignSubject::with(['assignOrder' => function ($query) {
      $query->with(['order' => function ($q) {
        $q->with('user');
      }]);
    }])->where('teacher_id', auth()->user()->id)->get();
    // $orders=Order::with(['user','assignSubject'=>function($query){
    //     $query->with(['subject'=>function($q){
    //         $q->where('teacher_id',auth()->user()->id);
    //     }]);
    // }])->get();
   
    return view('teacher.student.index', compact('assign_subjects'));
  }
  public function subjectWiseStudent($subject_id)
  {
    $assign_subjects = AssignSubject::with(['assignOrder' => function ($query) {
      $query->with(['order' => function ($q) {
        $q->with('user');
      }]);
    }])->where('id', Crypt::decrypt($subject_id))->first();
    $assign_orders=$assign_subjects->assignOrder;
   
      return view('teacher.student.index', compact('assign_orders'));
  }
}
