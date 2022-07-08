@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Lesson Details')
@section('content')
<style>
    .lesson-image {
        height: 200px;
        width: 150px;
    }

    .scroll {
        overflow-y: scroll;
        max-height: 600px;
        background-color: #fff;

    }

    .scroll::-webkit-scrollbar {
        width: 5px;
    }

    .scroll::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
    }

    .scroll::-webkit-scrollbar-thumb {
        border-radius: 5px;
        -webkit-box-shadow: inset 0 0 6px red;
    }

    img {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        width: 150px;
    }

    img:hover {
        box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
    }

    /**, 
*:after, *:before { -webkit-box-sizing: border-box; box-sizing: border-box; } 
// required */
    .video-gallery figure {
        position: relative;
        float: left;
        overflow: hidden;
        margin: 10px 1%;

        max-width: 200px;
        max-height: 150px;


        background: #000;
        text-align: center;
        cursor: pointer;
    }

    .video-gallery figure img {
        position: relative;
        display: block;
        min-height: 100%;
        max-width: 100%;
        opacity: 0.8;
    }

    .video-gallery figure figcaption {
        padding: 2px;
        color: #fff;
        text-transform: uppercase;
        font-size: 8px;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .video-gallery figure figcaption::before,
    .video-gallery figure figcaption::after {
        pointer-events: none;
    }

    .video-gallery figure figcaption,
    .video-gallery figure figcaption>a {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* Anchor will cover the whole item by default */
    .video-gallery figure figcaption>a {
        z-index: 1000;
        text-indent: 200%;
        white-space: nowrap;
        font-size: 0;
        opacity: 0;
    }

    .video-gallery figure h2 {
        word-spacing: -0.15em;
        font-weight: 300;
    }

    .video-gallery figure h2 span {
        font-weight: 800;
    }

    .video-gallery figure h2,
    .video-gallery figure p {
        margin: 0;
    }

    .video-gallery figure p {
        letter-spacing: 1px;
        font-size: 8px;
    }

    /* Individual effects */


    /*----------------------*/
    /***** gallery-item *****/
    /*----------------------*/

    figure.gallery-item {
        background: #000;
    }

    figure.gallery-item img {
        max-width: none;
        width: -webkit-calc(100% + 20px);
        width: calc(100% +20px);
        -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
        transition: opacity 0.35s, transform 0.35s;
        -webkit-transform: translate3d(-10px, 0, 0);
        transform: translate3d(-10px, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    figure.gallery-item:hover img {
        opacity: 0.4;

    }

    figure.gallery-item figcaption {
        text-align: left;
    }

    figure.gallery-item h6 {
        position: relative;
        overflow: hidden;
        padding: 0.5em 0;
    }

    figure.gallery-item h6::after {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: #fff;
        content: '';
        -webkit-transition: -webkit-transform 0.35s;
        transition: transform 0.35s;
        -webkit-transform: translate3d(-100%, 0, 0);
        transform: translate3d(-100%, 0, 0);
    }

    figure.gallery-item:hover h6::after {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    figure.gallery-item p {
        padding: 1em 0;
        opacity: 0;
        -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
        transition: opacity 0.35s, transform 0.35s;
        -webkit-transform: translate3d(100%, 0, 0);
        transform: translate3d(100%, 0, 0);
    }

    figure.gallery-item:hover p {
        opacity: 1;
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    @media screen and (max-width: 50em) {
        .video-gallery figure {
            display: inline-block;
            float: none;
            margin: 10px auto;
            width: 100%;
        }
    }
</style>
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> Lesson Details
    </h3>
</div>
<div class="card">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <b>Lesson Name:</b> {{$lesson->name}}
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card">
                    <div class="card-body">
                        <embed src="{{ asset(getlessonAttachment($lesson->id)['url_name']) }}#toolbar=0" width="100%"
                            height="500" alt="pdf" />

                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        All Topics
                        <a href="{{route('admin.course.management.lesson.topic.create',Crypt::encrypt($lesson->id))}}"
                            class="btn btn-gradient-primary p-2" title="Add New Topic" style="float: right;"><i
                                class="mdi mdi-plus"></i> Add Topics</a>
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="card">

                        <div class="card-body" style="padding: 0.2rem 0.2rem">
                            @if($lesson->topics()->exists())
                            @include('admin.course-management.lesson.topic.all')
                            @else
                            <div class="card">


                                Topic Not Added yet


                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.video-gallery').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'iframe',
        // other options
           gallery:{
          enabled:true
        }
      });
      });
</script>
@endsection