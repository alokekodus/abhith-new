@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<link href="{{asset('asset_website/css/my_account.css')}}" rel="stylesheet">
<style>
    <style>* {
        box-sizing: border-box
    }

    body {
        font-family: "Lato", sans-serif;
    }

    /* Style the tab */
    .tab {
        float: left;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        width: 25%;
        height: 440px;
    }

    /* Style the buttons inside the tab */
    .tab button {
        display: block;
        background-color: inherit;
        color: black;
        padding: 22px 16px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current "tab button" class */
    .tab button.active {
        background-color: #0770EF;
    }

    /* Style the tab content */
    .tabcontent {
        float: left;
        border: 1px solid #ccc;
        width: 75%;
        border-left: none;
        height: 440px;
    }

    .subheader1-img img {
       
        width: 100%;
        object-fit: cover;
    }
    .topic-details-section {
    margin: 0px 21px;
    /* padding: 20px 0px; */
    }
</style>

@endsection

@section('content')
@include('layout.website.include.forum_header')
<br><br><br>
<section class="subheader1">
   
        <div class="row">
            <div class="col-lg-6">
                <div class="subheader1-desc">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">{{$lesson->board->exam_board}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Class{{$lesson->assignClass->class}}-&nbsp; <i
                                    class="fa fa-level-down" aria-hidden="true"></i></li>
                        </ol>
                    </nav>
                    <h2 class="heading-white"><span style="font-size:12px;">
                    {{$lesson->assignSubject->subject_name}}:  {{$lesson->name}}</span></h2>
                    <p></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="subheader1-img"><img
                        src="{{asset($lesson->lessonAttachment->img_url)}}"
                        class="w100" style="opacity: 0.6">
                    <a href="{{asset('/storage/'.$lesson->lessonAttachment->origin_video_url)}}"
                        data-fancybox="images" data-fancybox-group="image-gallery">
                        <i class="fa fa-play-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        
    
</section>
<section class="course-describtion">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline course-desc-list">
                   <h4 data-brackets-id="12020" class="small-heading-black mb20"><h5>{!!$lesson->content!!}</h5>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" data-toggle="modal" data-target="#sharePostModal" style="display:inline;font-size:12px;">
                                <i class="fa fa-share" aria-hidden="true"></i> &nbsp; Share
                            </a>
                    </h4>   
                </ul>
            </div>
        </div>
    </div>
 </section>
<section class="topic-details-section">
    <div class="container-fluid">
        <div class="tab">
            @foreach($lesson->topics as $topic)
            <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">{{$topic->name}}</button>
            @endforeach
        </div>

        <div id="London" class="tabcontent">
            <div class="card">
                <div class="card-body">
                    {!!$lesson->content!!}
                </div>

            </div>

        </div>

        <div id="Paris" class="tabcontent">
            <img src="{{asset($lesson->lessonAttachment->img_url)}}" class="img-fluid" alt="Responsive image"
                style="height:438px;weight:73%!important; ">
        </div>

        <div id="Tokyo" class="tabcontent">
            <video id="player" class="video-js" controls preload="auto" autoplay loop muted
                poster="{{asset($lesson->lessonAttachment->img_url)}}">
            </video>
        </div>

    </div>
</section>


@endsection
@section('scripts')
<script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
    
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
<script src="{{asset('asset_website/js/videojs-resolution-switcher.js')}}"></script>

<script>
    var lesson=@json($lesson);
        var lesson_attachment=lesson['lesson_attachment'];
        var storagePath = "{!! storage_path() !!}";
        var FULLHD= lesson_attachment['origin_video_url'] ;
        var SD= lesson_attachment['video_resize_480'] ;
        var HD= lesson_attachment['video_resize_720'] ;
        var player = videojs('player', {
        fluid: true,
        plugins: {
            videoJsResolutionSwitcher: {
            default: '480px',
            dynamicLabel: true
            }
        }
        });
        player.updateSrc([
        {
            src: 'http://localhost/abhith-new/public/storage/'+SD,
            type: 'video/mp4',
            res: 480,
            label: '480px'
        },
        {
            src: 'http://localhost/abhith-new/public/storage/'+HD,
            type: 'video/mp4',
            res: 720,
            label: '720px'
        },
            {
            src: 'http://localhost/abhith-new/public/storage/'+FULLHD,
            type: 'video/mp4',
            res: 1080,
            label: '1080px'
        },
        
        ])
</script>
@endsection