@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<link href="{{asset('asset_website/css/my_account.css')}}" rel="stylesheet">
<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        width: 100%;
        padding-left: 0.5rem;
        border-left: 0.5rem solid #076fef;
    }

    .container {
        padding: 2px 16px;
    }

    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        border-radius: 35px;
        font-size: 24px;
        line-height: 1.33;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        padding: 6px 0px;
        border-radius: 15px;
        text-align: center;
        font-size: 12px;
        line-height: 1.42857;
    }
</style>
@endsection

@section('content')
@include('layout.website.include.forum_header')
<section class="account-section">
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
                   
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection