@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<link href="{{asset('asset_website/css/my_account.css')}}" rel="stylesheet">

@endsection

@section('content')


<div class="container-fluid mt-2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h5>Multiple Choice Questions For Class {{$set->assignClass->class}} {{$set->subject_name}}
                    {{$set->board->exam_board}} Board
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <h5>All Questions</h5><br>
                        @foreach ($set->question as $key=>$question)
                        <button type="button" class="btn btn-primary btn-circle">{{$key+1}}
                        </button>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-body">
                        <h5>1. {{$set->question[0]->question}}</h5>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="optradio">Option 2
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="optradio">Option 2
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="optradio">Option 2
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="optradio">Option 2
                            </label>
                        </div>
                        <button type="button" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection