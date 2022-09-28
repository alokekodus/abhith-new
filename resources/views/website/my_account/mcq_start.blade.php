@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<link href="{{asset('asset_website/css/my_account.css')}}" rel="stylesheet">
<style>
    main{
        margin: 0;
    }
</style>
@endsection

@section('content')

<div class="mcq-head  d-flex">
    <div class="mcq-head-text d-flex">
        <div class="mcq-head-icon mr-3">
            <img src="{{asset('asset_website/img/mcq.png')}}" alt="">
        </div>
        <div class="mcq-header-text">
            <h3>Multiple Choice Questions For Class {{$set->assignClass->class}} {{$set->subject_name}}
                <span>{{$set->board->exam_board}} Board</span>
            </h3>
            <p>1/10 Questions</p>
        </div>
    </div>
    <div class="mcq-cross-icon">
        <button type="button" class="btn">Submit Test</button>
    </div>
</div>
<div class="container-fluid" id="mcq-question">
    <div class="row">
        {{-- <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h5>All Questions</h5><br>
                    @foreach ($set->question as $key=>$question)
                    <button type="button" class="btn btn-primary btn-circle">{{$key+1}}
                    </button>
                    @endforeach

                </div>
            </div>
        </div> --}}
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    {{-- <h5>1. {{$set->question[0]->question}}</h5> --}}
                    {{-- <div class="form-check">
                        <input type="radio" class="form-check-input" name="optradio">
                        <label>Option 2</label>
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
                    </div> --}}
                    <h4>Question 1: What is your favourite language?</h4>
                    <form action="" class="mcq-options d-flex">
                        <div class="mcq-option-text">
                            <h5>Option:</h5>
                        </div>
                        <div class="mcq-option-div">
                            <div class="options">
                                <input type="radio" id="html" name="fav_language" value="HTML">
                            <label for="html">HTML</label>
                            </div>
                            <div class="options">
                                <input type="radio" id="css" name="fav_language" value="CSS">
                                <label for="css">CSS</label>
                            </div>
                            <div class="options">
                                <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                                <label for="javascript">JavaScript</label>
                            </div>
                            <div class="options">
                                <input type="radio" id="jQuery" name="fav_language" value="jQuery">
                                <label for="jQuery">jQuery</label>
                            </div>
                        </div>
                    </form>
                    <div class="mcq-submit-btn d-flex">
                        <div class="mcq-submit">
                            <button type="button" class="btn btn-outline-success mcq-btn-width mr-2">Skip</button>
                        </div>
                        <div class="mcq-next">
                            <button type="button" class="btn btn-primary mcq-btn-width">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection