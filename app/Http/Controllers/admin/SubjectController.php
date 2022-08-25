<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    //
    protected function index()
    {
        $subjects = Subject::orderBy('id', 'DESC')->paginate(10);

        return view('admin.master.subjects.subjects', \compact('subjects'));
    }

    protected function create(Request $request)
    {

        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required',
            ],
            ['name.required' => 'Subject Name is required']
        );
        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }
        Subject::create([
            'name' => $request->name
        ]);
        $request->session()->flash('subject_created', 'Subject created successfully');
        return \redirect()->back();
    }

    protected function active(Request $request)
    {
        $subject = AssignSubject::find($request->subjectId);
        $subject->is_activate = $request->active;
        $subject->save();

        if ($request->active == 0) {
            return response()->json(['status' => 1, 'message' => 'Subject visibility changed from show to hide']);
        } else {
            return response()->json(['status' => 1, 'message' => 'Subject visibility changed from hide to show']);
        }
    }

    protected function editSubject(Request $request)
    {
        $subject_id = \Crypt::decrypt($request->id);
        $subject = Subject::find($subject_id);

        return view('admin.master.subjects.edit', \compact('subject'));
    }

    protected function edit(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $subject_id = \Crypt::decrypt($request->id);
        $subject = Subject::find($subject_id);
        $subject->name = $request->name;
        $subject->save();
        $request->session()->flash('subject_update_message', 'Subject name updated successfully');

        return redirect()->back();
    }
    public function getDemoVideo($lesson_id)
    {
        try {
            $lesson = Lesson::with('lessonAttachment')->where('id',$lesson_id)->first();
            $all_lessons = Lesson::with('lessonAttachment')->whereHas('lessonAttachment', function ($query) {
                $query->where('free_demo', 1);
            })->where('assign_subject_id', $lesson->assign_subject_id)->where('type', 2)->get();
            $result=[
                'lesson'=>$lesson,
                'all_lessons'=>$all_lessons,
            ];

            return response()->json(['status' => 1, 'result' => $result]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 0, 'result' => []]);
        }
    }
}
