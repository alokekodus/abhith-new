<div class="row">
    <div class="container demo">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach($subject->lesson as $key=>$lesson)
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h5 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion"
                            href="#collapseLesson{{$key}}" aria-expanded="true"
                            aria-controls="collapseLesson{{$key}}">
                            <i class="more-less glyphicon glyphicon-plus"></i>
                            {{$key+1}}. Lesson : {{$lesson->name}}  
                        </a>
                        
                    </h5>
                </div>
                <div id="collapseLesson{{$key}}" class="panel-collapse collapse show" role="tabpanel"
                    aria-labelledby="headingOne">
                    <div class="panel-body">

                        {{-- All topic --}}
                        @foreach($lesson->topics as $topickey=>$topic)
                        <div class="container demo">


                            <div class="panel-group" id="accordion" role="tablist"
                                aria-multiselectable="true">

                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h5 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseTopic{{$topickey}}" aria-expanded="true"
                                                aria-controls="collapseTopic{{$topickey}}">
                                                <i class="more-less glyphicon glyphicon-plus"></i>
                                                {{$topickey+1}} . Topic Name : {{$topic->name}}
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseTopic{{$topickey}}" class="panel-collapse collapse"
                                        role="tabpanel" aria-labelledby="headingOne">
                                        <div class="panel-body">



                                        </div>
                                    </div>
                                </div>

                            </div><!-- panel-group -->


                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div><!-- panel-group -->


    </div>
</div>
