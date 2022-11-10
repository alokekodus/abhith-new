@extends('layout.website.website')

@section('title', 'My Course')

@section('head')
@endsection

@section('content')

@include('layout.website.include.forum_header')
@section('content')
<div class="container-fluid">
    
        <h3 class="text-center">{{$data->lesson->name}}</h3>
  

    {{-- <video poster="{{ asset($video->video_thumbnail_image) }}" controls style="width: 100%;">
        <source src="{{ asset($video->video_origin_url) }}" type="video/mp4">
        Your browser does not support the video tag.
    </video> --}}
    <video id="player" class="video-js" controls preload="auto" autoplay loop muted
        poster="{{ asset($data->video_thumbnail_image) }}" loading="lazy">
    </video>
</div>
@endsection
@section('scripts')
<script src="{{asset('asset_website/js/videojs.watermark.js')}}"></script>
<script src="{{asset('asset_website/js/videojs-resolution-switcher.js')}}"></script>
<script>
    $(document).ready(function() {
    var myPlayer = videojs('player');
   });
   
  
</script>
<script>
    var lesson_attachment=@json($data);
        var storagePath = "{!! storage_path() !!}";
        var FULLHD= lesson_attachment['origin_video_url'] ;
        var SD= lesson_attachment['video_resize_480'] ;
        var HD= lesson_attachment['video_resize_720'] ;
        var player = videojs('player', {
        fluid: true,
        plugins: {
            videoJsResolutionSwitcher: {
            default: '480px',
            dynamicLabel: true
            }
        }
        });
        player.updateSrc([
        {
            src: 'http://localhost/abhith-new/public'+SD,
            type: 'video/mp4',
            res: 480,
            label: '480px'
        },
        {
            src: 'http://localhost/abhith-new/public'+HD,
            type: 'video/mp4',
            res: 720,
            label: '720px'
        },
            {
            src: 'http://localhost/abhith-new/public'+FULLHD,
            type: 'video/mp4',
            res: 1080,
            label: '1080px'
        },
        
        ]);
        // player.watermark({
        //     file: 'http://localhost/abhith-new/public/asset_website/img/home/logo_.png',
           
        // });
</script>
@endsection