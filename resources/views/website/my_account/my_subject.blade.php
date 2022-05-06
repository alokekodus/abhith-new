@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<style>
    .sidebar {
        position: sticky;
        top: 150px;
    }
    @import url("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
    table{
        border: 1px solid #f3f3f3;
        border-radius: 10px;
        box-shadow: 0px 5px 5px #efecec;
    }
    th{
        border-top:0px !important;
    }
    #purchase_history_table_filter{
        margin-top:-40px;
    }
    #forum-search-bar{
        display:none;
    }
</style>

@endsection

@section('content')
@include('layout.website.include.forum_header')
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">{{$order->board->exam_board}}/class-{{$order->assignClass->class}}</a>
  </nav>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 p-0">
            <ul class="list-inline courses-list">
                @foreach($subjects as $key=>$subject)
                <li>
                    <div class="course-desc"></span>
                        <div class="block-ellipsis5"><h4 class="small-heading-black">{{$subject->subject_name}}</h4></div>
                        <span></span>
                        <a href="{{route('website.user.lesson',[$order->id,$subject->id])}}" class="enroll">View all lesson</a>
                    </div>
                </li>
                @endforeach
                

            </ul>
            
        </div>
    </div>
</div>
@endsection


