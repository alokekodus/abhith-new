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
            <button class="lessonLinks" onclick="openFile(event, 'videos')" id="defaultOpen" >5 Videos</button>
            <button class="lessonLinks" onclick="openFile(event, 'articles')" >12 Articles</button>
            <button class="lessonLinks" onclick="openFile(event, 'documents')" >10 Documents</button>
        </div>
    </div>
    <div class="topic-content mb-5">
        <div class="topic-content-heading">
            <h2>Topic: Crossword Clues for Testing</h2>
        </div>
        <div class="topic-content-body">
            <div class="container lessonContent" id="videos">
                <div class="topic-content-sub-heading mt-4">
                    <h3>Videos</h3>
                </div>
                <div class="row">     
                    @php
                        $test = 5;    
                    @endphp        
                    @for ($i = 0; $i < $test; $i++)
                        <div class="col-lg-4 col-md-6">
                            <div class="card video-lesson-pic">
                                <img src="{{asset('asset_website/img/course/image1.png')}}" alt="">
                                <div class="video-lesson-overlay">
                                    <a href="" class="btn btn-default video-lesson-overlay-eye-icon"><i class="fa fa-play-circle-o" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            <div class="video-lesson-text">
                                <p>Lorem ipsum dolor sit amet.</p>
                            </div>
                        </div>
                    @endfor 
                </div>
            </div>
    
            <div class="container lessonContent" id="articles">
                <div class="topic-content-sub-heading mt-4">
                    <h3>Articles</h3>
                </div>
                <div class="row"> 
                    @php
                        $test = 12;    
                    @endphp
                    @for ($i = 0; $i < $test; $i++)
                        <div class="article-div d-flex">
                            <div class="article-img">
                                <img src="{{asset('asset_website/img/docs.png')}}" alt="">
                            </div>
                            <div class="article-content">
                                <h5>Giving kids and teens a safer experience online</h5>
                                <p>Monday, 30 May 2022, 10:21 AM</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
    
            <div class="container lessonContent" id="documents">
                <div class="topic-content-sub-heading mt-4">
                    {{-- <h3>Documents</h3> --}}
                </div>
                <div class="row">
                    {{-- @php
                        $test = 8;    
                    @endphp
                    @for ($i = 0; $i < $test; $i++)
                        
                    @endfor --}}
                    <div class="document-content">
                        <h2>Lesson Web Designing Start</h2>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Velit aut veniam eum neque, sed ullam magni cum recusandae dicta atque et nihil repellendus porro maxime quibusdam commodi quaerat? Doloribus, maxime.</p>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione tempore impedit est neque officiis eius ipsum laudantium quaerat doloribus ad quam hic dolorum, voluptates architecto dolore vel voluptatibus quisquam, fuga fugit sint, magni veritatis tempora. Nihil voluptates aliquam, ea, maxime optio laudantium molestias commodi dolore necessitatibus quis sint dignissimos harum!</p>
                    </div>
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