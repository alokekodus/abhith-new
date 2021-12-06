@php
use App\Models\Subject;
use App\Common\Activation;

$subjects = Subject::where('is_activate', Activation::Activate)
    ->orderBy('id', 'DESC')
    ->get();

@endphp

@extends('layout.admin.layoout.admin')

@section('title', 'Add Multiple Choice')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add Multiple Choice Questions</h4>
                <form action="{{route('admin.insert.mcq.question')}}"  method="POST" enctype="multipart/form-data">
                    @csrf

                    @if(session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>    
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>    
                    @endif

                    <div class="form-group">
                        <label for="">Select Set Name</label>
                        <select name="setName" id="setName" class="form-control" required>
                            <option value=""  disabled selected>-- select --</option>
                            <option value="Set A">Set A</option>
                            <option value="Set B">Set B</option>
                            <option value="Set C">Set C</option>
                            <option value="Set D">Set D</option>
                            <option value="Set E">Set E</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Select Subjects</label>
                        <select class="form-control" name="subject_id" required>
                            <option value="" disabled selected>-- Select Subject --</option>
                            @foreach ($subjects as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger" id="subject_id_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="">Upload questions in excel format</label>
                        <input type="file" name="questionExcel" class="form-control">
                    </div>
                    {{-- <div class="after-add-more">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="exampleInputName1">Question</label>
                                    <input type="text" class="form-control" name="question[]" placeholder="e.g what is the unit of temperature ?" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success" style="margin-top:23px;float:right;" id="addMoreMultipleChoice">Add More</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Option 1</label>
                                    <input type="text" class="form-control" name="option1[]" placeholder="e.g Celcius" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Option 2</label>
                                    <input type="text" class="form-control" name="option2[]" placeholder="e.g Hertz" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Option 3</label>
                                    <input type="text" class="form-control" name="option3[]" placeholder="e.g Pascal" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Option 4</label>
                                    <input type="text" class="form-control" name="option4[]" placeholder="e.g Kelvin" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputName1">Correct Answer</label>
                                    <input type="text" class="form-control" name="correct_answer[]" placeholder="e.g what is the unit of temperature ?" required>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <button class="btn btn-primary">Submit</button>
                </form>


                {{-- <div class="copy" style="display: none;">
                    <div class="control-group">
                        <hr>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="exampleInputName1">Question</label>
                                    <input type="text" class="form-control" name="question[]" placeholder="e.g what is the unit of temperature ?">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger" style="margin-top:23px;float:right;" id="removeMultipleChoice">remove</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Option 1</label>
                                    <input type="text" class="form-control" name="option1[]" placeholder="e.g Celcius">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Option 2</label>
                                    <input type="text" class="form-control" name="option2[]" placeholder="e.g Hertz">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Option 3</label>
                                    <input type="text" class="form-control" name="option3[]" placeholder="e.g Pascal">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Option 4</label>
                                    <input type="text" class="form-control" name="option4[]" placeholder="e.g Kelvin">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputName1">Correct Answer</label>
                                    <input type="text" class="form-control" name="correct_answer[]" placeholder="e.g what is the unit of temperature ?" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        setTimeout(function () {
            $('.alert').slideUp();
        }, 3000);
        // $(document).ready(function(){
        //     $('#addMoreMultipleChoice').click(function(e){
        //         e.preventDefault();
        //         let html = $(".copy").html();
        //         $(".after-add-more").append(html);
        //     });

        //     $("body").on("click","#removeMultipleChoice",function(){ 
        //         $(this).parents(".control-group").remove();
        //     });
        // });
        
    </script>

@endsection