<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
class SubjectController extends Controller
{
    //
    protected function index(){
        $subjects = Subject::orderBy('id','DESC')->paginate(10);

        return view('admin.master.subjects.subjects', \compact('subjects'));
    }

    protected function create(Request $request){
         
        $validate = Validator::make($request->all(),[
            'name' => 'required',
        ],
        ['name.required'=>'Subject Name is required']);
        if ($validate->fails()) {
            return redirect()->back()
                        ->withErrors($validate)
                        ->withInput();
        }
        Subject::create([
            'name' => $request->name
        ]);
        $request->session()->flash('subject_created','Subject created successfully');
        return \redirect()->back();
    }

    protected function active(Request $request) {
        $subjects = Subject::find($request->catId);
        $subjects->is_activate = $request->active;
        $subjects->save();
    }

    protected function editSubject(Request $request) {
        $subject_id = \Crypt::decrypt($request->id);
        $subject = Subject::find($subject_id);

        return view('admin.master.subjects.edit', \compact('subject'));
    }

    protected function edit(Request $request){
       $request->validate([
        'name' => 'required'
       ]);
        $subject_id = \Crypt::decrypt($request->id);
        $subject = Subject::find($subject_id);
        $subject->name = $request->name;
        $subject->save();
        $request->session()->flash('subject_update_message','Subject name updated successfully');

        return redirect()->back();
    }
}
