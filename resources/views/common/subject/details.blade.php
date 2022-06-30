<div class="container-fluid">
    <p class="cross-line">
        <h2 class="heading-black">{{$subject->subject_name}}</h2>
    </p>
    <div class="row">

        <div class="col-lg-8 col-md-12 courseLeftBox order-2 order-lg-1 order-md-2 order-sm-1">
            
            <p class="cross-line">
                <span>Description</span>
            </p>
            <p class="cross-line">
                <h5 class="desc-text">{!!$subject->description!!}</h5>
            </p>
            <p class="cross-line">
                <span>{{$subject->subject_name}} All Content</span>
            </p>
            @include('common.lesson.content')
        </div>

        <div class="col-lg-4 col-md-12 courseRightBlock order-1 order-lg-2 order-md-1 order-sm-2">
            <video id="player" class="video-js" controls preload="auto" autoplay loop muted
                poster="{{asset($subject->subjectAttachment->video_thumbnail_image)}}" loading="lazy">
            </video>
            <div class="course-desc">
                <h4 class="small-heading-black">{{$subject->subject_name}}</h4>
                <span>Created by : Demo Teacher</span><br>
                <span></i>Total Lesson:
                    {{$subject->lesson->count()}}</span>
                {{-- <a href="{{route('website.user.lesson',[Crypt::encrypt($order->id),Crypt::encrypt($subject->id)])}}"
                    class="enroll">View Details</a> --}}
            </div>
            @if(auth()->check())
            <a href="{{route('website.course.package.subject.detatils',Crypt::encrypt($subject->id))}}"
                class="btn btn-primary btn-lg btn-block">Start Your Course</a>
            @else
            <a class="btn btn-primary btn-lg btn-block">Go to Package</a>
            @endif
        </div>
    </div>
</div>


<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-8 col-md-12">
            
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h5 class="panel-title">
                            <a  href="{{route('website.subject.mcq',Crypt::encrypt($subject->id))}}" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseLesson"
                                aria-expanded="true" aria-controls="collapseLesson">
                                <i class="more-less glyphicon glyphicon-plus"></i>
                                ALL MCQ'S QUESTION SET
                            </a>
                        </h5>
                    </div>
                </div>
            </div><!-- panel-group -->
        </div>
    </div>
</div>


<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8">
            <ul class="nav nav-tabs">
                <!-- <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#teacher">
                        <h4 class="small-heading-black">Teacher</h4>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#whylearn">
                        <h4 class="small-heading-black">What you'll learn</h4>
                    </a>
                </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">                
                <div class="tab-pane container fade" id="whylearn">
                    <h6> {!!$subject->why_learn!!} </h6>
                </div>
            </div>
        </div>
    </div>
</div>
