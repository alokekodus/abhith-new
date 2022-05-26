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
                {{-- <video autoplay id="attachment-video" class="video-js vjs-big-play-centered" controls
                    preload="auto" width="640" height="264" poster="{{asset($lesson->lessonAttachment->img_url)}}"
                    data-setup='{
                        "fluid": true
                    }' muted="muted">
                    <source autoplay src="{{asset('storage/'.$lesson->lessonAttachment->origin_video_url)}}"
                        type="video/mp4" class="video-js vjs-theme-city" />

                    <p class="vjs-no-js">
                        <a href="{{asset('storage/'.$lesson->lessonAttachment->origin_video_url)}}"
                            target="_blank">supports HTML5 video</a>
                    </p>
                </video> --}}
                <video id="player" class="video-js vjs-default-skin" controls preload="none" autoplay loop muted
                    width="640" height="264" poster="{{asset($lesson->lessonAttachment->img_url)}}">
                </video>
                @else
                <img src="{{asset($lesson->lessonAttachment->img_url)}}" class="img-fluid" alt="Responsive image">
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="{{asset('asset_website/js/videojs-resolution-switcher.js')}}"></script>

<script>
        var lesson=@json($lesson);
        var lesson_attachment=lesson['lesson_attachment'];
        var storagePath = "{!! storage_path() !!}";
        var FULLHD= lesson_attachment['origin_video_url'] ;
        var SD= lesson_attachment['video_resize_480'] ;
        var HD= lesson_attachment['video_resize_720'] ;
        var player = videojs('player', {
        fluid: true,
        plugins: {
            videoJsResolutionSwitcher: {
            default: 'low',
            dynamicLabel: true
            }
        }
        });
        player.updateSrc([
        {
            src: 'http://localhost/abhith-new/public/storage/'+SD,
            type: 'video/mp4',
            res: 480,
            label: 'SD'
        },
        {
            src: 'http://localhost/abhith-new/public/storage/'+HD,
            type: 'video/mp4',
            res: 720,
            label: 'HD'
        },
            {
            src: 'http://localhost/abhith-new/public/storage/'+FULLHD,
            type: 'video/mp4',
            res: 1080,
            label: 'FULLHD'
        },
        ])
</script>

@endsection