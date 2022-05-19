<div class="card" id="headingOne">
    <div class="card-header">
        <h5 class="mb-0">
            All Topics
        </h5>

    </div>
</div>
<div id="accordion">

    @foreach($lesson->topics as $key=>$topic)
    <div class="card" id="headingOne">
        <div class="card-header">
            <h5 class="mb-0">
                <button class="" data-toggle="collapse" data-target="#collapseOne{{$key}}" aria-expanded="true"
                    aria-controls="collapseOne">
                    <li>{{$topic->name}}[Sub Topic:{{$topic->subTopics->count()}}]
                        <span style="float: right;"><a
                                href="{{route('admin.course.management.lesson.subtopic.create',[$lesson->slug,$topic->slug])}}"><i
                                    class="mdi mdi-plus-outline"></i></a></span>
                    </li>

                </button>

            </h5>
        </div>

        <div id="collapseOne{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                @if($topic->content!=null) <h5></h5> {!!$topic->content!!}@endif<br>
                <div class="row">
                    @if($topic->image_url!=null)
                    <div class="video-gallery">
                        <figure class="gallery-item">
                            <img src="{{asset($topic->image_url)}}" alt="image" />
                            <figcaption>
                                <div>
                                    <h6>{{$topic->name}}</h6>

                                </div>
                                <a class="vimeo-popup"
                                    href="{{route('admin.course.management.lesson.attachment',[Crypt::Encrypt($topic->id),Crypt::Encrypt(1)])}}">View
                                    more</a>
                            </figcaption>
                        </figure>
                    </div>
                    @endif
                    @if($topic->video_url!=null)
                    <div class="video-gallery">
                        <figure class="gallery-item">
                            <img src="{{asset($topic->image_url)}}" alt="Editor Reel" />
                            <figcaption>
                                <div>
                                    <h6>{{$topic->name}}</h6>

                                </div>
                                <a class="vimeo-popup"
                                    href="{{route('admin.course.management.lesson.attachment',[Crypt::Encrypt($topic->id),Crypt::Encrypt(2)])}}">View
                                    more</a>
                            </figcaption>
                        </figure>
                    </div>
                    
                    @endif
                </div>
                <hr>
                @if($topic->subTopics()->exists())
                <h4><u>Sub Topics:</u></h4>
                <ol>
                    @foreach($topic->subTopics as $key=>$sub_topics)
                    <li>{{$sub_topics->name}}</li>
                    <div class="row">
                        @if($sub_topics->image_url!=null)
                        <div class="video-gallery">
                            <figure class="gallery-item">
                                <img src="{{asset($sub_topics->image_url)}}" alt="image" />
                                <figcaption>
                                    <div>
                                        <h6>{{$sub_topics->name}}</h6>
    
                                    </div>
                                    <a class="vimeo-popup"
                                        href="{{route('admin.course.management.lesson.attachment',[Crypt::Encrypt($sub_topics->id),Crypt::Encrypt(1)])}}">View
                                        more</a>
                                </figcaption>
                            </figure>
                        </div>
                        <hr>
                        @endif
                        @if($sub_topics->video_url!=null)
                        <div class="video-gallery">
                            <figure class="gallery-item">
                                <img src="{{asset($sub_topics->image_url)}}" alt="Editor Reel" />
                                <figcaption>
                                    <div>
                                        <h6>{{$sub_topics->name}}</h6>
    
                                    </div>
                                    <a class="vimeo-popup"
                                        href="{{route('admin.course.management.lesson.attachment',[Crypt::Encrypt($sub_topics->id),Crypt::Encrypt(2)])}}">View
                                        more</a>
                                </figcaption>
                            </figure>
                        </div>
                        <hr>
                        @endif
                    </div>
                    <hr>
                    @endforeach
                </ol>
                @endif
            </div>

        </div>
    </div>
    @endforeach

</div>