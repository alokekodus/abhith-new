@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<link href="{{asset('asset_website/css/my_account.css')}}" rel="stylesheet">
<style>
.subjectimg{
    height: 150px;
    width: 100%;
}
</style>

@endsection

@section('content')
@include('layout.website.include.forum_header')
<section class="account-section">
    <div class="container-fluid mt-2">
        <div class="row">
            @foreach($subjects as $key=>$subject)
    
            <div class="col-md-4">
                <div class="course-pic">
                    <img src="{{asset($subject->image)}}" class="w100">
                </div>
                <div class="course-desc">
                    <h4 class="small-heading-black">{{$subject->subject_name}}</h4>
                    Board:{{$order->board->exam_board}} Class:{{$order->assignClass->class}}<br>
                    <span>Created by : Demo Teacher</span><br>
                    <span></i>Total Lesson:
                        {{$subject->lesson->count()}}</span>
                    <a href="{{route('website.user.lesson',[Crypt::encrypt($order->id),Crypt::encrypt($subject->id)])}}" class="enroll">View Details</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</section>

@endsection