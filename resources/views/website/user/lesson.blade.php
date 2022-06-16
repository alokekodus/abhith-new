@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<link href="{{asset('asset_website/css/my_account.css')}}" rel="stylesheet">

<style>
  .panel-default>.panel-heading {
    color: #333;
    background-color: #fff;
    border-color: #e4e5e7;
    padding: 0;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .panel-default>.panel-heading a {
    display: block;
    padding: 10px 15px;
  }

  .panel-default>.panel-heading a:after {
    content: "";
    position: relative;
    top: 1px;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    float: right;
    transition: transform .25s linear;
    -webkit-transition: -webkit-transform .25s linear;
  }

  .panel-default>.panel-heading a[aria-expanded="true"] {
    background-color: #eee;
  }

  .panel-default>.panel-heading a[aria-expanded="true"]:after {
    content: "\2212";
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
  }

  .panel-default>.panel-heading a[aria-expanded="false"]:after {
    content: "\002b";
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
  }

  .panel-default>.topic-panel-heading {
    position: relative;
    color: #333;
    background-color: #fff;
    border-color: #e4e5e7;
    left: 40px;
    width: 95%;
    padding: 0;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .panel-default>.topic-panel-heading a {
    display: block;
    padding: 10px 15px;
  }

  .panel-default>.topic-panel-heading a:after {
    content: "";
    position: relative;
    top: 1px;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    float: right;
    transition: transform .25s linear;
    -webkit-transition: -webkit-transform .25s linear;
  }



  .panel-default>.topic-panel-heading a[aria-expanded="true"]:after {
    content: "\2212";
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
  }

  .panel-default>.topic-panel-heading a[aria-expanded="false"]:after {
    content: "\002b";
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
  }

  /* //subtopic */
  .panel-default>.subtopic-panel-heading {
    position: relative;
    color: #333;
    background-color: #fff;
    border-color: #e4e5e7;
    left: 55px;
    width: 93%;
    padding: 0;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .panel-default>.subtopic-panel-heading a {
    display: block;
    padding: 10px 15px;
  }

  .panel-default>.subtopic-panel-heading a:after {
    content: "";
    position: relative;
    top: 1px;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    float: right;
    transition: transform .25s linear;
    -webkit-transition: -webkit-transform .25s linear;
  }



  .panel-default>.subtopic-panel-heading a[aria-expanded="true"]:after {
    content: "\2212";
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
  }

  .panel-default>.subtopic-panel-heading a[aria-expanded="false"]:after {
    content: "\002b";
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
  }
</style>


@endsection

@section('content')
{{-- @include('layout.website.include.forum_header') --}}
<br>
<section class="account-section">
  @if($lessons->count()!=0)
  <div class="row">
    <div class="col-8">
      <p class="cross-line">
        <span>{{$subject->subject_name}}</span>
      </p>
      <h2 class="heading-black">{{$lessons[0]->name}}</h2>
      <p>
      <h6>{!!$lessons[0]->content!!}</h6>
      </p>

      <p class="cross-line">
        <span>{{$subject->subject_name}} All Content</span>
      </p>
      <div class="panel-group" id="accordionLesson" role="tablist" aria-multiselectable="true">
        @foreach($lessons as $key=>$lesson)
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title">
              <a role="button" data-toggle="collapse" data-parent="#accordionLesson" href="#collapseOne{{$key}}"
                aria-expanded="true" aria-controls="collapseOne{{$key}}">
                <span class="small-heading-black">Lesson Name: {{$key+1}} .{{$lesson->name}}</span>
              </a>
            </h4>
          </div>

          <div id="collapseOne{{$key}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
              @foreach($lesson->topics as $topickey=>$topic)
              <div class="panel-group" id="accordionTopic" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                  <div class="topic-panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">

                      <a role="button" data-toggle="collapse" data-parent="#accordionTopic"
                        href="#collapseOneTopic{{$topickey}}" aria-expanded="true" aria-controls="collapseOne">
                        <span class="small-heading-black">{{$topickey+1}} .{{$topic->name}}</span>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOneTopic{{$topickey}}" class="panel-collapse collapse in" role="tabpanel"
                    aria-labelledby="headingOne">
                    <div class="panel-body">
                      @if($topic->lessonAttachment!=null)
                      @if($topic->lessonAttachment->img_url!=null)
                      <div style="position: absolute;left:70px;"><i class="fa fa-picture-o"
                          style="font-size:18px;color:#0770EF"></i>
                      </div><br>
                      @endif
                      @if($topic->lessonAttachment->origin_video_url!=null)
                      <div style="position:absolute;left:70px;"><i class="fa fa-play-circle"
                          style="font-size:20px;color:#0770EF"></i>
                      </div><br>
                      @endif
                      @endif
                      @foreach($topic->subTopics as $subtopickey=>$subtopic)
                      <div class="panel-group" id="accordionSubtopic" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                          <div class="subtopic-panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                              <a role="button" data-toggle="collapse" data-parent="#accordionSubtopic"
                                href="#collapseOneSubtopic{{$subtopic}}" aria-expanded="true"
                                aria-controls="collapseOne">
                                <span class="small-heading-black">{{$subtopickey+1}} .{{$subtopic->name}}</span>
                              </a>
                            </h4>
                          </div>
                          <div id="collapseOneSubtopic{{$subtopic}}" class="panel-collapse collapse in" role="tabpanel"
                            aria-labelledby="headingOne">
                            <div class="panel-body">
                              @if($subtopic->lessonAttachment!=null)
                              @if($subtopic->lessonAttachment->img_url!=null)
                              <div style="position: absolute;left:70px;"><i class="fa fa-picture-o"
                                  style="font-size:18px;color:#0770EF"></i>
                              </div><br>
                              @endif
                              @if($subtopic->lessonAttachment->origin_video_url!=null)
                              <div style="position:absolute;left:70px;"><i class="fa fa-play-circle"
                                  style="font-size:20px;color:#0770EF"></i>
                              </div><br>
                              @endif
                              @endif
                              @if($subtopic->lessonAttachment!=null)
                              @if($subtopic->lessonAttachment->img_url!=null)
                              <div style="left:70px;"><i class="fa fa-picture-o"
                                  style="font-size:18px;color:#0770EF"></i>
                              </div>
                              @endif
                              @if($subtopic->lessonAttachment->origin_video_url!=null)
                              <div><i class="fa fa-play-circle" style="font-size:20px;color:#0770EF"></i>
                              </div>
                              @endif
                              @endif
                            </div>
                          </div>
                        </div>

                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>

              </div>
              @endforeach
            </div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
    <div class="col-4">


      <div class="course-pic">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item"
            src="{{asset('/storage/'.$lessons[0]->lessonAttachment->origin_video_url)}}"></iframe>
        </div>
      </div>
      <div class="course-desc">
        <h4 class="small-heading-black">{{$subject->subject_name}}</h4>
        <span>Created by : Demo Teacher</span><br>
        <span></i>Total Lesson:
          {{$subject->lesson->count()}}</span>
        {{-- <a href="{{route('website.user.lesson',[Crypt::encrypt($order->id),Crypt::encrypt($subject->id)])}}"
          class="enroll">View Details</a> --}}
      </div>
      @if(auth()->check())
      <a href="{{route('website.course.package.subject.detatils',Crypt::encrypt($subject->id))}}" class="btn btn-primary btn-lg btn-block">Start Your Course</a>
      @else
      <a  class="btn btn-primary btn-lg btn-block">Go to Package</a>
      @endif
    </div>
  </div>
  @endif
  </div>

</section>
@endsection
@section('scripts')


@endsection