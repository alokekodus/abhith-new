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

<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">{{$order->board->exam_board}}/class-{{$order->assignClass->class}}</a>
</nav>
<section class="account-section">
    <div class="container-fluid mt-2">

        <!--   <div class="card card-block mb-2">
                <h4 class="card-title">Card 1</h4>
                <p class="card-text">Welcom to bootstrap card styles</p>
                <a href="#" class="btn btn-primary">Submit</a>
              </div>   -->
        <div class="row">
            @foreach($subjects as $key=>$subject)
            {{-- <div class="col-md-3 col-sm-6 item">
                <div class="card item-card-box card-block">
                    <h6 class="card-title text-right see-more">See More</h6>
                    <img src="{{asset($subject->image)}}" alt="Photo of subject" class="subjectimg">
                    <h4 class="item-card-title mt-3 mb-3 see-more">
                        <a href="{{route('website.user.lesson',[$order->id,$subject->id])}}">
                            {{$subject->subject_name}}</a>
                    </h4>
                    <p class="card-text">
                        <span class="badge badge-primary my-badges" style="float:left;">Total Lesson:
                            {{$subject->lesson->count()}}</span>
                        <span class="badge badge-primary my-badges" style="float:right;">Total
                            Topic:{{$subject->lesson->count()}}</span>
                    </p>
                </div>
            </div> --}}
            <div class="col-md-4">
           
                <div class="course-pic"><img src="{{asset($subject->image)}}" class="w100"></div>
                <div class="course-desc">
                    <h4 class="small-heading-black">{{$subject->subject_name}}</h4>
                    <span>Created by : Demo Teacher</span><br>
                    <span></i>Total Lesson:
                        {{$subject->lesson->count()}}</span>
                    <a href="{{route('website.user.lesson',[$order->id,$subject->id])}}" class="enroll" target="_blank">View Details</a>
                </div>
            </div>
            @endforeach
        </div>



        {{-- <div class="row">
            @foreach($subjects as $key=>$subject)
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$subject->subject_name}}</h5>
                        <p class="card-text"><img src="{{asset($subject->image)}}"></p>
                        <a href="{{route('website.user.lesson',[$order->id,$subject->id])}}"
                            class="btn btn-primary">View all lesson</a>
                    </div>
                </div>
            </div>

            @endforeach

        </div> --}}
    </div>

</section>

@endsection