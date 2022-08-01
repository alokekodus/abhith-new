<div class="container-fluid">
    <p class="cross-line">
    <h2 class="heading-black">{{$subject->boards->exam_board}} > Class {{$subject->assignClass->class}} >
        {{$subject->subject_name}}</h2>
    </p>
    <div class="row">

        <div class="col-md-12 courseLeftBox order-2 order-lg-1 order-md-2 order-sm-1">

            <p class="cross-line">
                <span>All Content</span>
            </p>
            <div class="row">
                <div class="container">
                    <div class="panel-group subject-content" id="accordion" role="tablist" aria-multiselectable="true">
                        @foreach($subject->lesson as $key=>$lesson)
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h5 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseLesson{{$key}}" aria-expanded="false"
                                        aria-controls="collapseLesson{{$key}}">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        {{$key+1}}. Lesson : {{$lesson->name}}
                                    </a>

                                </h5>
                            </div>

                            <div id="collapseLesson{{$key}}" class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="headingOne">
                                <div class="panel-body" style="position:relative; left:40px;">

                                    @if($lesson->type==1)
                                    <i class="fa fa-file" aria-hidden="true"></i>
                                    <a href="{{$lesson->lessonAttachment->img_url}}" data-fancybox="pdf"
                                        data-caption="This image has a caption 2">
                                        {{$lesson->name}}
                                    </a><br>
                                    @elseif($lesson->type==2)
                                    <i class="fa fa-play" aria-hidden="true"></i> {{$lesson->name}}<br>
                                    @else
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i> {{$lesson->name}}<br>
                                    @endif
                                    @if($lesson->topics->count()>0)
                                    @foreach($lesson->topics as $key=>$topic)
                                    <u>{{$key+1}}. {{$topic->name}}</u><br>
                                    @if($topic->type==1)
                                    <i class="fa fa-file" aria-hidden="true"></i> {{$topic->name}}<br>
                                    @elseif($topic->type==2)
                                    <i class="fa fa-play" aria-hidden="true"></i> {{$topic->name}}<br>
                                    @else
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i> {{$topic->name}}<br>
                                    @endif
                                    @if($topic->subTopics->count()>0)
                                    @foreach($topic->subTopics as $key=>$sub_topic)
                                    @if($sub_topic->type==1)
                                    <i class="fa fa-file" aria-hidden="true"></i> {{$sub_topic->name}}<br>
                                    @elseif($sub_topic->type==2)
                                    <i class="fa fa-play" aria-hidden="true"></i> {{$sub_topic->name}}<br>
                                    @else
                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i> {{$sub_topic->name}}<br>
                                    @endif
                                    @endforeach
                                    @endif
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div><!-- panel-group -->


                </div>
            </div>
        </div>
    </div>
    @if($subject->sets->where('is_activate',1)->count()>0)
    <div class="row">

        <div class="col-md-12 courseLeftBox order-2 order-lg-1 order-md-2 order-sm-1">

            <p class="cross-line">
                <span>MCQ question-answer</span>
            </p>
            <div class="row">
                <div class="container">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h5 class="panel-title">
                                    <a href="{{route('website.subject.mcq',Crypt::encrypt($subject->id))}}"
                                        role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapseLesson" aria-expanded="true" aria-controls="collapseLesson">
                                        <i class="more-less glyphicon glyphicon-plus"></i>
                                        ALL MCQ'S QUESTION SET
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseLesson" class="panel-collapse collapse show" role="tabpanel"
                                aria-labelledby="headingOne">
                                <div class="panel-body" style="position:relative; left:40px;">
                                    @foreach($subject->sets as $key=>$set)
                                    <a href="{{route('website.subject.mcqstart',Crypt::encrypt($set->id))}}"><i class="fa fa-file" aria-hidden="true"></i> &nbsp; {{$set->set_name}} <span
                                        class="badge badge-info">Total Questions:
                                        {{$set->question->where('is_activate',1)->count()}}</span></a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    @endif
</div>