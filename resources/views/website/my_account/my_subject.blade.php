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
<section class="account-section">
    <div class="container-fluid">
     
        <div class="row">
            @foreach($subjects as $key=>$subject)
             <div class="col-sm-4">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">{{$subject->subject_name}}</h5>
                      <p class="card-text"><img src="{{asset($subject->image)}}"></p>
                      <a href="{{route('website.user.lesson',[$order->id,$subject->id])}}" class="btn btn-primary">View all lesson</a>
                    </div>
                  </div>
            </div>
          
            @endforeach
             
          </div>
     </div>
    
</section>

@endsection


