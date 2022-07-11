@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Lesson Details')
@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> Lesson Details
    </h3>
</div>
<div class="card">
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <b>Lesson Name:</b> {{$lesson->name}}
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card">
                    <div class="card-body">
                        @if(getlessonAttachment($lesson->id)!=null)
                        <embed src="{{ asset(getlessonAttachment($lesson->id)['url_name']) }}#toolbar=0" width="100%"
                            height="500" alt="pdf" />
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        All Topics
                        <a href="{{route('admin.course.management.lesson.topic.create',Crypt::encrypt($lesson->id))}}"
                            class="btn btn-gradient-primary p-2" title="Add New Topic" style="float: right;"><i
                                class="mdi mdi-plus"></i> Add Topics</a>
                    </button>
                </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="card">

                        <div class="card-body" style="padding: 0.2rem 0.2rem">
                            @if($lesson->topics()->exists())
                            @include('admin.course-management.lesson.topic.all')
                            @else
                            Topic Not Added yet
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.video-gallery').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'iframe',
        // other options
           gallery:{
          enabled:true
        }
      });
      });
</script>
@endsection