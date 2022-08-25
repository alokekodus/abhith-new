@if($lesson->topics()->exists())


<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-pdf" role="tab"
                        aria-controls="nav-home" aria-selected="true">Document</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-video" role="tab"
                        aria-controls="nav-profile" aria-selected="false">Video</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                        aria-controls="nav-contact" aria-selected="false">Article</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-practice-test"
                        role="tab" aria-controls="nav-contact" aria-selected="false">MCQ Practice Test</a>
                </div>
            </nav>
            <br><br>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-pdf" role="tabpanel" aria-labelledby="nav-pdf-tab">


                    <div style="overflow-x:auto;">
                        <table class="table table-striped" id="lessonTable">
                            <thead>
                                <tr>
                                    <th>#No</th>
                                    <th> Lesson Name </th>
                                    <th> Recources Topics </th>
                                    <th> Type </th>
                                    <th> Recources Path </th>
                                    <th>Free Demo</th>
                                    <th> Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($lesson->topics->where('type',1) as $key=>$topic)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td> {{$topic->parentLesson->name}}</td>
                                    <td> {{$topic->name}}</td>
                                    <td> @if($topic->type==1)pdf @elseif($topic->type==2) video @else
                                        article @endif </article>
                                    </td>
                                    <td> @if($topic->type==1)<a href="{{asset($topic->lessonAttachment->img_url)}}"
                                            target="_blank">
                                            {{basename($topic->lessonAttachment->img_url)}}</a>
                                        @elseif($topic->type==2) <a
                                            href="{{asset($topic->lessonAttachment->video_origin_url)}}"
                                            target="_blank">
                                            {{ substr($topic->lessonAttachment->video_origin_url, 0,40)
                                            }}</a> @else NA @endif</td>
                                    <td>@if($topic->lessonAttachment)No @else Yes @endif</td>
                                    <td>@if($topic->status==1)Active @else InActive @endif</td>
                                    <td><a href="" title="Edit Lesson"><i class="mdi mdi-grease-pencil"></i></a>
                                        <a href="" title="View Details"><i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
                <div class="tab-pane fade" id="nav-video" role="tabpanel" aria-labelledby="nav-video-tab">

                    <div style="overflow-x:auto;">
                        <table class="table table-striped" id="lessonTableVideo">
                            <thead>
                                <tr>
                                    <th>#No</th>
                                    <th> Lesson Name </th>
                                    <th> Recources Topics </th>
                                    <th> Type </th>
                                    <th> Recources Path </th>
                                    <th> Thumbnail image </th>
                                    <th>Video Duration</th>
                                    <th>Free Demo</th>
                                    <th> Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $videocount=1; @endphp
                                @foreach($lesson->topics->where('type',2) as $key=>$topic)
                                <tr>
                                    <td>{{$videocount++}}</td>
                                    <td> {{$topic->parentLesson->name}}</td>
                                    <td> {{$topic->name}}</td>
                                    <td> @if($topic->type==1)pdf @elseif($topic->type==2) video @else
                                        article @endif </article>
                                    </td>
                                    <td> @if($topic->type==1)<a href="{{asset($topic->lessonAttachment->img_url)}}"
                                            target="_blank">
                                            {{basename($topic->lessonAttachment->img_url)}}</a>
                                        @elseif($topic->type==2) <a
                                            href="{{asset($topic->lessonAttachment->video_origin_url)}}"
                                            target="_blank">
                                            {{ substr($topic->lessonAttachment->video_origin_url, 0,40)
                                            }}</a> @else NA @endif</td>
                                    <td> @if($topic->type==2)<a
                                            href="{{asset($topic->lessonAttachment->video_thumbnail_image)}}"
                                            target="_blank">
                                            {{substr($topic->lessonAttachment->video_thumbnail_image,0,10)}}</a>
                                        @else NA @endif
                                    </td>
                                    <td>{{round($topic->lessonAttachment->video_duration, 2)}} minutes</td>
                                    <td></td>
                                    {{-- <td>@if($topic->lessonAttachment->free_demo==0)No @else Yes @endif</td> --}}
                                    <td>@if($topic->status==1)Active @else InActive @endif</td>
                                    <td><a href="" title="Edit Lesson"><i class="mdi mdi-grease-pencil"></i></a>
                                        <a href="" title="View Details"><i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped" id="lessonTableArticle">
                            <thead>
                                <tr>
                                    <th>#No</th>
                                    <th> Lesson Name </th>
                                    <th> Recources Topics </th>
                                    <th> Type </th>
                                    <th> Article </th>
                                    <th>Free Demo</th>
                                    <th> Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $articlecount=1; @endphp
                                @foreach($lesson->topics->where('type',3) as $key=>$topic)
                                <tr>
                                    <td>{{$articlecount++}}</td>
                                    <td> {{$topic->parentLesson->name}}</td>
                                    <td> {{$topic->name}}</td>
                                    <td> @if($topic->type==1)pdf @elseif($topic->type==2) video @else
                                        article @endif </article>
                                    </td>
                                    <td> {{ substr($topic->content, 0,40)}} <a href="" title="View Details"><i
                                                class="mdi mdi-eye"></i></a></td>
                                    <td></td>
                                    {{-- <td>@if($topic->lessonAttachment->free_demo==0)No @else Yes @endif</td> --}}
                                    <td>@if($topic->status==1)Active @else InActive @endif</td>
                                    <td><a href="" title="Edit Lesson"><i class="mdi mdi-grease-pencil"></i></a>
                                        <a href="" title="View Details"><i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-practice-test" role="tabpanel" aria-labelledby="nav-practice-test">
                    <div style="overflow-x:auto;">
                        <table class="table table-striped" id="lessonTableMcq">
                            <thead>
                                <tr>
                                    <th>#No</th>
                                    <th> Set Name </th>
                                    <th> Total Question </th>
                                    <th> Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lesson->Sets as $key=>$set)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td> {{$set->set_name}}</td>
                                    <td> {{$set->question->count()}}</td>
                                    <td> @if($set->is_activate==1)Active @else InActive @endif</td>
                                    {{-- <td>@if($topic->status==1)Active @else InActive @endif</td> --}}
                                    <td><a href="" title="Edit Lesson"><i class="mdi mdi-grease-pencil"></i></a>
                                        <a href="{{route('admin.view.mcq.question',Crypt::encrypt($set->id))}}"
                                            title="View Details"><i class="mdi mdi-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endif