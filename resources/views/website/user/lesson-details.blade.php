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
    height: 480px;
    margin-right: -250px;
    background: #000;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
    overflow: scroll;
  }

  #wrapper.toggled #sidebar-wrapper {
    width: 451px !important;
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

  .lesson-attach {
    position: relative;
    left: 38px;
  }

  .content-div {
    width: 100%;
    height: 750px;
    margin: 1em;
    border: 12px solid black;
    background-color: #000;
  }

  .tabcontent::after {
    content: "";
    clear: both;
    display: block;
    width: 100%;
    height: 50%;
    margin-left: auto;
    margin-right: auto;

  }

  #image {
    display: block;
    margin-left: auto;
    margin-right: auto;
    border: 8px ridge black;
    padding: 5px;
  }

  .vjs-watermark {
    bottom: 0px;
    right: 0px;
    opacity: 100;
    position: absolute;
    top: 9px;
    background-color: #999999;
    height: 60px;
  }
</style>
@endsection

@section('content')
@include('layout.website.include.forum_header')
  @include('common.subject.start')
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

    function displayAttachment(type,lessonId) {

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

        var lesson_id = lessonId;

         
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
                $("#displayContent").html(content,type);

                var Image = `<img src="{{ URL::asset('${data.lesson_attachment.img_url}') }}" class="img-fluid" alt="Responsive image"
                id ="image" width="800" height="800" loading="lazy">`;
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
<script src="{{asset('asset_website/js/videojs.watermark.js')}}"></script>
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
        player.watermark({
            file: 'http://localhost/abhith-new/public/asset_website/img/home/logo.png',
            xpos: 100,
            ypos: 100,
            xrepeat: 0,
            opacity: 0.5,
        });
    }
</script>
@endsection