@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<style>
    * {
        scrollbar-width: thin;
        scrollbar-color: rgb(190, 190, 190) rgb(238, 237, 236);
    }

    /* Works on Chrome, Edge, and Safari */
    *::-webkit-scrollbar {
        width: 10px;
    }

    *::-webkit-scrollbar-track {
        background: rgb(238, 237, 236);
    }

    *::-webkit-scrollbar-thumb {
        background-color: rgb(190, 190, 190);
        border-radius: 20px;
        border: 3px solid rgb(231, 231, 230);
    }
</style>
@endsection

@section('content')

@include('layout.website.include.forum_header')

<div class="lesson-details-main-div">
    <div class="lesson-details-sidebar">
        <div class="lesson-sidebar-btn">
            <button class="lessonLinks" onclick="openFile(event, 'videos')" id="defaultOpen">{{$topicVideos->count()}}
                Videos</button>
            <button class="lessonLinks" onclick="openFile(event, 'articles')"> {{$topicArticles->count()}}
                Articles</button>
            <button class="lessonLinks" onclick="openFile(event, 'documents')">{{$topicDocuments->count()}}
                Documents</button>
            <button class="lessonLinks" onclick="openFile(event, 'mcq_test')">{{$mcq_questions->Sets()->count()}}
                MCQ Test</button>
        </div>
    </div>
    <div class="topic-content mb-5">
        <div class="topic-content-heading">
            <h2>Topic: {{$lesson->name}}</h2>
        </div>
        <div class="topic-content-body">
            <div class="container lessonContent" id="videos">
                <div class="topic-content-sub-heading mt-4">
                    <h3>Videos</h3>
                </div>
                <div class="row">
                    @if($topicVideos->count()>0)
                    @foreach ($topicVideos as $key=>$video)
                    <div class="col-lg-4 col-md-6">
                        <div class="card video-lesson-pic">
                            <img src="{{asset($video->lessonAttachment->video_thumbnail_image)}}" alt="">
                            <div class="video-lesson-overlay">
                                <a href="" class="btn btn-default video-lesson-overlay-eye-icon"><i
                                        class="fa fa-play-circle-o" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="video-lesson-text">
                            <p>{{$video->name}}</p>
                        </div>
                    </div>
                    @endforeach
                    @else
                    @endif

                </div>
            </div>

            <div class="container lessonContent" id="articles">
                <div class="topic-content-sub-heading mt-4">
                    <h3>Articles</h3>
                </div>
                <div class="row">
                    @if($topicArticles->count()>0)
                    @foreach ($topicArticles as $key=>$article)
                    <div class="col-lg-6 col-md-6">
                        <div class="article-div d-flex">
                            <div class="article-icon">
                                <i class="fa fa-file-text" aria-hidden="true"></i>
                            </div>
                            <div class="article-content">
                                <h5>{{$article->name}}</h5>
                                <p>{{dateFormat($article->created_at,"D,F j, Y")}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    @endif
                </div>
            </div>

            <div class="container lessonContent" id="documents">
                <div class="topic-content-sub-heading mt-4">
                    <h3>Documents</h3>
                </div>
                <div class="row">
                    @if($topicDocuments->count()>0)
                    @foreach ($topicDocuments as $key=>$document)
                    <div class="col-lg-6 col-md-6">
                        <div class="doc-div">
                            <div class="doc-icon">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                            </div>
                            <div class="doc-content">
                                <h5>{{$document->name}}</h5>
                                <p>{{dateFormat($document->created_at,"D ,F j, Y")}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    @endif
                </div>
            </div>

            <div class="container lessonContent" id="mcq_test">
                <div class="topic-content-sub-heading mt-4">
                    <h3>MCQ Test</h3>
                </div>
                <div class="row">
                    @if($mcq_questions->Sets()->count()>0)
                    @foreach ($mcq_questions->Sets as $key=>$set)
                    <div class="col-lg-6 col-md-6">
                        <div class="mcq-div">
                            <div class="mcq-icon">
                               <img src="{{asset('asset_website/img/mcq.png')}}" alt="">
                            </div>
                            <div class="mcq-content">
                                <h5><a href="{{route('website.subject.mcqstart',Crypt::encrypt($set->id))}}">{{$set->set_name}}</a></h5>
                                <h6>{{$set->question->count()}} Questions</h6>
                                <p>{{dateFormat($set->created_at,"D ,F j, Y")}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openFile(evt, fileName) {
        let i, lessonContent, lessonLinks;
        lessonContent = document.getElementsByClassName("lessonContent");
        for (i = 0; i < lessonContent.length; i++) {
            
            lessonContent[i].style.display = "none";
        }
        lessonLinks = document.getElementsByClassName("lessonLinks");
        for (i = 0; i < lessonLinks.length; i++) {
            lessonLinks[i].className = lessonLinks[i].className.replace(" active", "");
        }
        document.getElementById(fileName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
</script>


@endsection