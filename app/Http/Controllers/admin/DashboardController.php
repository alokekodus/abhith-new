<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
class DashboardController extends Controller
{
  public function index(){
   
    $boards = Board::where('is_activate', 1)->get();
    return view('admin.dashboard.dashboard',compact('boards'));
  }
      
}
