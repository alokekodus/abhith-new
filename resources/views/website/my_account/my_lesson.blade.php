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
  <div class="container p-5">
    <div class="row">
      <div class="col-8">
        <b>All Lessons</b>
        <div class="accordion p-2" id="accordionExample">
          @foreach($all_lessons as $key=>$lesson)
          <div class="card">
            <div class="card-header" id="headingOne">
              <h2 class="mb-0">
                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$lesson->id}}" aria-expanded="true" aria-controls="collapseOne">
                 {{$lesson->name}}
                </button>
              </h2>
            </div>
        
            <div id="collapse{{$lesson->id}}" class="collapse @if($key==0) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">
                <ol>
                  @foreach($lesson->topics as $key=>$topic)
                  <li>{{substr(strip_tags($lesson->content), 0, 100)}}...</li>
                  @endforeach
                  
                </ol>
              </div>
            </div>
          </div>
          @endforeach
           
        </div>
      </div>
      <div class="col-1"></div>
      <div class="col-3">
        
          <div class="course-pic"><img src="{{asset($subject->image)}}" class="w100"></div>
          <div class="course-desc"></span>
              <div class="block-ellipsis5"><h4 class="small-heading-black">{{$subject->subject_name}}</h4></div>
              <span></span>
          </div>
      
      </div>
    </div>
  </div>

@endsection


