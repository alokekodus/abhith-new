@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<link href="{{asset('asset_website/css/my_account.css')}}" rel="stylesheet">
<style>
    body {
        overflow-x: hidden;
    }

    .topic {
        text-indent: 25px;
    }

    .sub-topic {
        text-indent: 30px;
    }

    #wrapper {
        padding-right: 0;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    #wrapper.toggled {
        padding-right: 250px;
    }

    #sidebar-wrapper {
        z-index: 1000;
        position: fixed;
        right: 250px;
        width: 0;
        height: 100%;
        margin-right: -250px;
        overflow-y: auto;
        background: #000;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 422px !important;
    }

    #page-content-wrapper {
        width: 100%;
        position: absolute;
        padding: 15px;
    }

    #wrapper.toggled #page-content-wrapper {
        position: absolute;
        margin-left: -250px;
    }

    /* Sidebar Styles */

    .sidebar-nav {
        position: absolute;
        top: 0;
        width: 434px;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .sidebar-nav li {
        text-indent: 20px;
        line-height: 40px;
    }

    .sidebar-nav li a {
        display: block;
        text-decoration: none;
        color: #999999;
    }

    .sidebar-nav li a:hover {
        text-decoration: none;
        color: #fff;
        background: rgba(255, 255, 255, 0.2);
    }

    .sidebar-nav li a:active,
    .sidebar-nav li a:focus {
        text-decoration: none;
    }

    .sidebar-nav>.sidebar-brand {
        height: 65px;
        font-size: 18px;
        line-height: 60px;
    }

    .sidebar-nav>.sidebar-brand a {
        color: #999999;
    }

    .sidebar-nav>.sidebar-brand a:hover {
        color: #fff;
        background: none;
    }

    @media (min-width: 768px) {
        #wrapper {
            padding-right: 0;
        }

        #wrapper.toggled {
            padding-right: 250px;
        }

        #sidebar-wrapper {
            width: 0;
        }

        #wrapper.toggled #sidebar-wrapper {
            width: 250px;
        }

        #page-content-wrapper {
            padding: 20px;
            position: relative;
        }

        #wrapper.toggled #page-content-wrapper {
            position: relative;
            margin-left: 0;
        }

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
            display: inline-block;
            font-family: 'Glyphicons Halflings';
            font-style: normal;
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
    }

    .subtopic-small-heading-black {
        font-size: 14px;
        font-weight: 700;
        color: #000;
    }

    .topic-small-heading-black {
        font-size: 16px;
        font-weight: 700;
        color: #000;
    }

    .lesson-small-heading-black {
        font-size: 18px;
        font-weight: 700;
        color: #000;
    }
</style>
@endsection

@section('content')
@include('layout.website.include.forum_header')
<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand" style="padding: 19px;">
                <a href="#">
                    <span>{{$subject->subject_name}}</span>
                </a>
            </li>
            <div class="accordion" id="accordionExample" style="background-color: white;">
                @foreach($lessons as $key=>$lesson)
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseLesson{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                    <span class="lesson-small-heading-black">{{$key+1}} . Lesson: {{$lesson->name}} </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseLesson{{$key}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body" style="background-color: white;">
                                @if($lesson->lessonAttachment!=null)
                                @if($lesson->lessonAttachment->img_url!=null)
                                <span class="topic-small-heading-black"><a id="displayAttachment" onclick="displayAttachment('imageAttach')" value="{{$lesson->id}}"><i class="fa fa-picture-o" style="font-size:18px;color:#0770EF"></i>
                                    {{$lesson->name}}</a></span><br>
                                @endif
                                @if($lesson->lessonAttachment->origin_video_url!=null)
                                <span class="topic-small-heading-black"><a onclick="displayAttachment('videoAttach')" value="{{$lesson->id}}"><i class="fa fa-play-circle" style="font-size:20px;color:#0770EF"></i> {{$lesson->name}}</span></a>
                                @endif
                                @endif
                                @foreach($lesson->topics as $topickey=>$topic)
                                <div class="panel-group topic" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" onclick="displayAttachment('content')" value="{{$topic->id}}">
                                                    <span class="topic-small-heading-black">{{$topickey+1}} .Topic: {{$topic->name}} </span>
                                                    <a onclick="displayAttachment('content')" value="{{$topic->id}}"><span class="topic-small-heading-black">{{$topic->name}}</span></a>


                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                @if($topic->lessonAttachment!=null)
                                                @if($topic->lessonAttachment->img_url!=null)
                                                <a id="displayAttachment" onclick="displayAttachment('imageAttach')" value="{{$topic->id}}"><i class="fa fa-picture-o" style="font-size:18px;color:#0770EF"></i>
                                                    {{$topic->name}}</a>
                                                @endif
                                                @if($topic->lessonAttachment->origin_video_url!=null)
                                                <a onclick="displayAttachment('videoAttach')" value="{{$topic->id}}"><i class="fa fa-play-circle" style="font-size:20px;color:#0770EF"></i> {{$topic->name}}</a>
                                                @endif
                                                @endif
                                                @foreach($topic->subTopics as $subtopickey=>$subtopic)
                                                <div class="panel-group sub-topic" id="accordion" role="tablist" aria-multiselectable="true">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingOne">
                                                            <h4 class="panel-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSubTopic{{$key}}" aria-expanded="true" aria-controls="collapseOne">
                                                                    <span class="subtopic-small-heading-black">Sub Topic: {{$subtopic->name}} </span>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseSubTopic{{$key}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                            <div class="panel-body">
                                                                <a onclick="displayAttachment('Content')" value="{{$subtopic->id}}">{{$key+1}}. {{$subtopic->name}}</a><br>

                                                                @if($subtopic->lessonAttachment!=null)
                                                                @if($subtopic->lessonAttachment->img_url!=null)
                                                                <a onclick="displayAttachment('imageAttach')" value="{{$subtopic->id}}"><i class="fa fa-picture-o" style="font-size:18px;color:#0770EF"></i>
                                                                    {{$subtopic->name}}</a><br>
                                                                @endif
                                                                @if($subtopic->lessonAttachment->origin_video_url!=null)
                                                                <a onclick="displayAttachment('videoAttach')" value="{{$subtopic->id}}"><i class="fa fa-play-circle" style="font-size:20px;color:#0770EF"></i>
                                                                    {{$subtopic->name}}</a><br>
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

                </div>
                @endforeach

            </div>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <a href="#menu-toggle" class="btn btn-secondary float-right" id="menu-toggle">{{$subject->subject_name}}
                Contents</a>
            <h1>{{$subject->subject_name}}</h1>
            <div id="Content" class="tabcontent">
                <span id="displayContent"></span>

            </div>

            <div id="imageAttach" class="tabcontent">
                <span id="displayImage"></span>
            </div>

            <div id="videoAttach" class="tabcontent">
                <video id="player" class="video-js" controls preload="auto" autoplay loop muted poster="{{asset($lesson->lessonAttachment->video_thumbnail_image)}}" loading="lazy">
                </video>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
@endsection
@section('scripts')
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
<script>
    $(document).ready(function() {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
    });

    function displayAttachment(type) {

        if (type == 'content') {
            document.getElementById("Content").style.display = "block";
            document.getElementById("imageAttach").style.display = "none";
            document.getElementById("videoAttach").style.display = "none";
        } else if (type == 'imageAttach') {
            document.getElementById("imageAttach").style.display = "block";
            document.getElementById("Content").style.display = "none";
            document.getElementById("videoAttach").style.display = "none";
        } else if (type == 'videoAttach') {
            document.getElementById("videoAttach").style.display = "block";
            document.getElementById("Content").style.display = "none";
            document.getElementById("imageAttach").style.display = "none";
        }
        var lesson_id = $("#displayAttachment").attr('value');


        $.ajax({
            type: 'POST',
            url: "{{ route('website.user.lesson.attachment') }}",
            data: {
                lesson_id: lesson_id,
                _token: '{{csrf_token()}}'
            },
            success: function(data) {
                var content = `<div class="card"><div class="card-body">
                ${data.content}
                </div>

                </div>`;
                $("#displayContent").html(content, type);

                var Image = `<img src="{{ URL::asset('${data.lesson_attachment.img_url}') }}" class="img-fluid" alt="Responsive image"
                style="height:438px;weight:73%!important;" loading="lazy">`;
                $("#displayImage").html(Image);
                if (type == "videoAttach") {
                    videoRationWiseDisplay(data);
                }



            }
        });
    }
</script>
{{-- <script>
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
</script> --}}

<script src="{{asset('asset_website/js/videojs-resolution-switcher.js')}}"></script>
<script>
    function videoRationWiseDisplay(data) {

        var lesson = data;
        var lesson_attachment = data.lesson_attachment;
        var storagePath = "{!! storage_path() !!}";
        var FULLHD = lesson_attachment['origin_video_url'];
        var SD = lesson_attachment['video_resize_480'];
        var HD = lesson_attachment['video_resize_720'];
        var player = videojs('player', {
            fluid: true,
            plugins: {
                videoJsResolutionSwitcher: {
                    default: '480px',
                    dynamicLabel: true
                }
            }
        });
        player.updateSrc([{
                src: 'http://localhost/abhith-new/public/storage/' + SD,
                type: 'video/mp4',
                res: 480,
                label: '480px'
            },
            {
                src: 'http://localhost/abhith-new/public/storage/' + HD,
                type: 'video/mp4',
                res: 720,
                label: '720px'
            },
            {
                src: 'http://localhost/abhith-new/public/storage/' + FULLHD,
                type: 'video/mp4',
                res: 1080,
                label: '1080px'
            },

        ]);
    }
</script>
@endsection
