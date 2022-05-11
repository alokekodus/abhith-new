<div class="card">
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            All Topics
        </h5>

    </div>
</div>
<div id="accordion">

    @foreach($lesson->topics as $key=>$topic)
    <div class="card">
        <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne">
                    <li>{{$topic->name}}[Sub Topic:{{$topic->subTopics->count()}}]
                        <span style="float: right;"><a
                                href="{{route('admin.course.management.lesson.subtopic.create',[$lesson->slug,$topic->slug])}}"><i
                                    class="mdi mdi-plus-outline"></i></a></span>
                    </li>

                </button>

            </h5>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                @if($topic->content!=null) <h5><u>Content:</u></h5> {{ substr(strip_tags($topic->content), 0, 100)
                }}...@endif<br>
                @if($topic->image_url!=null)
                <i id="displayImage" class="mdi mdi-file-image" data-toggle="modal" data-id="{{$topic->id}}"
                    data-value="{{$topic->image_url}}" data-target="#displayImageModal"></i>
                @endif
                @if($topic->video_url!=null)
                <i id="displayVideo" class="mdi mdi-video" data-toggle="modal" data-id="{{$topic->id}}"
                    data-value="{{$topic->video_url}}" data-target="#displayVideoModal"></i>
                @endif
                <hr>
                @if($topic->subTopics()->exists())
                <h4><u>Sub Topics:</u></h4>
                <ol>
                    @foreach($topic->subTopics as $key=>$sub_topics)
                    <li>{{$sub_topics->name}}</li>
                    @if($sub_topics->image_url!=null)
                    <i id="displayImage" class="mdi mdi-file-image" data-toggle="modal" data-id="{{$sub_topics->id}}"
                        data-value="{{$sub_topics->image_url}}" data-target="#displayImageModal"></i>
                    @endif
                    @if($sub_topics->video_url!=null)
                    <i id="displayVideo" class="mdi mdi-video" data-toggle="modal" data-id="{{$sub_topics->id}}"
                        data-value="{{$sub_topics->video_url}}" data-target="#displayVideoModal"></i>
                    @endif
                    <hr>
                    @endforeach
                </ol>
                @endif
            </div>

        </div>
    </div>
    @endforeach

</div>