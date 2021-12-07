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
                        <p>
                            <span style="color:red;">Note <sup>*</sup></span>  To upload questions, proper excel format is required to avoid errors. Download the format by <a href="{{asset('/files/mcq_format/Mcq_Upload_Format.xlsx')}}" download>Clicking Here <i class="mdi mdi-cloud-download menu-icon"></i></a>  &nbsp;and fillup the excel sheet without removing the headers.
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="">Upload questions in excel format</label>
                        <input type="file" name="questionExcel" class="form-control" required>
                    </div>
                    <button class="btn btn-primary">Submit</button>
                </form>

                @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                      <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-ban"></i> Error!</h4>
                          @foreach($errors->all() as $error)
                          {{ $error }} <br>
                          @endforeach      
                      </div>
                    </div>
                </div>
                @endif
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