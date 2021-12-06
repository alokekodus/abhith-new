<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MultipleChoice;
use App\Models\Set;
use App\Models\Question;
use App\Models\Subject;
use App\Imports\QuestionImport;
use Illuminate\Support\Facades\Crypt;


class MultipleChoiceController extends Controller
{
    public function index(Request $request){
        $getMultipleChoice = Set::with('subject')->get();
        return view('admin.multiple-choice.multiple-choice')->with('getMultipleChoice', $getMultipleChoice);
    }

    public function addMultipleChoice(Request $request){
        return view('admin.multiple-choice.add-multiple-choice');
    }

    public function insertQuestions(Request $request){
        $setName = $request->setName;
        $subject_id = $request->subject_id;
        $questionFile = $request->questionExcel;

        $checkIfSetExists = Set::where('subject_id',$subject_id)->where('set_name',$setName)->exists();

        $subject = Subject::where('id', $subject_id)->first();

        if($checkIfSetExists == true){
            return back()->with(['error' => $setName.' '.'already exists with subject '.$subject->name.'. Please select another subject.']);
        }else{


            if( $request->hasFile('questionExcel') ){
                $new_excel_name = date('d-m-Y-H-i-s') . '_' . $questionFile->getClientOriginalName();
                $questionFileExtension = $questionFile->getClientOriginalExtension();

                if($questionFileExtension != 'xlsx'){
                    return back()->with(['error' => 'Not a valid excel file.']);
                }else{

                    $create = Set::create([
                        'set_name' => $setName,
                        'subject_id' => $subject_id
                    ]);

                    if($create){
                        $get_set_id = Set::where('subject_id',$subject_id)->first();
                        $questionFile = $request->file('questionExcel');
                
                        $questionFile = $request->file('questionExcel')->store('imports');
                        $import = new QuestionImport($get_set_id->id);
                        $import->import($questionFile);
            
                        return back()->withStatus('File uploaded successfully');
                    }else{
                        return back()->with(['error' => $setName.' '.'already exists with subject '.$subject->name.'. Please select another subject.']);
                    }
                   
                }
            
            }else{
                return back()->with(['error' => $setName.' '.'already exists with subject '.$subject->name.'. Please select another subject.']);
            }
        }

    }


    public function viewEditMcq(Request $request,$id){

        $mcq_set_id = Crypt::decrypt($id);

        $details = Question::where('set_id',$mcq_set_id)->get();

        return view('admin.multiple-choice.edit-multiple-choice')->with('details' , $details);
    }


    // public function insertMultipleChoice(Request $request){
    //     $subject_id = $request->subject_id;
    //     $question = $request->question;
    //     $option1 = $request->option1;
    //     $option2 = $request->option2;
    //     $option3 = $request->option3;
    //     $option4 = $request->option4;
    //     $correct_answer = $request->correct_answer;

    //     foreach($question as $key =>$value){
    //         foreach($option1 as $key1 => $value1){
    //             foreach($option2 as $key2 => $value2){
    //                 foreach($option3 as $key3 => $value3){
    //                     foreach($option4 as $key4 => $value4){
    //                         foreach($correct_answer as $key5 => $value5){
    //                             if($key == $key1 && $key1 == $key2 && $key2 == $key3 && $key3 == $key4 && $key4 == $key5){
    //                                 $data['subject_id'] = $subject_id;
    //                                 $data['question'] = $value;
    //                                 $data['option_1'] = $value1;
    //                                 $data['option_2'] = $value2;
    //                                 $data['option_3'] = $value3;
    //                                 $data['option_4'] = $value4;
    //                                 $data['correct_answer'] = $value5;
    //                                 $data['is_activate'] = 1;
    //                                 $insertingData[] = $data;
    //                             }
    //                         }
    //                     } 
    //                 }
    //             } 
    //         } 
    //     }

    //     MultipleChoice::insert($insertingData);
    //     return back()->withSuccess(['message' => "MCQ's Added Successfully"]);
    // }


    public function isActivateMultipleChoice(Request $request){
        MultipleChoice::where('subject_id' ,$request->subject_id)->update([ 'is_activate' => $request->active, ]);
        return response()->json(['message' => 'MCQ status updated successfully']);
    }


    public function startMcq(Request $request, $id){
        $startMcq = MultipleChoice::where('subject_id', $id)->simplePaginate(5);
        return back()->with('startMcq',  $startMcq);
    }


    public function checkIsCorrectMcq(Request $request){
        $subject_id = $request->subject_id;
        $mcArray = $request->mcArray;

        $checkMcq = MultipleChoice::where('subject_id', $subject_id)->get();
        $correctAnswerArray = [];
        foreach( $checkMcq as $item){
            array_push($correctAnswerArray, $item->correct_answer);
        }
        $output = array_intersect( $mcArray,$correctAnswerArray);

        return response()->json(['Total_corrects' => count($output)]);
    }
}
