<!-- Sidebar -->
<div id="wrapper">
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
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseLesson{{$key}}"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    <span class="lesson-small-heading-black">{{$key+1}} . Lesson: {{$lesson->name}}
                                    </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseLesson{{$key}}" class="panel-collapse collapse in" role="tabpanel"
                            aria-labelledby="headingOne">
                            <div class="panel-body" style="background-color: white;">

                                <a class="topic-small-heading-black lesson-attach"
                                    onclick="displayAttachment('content',{{$lesson->id}})"
                                    value="{{$lesson->id}}"><span>{{$lesson->name}}</span></a><br>

                                @if($lesson->lessonAttachment!=null)
                                @if($lesson->lessonAttachment->img_url!=null)
                                <span class="topic-small-heading-black lesson-attach"><a id="displayAttachment"
                                        onclick="displayAttachment('imageAttach',{{$lesson->id}})"><i
                                            class="fa fa-picture-o" style="font-size:18px;color:#0770EF"></i>
                                        {{$lesson->name}}</a></span><br>
                                @endif
                                @if($lesson->lessonAttachment->origin_video_url!=null)
                                <span class="topic-small-heading-black lesson-attach"><a
                                        onclick="displayAttachment('videoAttach',{{$lesson->id}})"><i
                                            class="fa fa-play-circle" style="font-size:20px;color:#0770EF"></i>
                                        {{$lesson->name}}</span></a>
                                @endif
                                @endif
                                @foreach($lesson->topics as $topickey=>$topic)
                                <div class="panel-group topic" id="accordion" role="tablist"
                                    aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne"
                                                    onclick="displayAttachment('Content',{{$topic->id}})"
                                                    value="{{$topic->id}}">
                                                    <span class="topic-small-heading-black">{{$topickey+1}} .Topic:
                                                        {{$topic->name}} </span>
                                                    <a class="topic-small-heading-black lesson-attach"
                                                        onclick="displayAttachment('Content',{{$topic->id}})"><span>{{$topic->name}}</span></a>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                            aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                @if($topic->lessonAttachment!=null)
                                                @if($topic->lessonAttachment->img_url!=null)
                                                <a class="topic-small-heading-black lesson-attach"
                                                    id="displayAttachment"
                                                    onclick="displayAttachment('imageAttach',{{$topic->id}})"
                                                    value="{{$topic->id}}"><i class="fa fa-picture-o"
                                                        style="font-size:18px;color:#0770EF"></i>
                                                    {{$topic->name}}</a><br>
                                                @endif
                                                @if($topic->lessonAttachment->origin_video_url!=null)
                                                <a class="topic-small-heading-black lesson-attach"
                                                    onclick="displayAttachment('videoAttach',{{$topic->id}})"><i
                                                        class="fa fa-play-circle"
                                                        style="font-size:20px;color:#0770EF"></i>
                                                    {{$topic->name}}</a>
                                                @endif
                                                @endif
                                                @foreach($topic->subTopics as $subtopickey=>$subtopic)
                                                <div class="panel-group sub-topic" id="accordion" role="tablist"
                                                    aria-multiselectable="true">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingOne">
                                                            <h4 class="panel-title">
                                                                <a data-toggle="collapse" data-parent="#accordion"
                                                                    href="#collapseSubTopic{{$key}}"
                                                                    aria-expanded="true" aria-controls="collapseOne">
                                                                    <span class="subtopic-small-heading-black">Sub
                                                                        Topic: {{$subtopic->name}} </span>
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseSubTopic{{$key}}"
                                                            class="panel-collapse collapse in" role="tabpanel"
                                                            aria-labelledby="headingOne">
                                                            <div class="panel-body">
                                                                <a class="topic-small-heading-black lesson-attach"
                                                                    onclick="displayAttachment('Content',{{$subtopic->id}}">{{$key+1}}.
                                                                    {{$subtopic->name}}</a><br>

                                                                @if($subtopic->lessonAttachment!=null)
                                                                @if($subtopic->lessonAttachment->img_url!=null)
                                                                <a class="topic-small-heading-black lesson-attach"
                                                                    onclick="displayAttachment('imageAttach',{{$subtopic->id}})"><i
                                                                        class="fa fa-picture-o"
                                                                        style="font-size:18px;color:#0770EF"></i>
                                                                    {{$subtopic->name}}</a><br>
                                                                @endif
                                                                @if($subtopic->lessonAttachment->origin_video_url!=null)
                                                                <a class="topic-small-heading-black lesson-attach"
                                                                    onclick="displayAttachment('videoAttach',{{$subtopic->id}}"><i
                                                                        class="fa fa-play-circle"
                                                                        style="font-size:20px;color:#0770EF"></i>
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
            <div class="content-div">
                <div id="Content" class="tabcontent">
                    <span id="displayContent"></span>

                </div>

                <div id="imageAttach" class="tabcontent">
                    <span id="displayImage"></span>
                </div>

                <div id="videoAttach" class="tabcontent">
                    <video id="player" class="video-js" controls preload="auto" autoplay loop muted
                        poster="{{asset($lesson->lessonAttachment->video_thumbnail_image)}}" loading="lazy">
                    </video>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>