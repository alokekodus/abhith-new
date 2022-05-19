@extends('layout.admin.layout.admin')
@section('title', 'Lesson - Attachment')
@section('head')
<style>
    .attachment-video-dimensions {
        width: 938px;
        height: 525px;
    }
</style>
@endsection
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span>
    </h3>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if($attachment_extension=="mp4")
                <video autoplay id="attachment-video" class="video-js vjs-big-play-centered" controls preload="auto"
                    width="640" height="264" poster="{{asset($lesson->image_url)}}" data-setup="{}" muted="muted">
                    <source autoplay src="{{asset($lesson->video_url)}}" type="video/mp4"
                        class="video-js vjs-theme-city" />

                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="{{asset($lesson->video_url)}}" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
                @else
                <img src="{{asset($lesson->image_url)}}" class="img-fluid" alt="Responsive image">
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.getElementById('attachment-video').play();
</script>
<script>
    var player = videojs('attachment-video', {
    fluid: false,
    autoplay: true,
  });
</script>
@endsection