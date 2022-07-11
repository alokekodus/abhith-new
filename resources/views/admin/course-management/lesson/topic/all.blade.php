<div id="accordion">
    @foreach($lesson->topics as $key=>$topic)
    <div class="card p-2" id="headingOne">
        <div class="card-header">
            <h5 class="mb-0">
                <button class="" data-toggle="collapse" data-target="#collapseOne{{$key}}" aria-expanded="true"
                    aria-controls="collapseOne">
                    <div>
                        {{$key+1}} .{{$topic->name}}[Sub Topic:{{$topic->subTopics->count()}}]
                        <span style="float: right;"><a
                                href="{{route('admin.course.management.lesson.subtopic.create',[$lesson->slug,$topic->slug])}}"><i
                                    class="mdi mdi-plus-outline"></i></a></span>
                    </div>


                </button>

            </h5>
        </div>

        <div id="collapseOne{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                @if($topic->type==1)
                <embed src="{{ asset(getlessonAttachment($lesson->id)['url_name']) }}#toolbar=0" width="100%"
                    height="500" alt="pdf" />
                @elseif($topic->type==2)

                @else
                {!!$topic->content!!}
                @endif

            </div>
            <hr>
            @if($topic->subTopics()->exists())
            <h4><u>Sub Topics:</u></h4>
            <ol>
                @foreach($topic->subTopics as $key=>$sub_topics)

                @endforeach
            </ol>
            @endif


        </div>
    </div>
    @endforeach

</div>