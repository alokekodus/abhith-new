@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<link href="{{asset('asset_website/css/my_account.css')}}" rel="stylesheet">



@endsection

@section('content')
@include('layout.website.include.forum_header')
<br>
<section class="account-section">
  <div class="container-fluid">
    <div data-spy="scroll" data-target="#myScrollspy" data-offset="1">
      <label>
        <h6>Lesson</h6>
      </label>
      <div class="row">
        <nav class="col-sm-3 col-4">
          <ul class="nav nav-pills flex-column">
            @foreach($all_lessons as $key=>$lesson)
            <li class="nav-item p-1">
              <a class="nav-link active-tab-button" href="#section1">{{$lesson->name}}</a>
            </li>
            @endforeach
          </ul>
        </nav>
        <div class="col-sm-9 col-8" id="myScrollspy">
          <div id="section1">
            @foreach($all_lessons as $key=>$lesson)
            <h6>All Topics : {{$lesson->name}}</h6>
            <div class="row">
              <div class="col-4">
                <div class="card">
                  <div class="card-body">
                    This is some text within a card body.
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card">
                  <div class="card-body">
                    This is some text within a card body.
                  </div>
                </div>
              </div>
              <div class="col-4">
                <div class="card">
                  <div class="card-body">
                    This is some text within a card body.
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
<br><br><br><br><br>
{{-- <div class="container p-5">
  <div class="row">
    <div class="col-8">
      <b>All Lessons</b>
      <div class="accordion p-2" id="accordionExample">
        @foreach($all_lessons as $key=>$lesson)
        <div class="card">
          <div class="card-header" id="headingOne">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                data-target="#collapse{{$lesson->id}}" aria-expanded="true" aria-controls="collapseOne">
                {{$lesson->name}}
              </button>
            </h2>
          </div>

          <div id="collapse{{$lesson->id}}" class="collapse @if($key==0) show @endif" aria-labelledby="headingOne"
            data-parent="#accordionExample">
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
        <div class="block-ellipsis5">
          <h4 class="small-heading-black">{{$subject->subject_name}}</h4>
        </div>
        <span></span>
      </div>

    </div>
  </div>
</div> --}}

@endsection