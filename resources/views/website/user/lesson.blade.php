@extends('layout.website.website')
@php
$prefix = Request::route()->getPrefix();
@endphp

@section('title', 'My Account')

@section('head')
<link href="{{asset('asset_website/css/my_account.css')}}" rel="stylesheet">

<style>
  .panel-default>.panel-heading {
    color: #333;
    background-color: #fff;
    border-color: #e4e5e7;
    padding: 0;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .panel-default>.panel-heading a {
    display: block;
    padding: 10px 15px;
  }

  .panel-default>.panel-heading a:after {
    content: "";
    position: relative;
    top: 1px;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    float: right;
    transition: transform .25s linear;
    -webkit-transition: -webkit-transform .25s linear;
  }

  .panel-default>.panel-heading a[aria-expanded="true"] {
    background-color: #eee;
  }

  .panel-default>.panel-heading a[aria-expanded="true"]:after {
    content: "\2212";
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
  }

  .panel-default>.panel-heading a[aria-expanded="false"]:after {
    content: "\002b";
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
  }

  .panel-default>.topic-panel-heading {
    position: relative;
    color: #333;
    background-color: #fff;
    border-color: #e4e5e7;
    left: 40px;
    width: 95%;
    padding: 0;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .panel-default>.topic-panel-heading a {
    display: block;
    padding: 10px 15px;
  }

  .panel-default>.topic-panel-heading a:after {
    content: "";
    position: relative;
    top: 1px;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    float: right;
    transition: transform .25s linear;
    -webkit-transition: -webkit-transform .25s linear;
  }



  .panel-default>.topic-panel-heading a[aria-expanded="true"]:after {
    content: "\2212";
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
  }

  .panel-default>.topic-panel-heading a[aria-expanded="false"]:after {
    content: "\002b";
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
  }

  /* //subtopic */
  .panel-default>.subtopic-panel-heading {
    position: relative;
    color: #333;
    background-color: #fff;
    border-color: #e4e5e7;
    left: 55px;
    width: 93%;
    padding: 0;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }

  .panel-default>.subtopic-panel-heading a {
    display: block;
    padding: 10px 15px;
  }

  .panel-default>.subtopic-panel-heading a:after {
    content: "";
    position: relative;
    top: 1px;
    font-weight: 400;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    float: right;
    transition: transform .25s linear;
    -webkit-transition: -webkit-transform .25s linear;
  }



  .panel-default>.subtopic-panel-heading a[aria-expanded="true"]:after {
    content: "\2212";
    -webkit-transform: rotate(180deg);
    transform: rotate(180deg);
  }

  .panel-default>.subtopic-panel-heading a[aria-expanded="false"]:after {
    content: "\002b";
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
  }

  /* video js css */
  .video-js {
    height: 280px;
    width: 365px;
    top: 0%;
    border-style: double;
    border-width: thick;
    border-color: black;
  }

  .video-js .vjs-play-progress {
    background-color: #007bff;
  }

  
</style>


@endsection

@section('content')
@if($prefix=='/account')
@include('layout.website.include.forum_header')
@endif
<section class="account-section">

  @include('common.subject.details')


</section>
@endsection
@section('scripts')
<script src="{{asset('asset_website/js/videojs.watermark.js')}}"></script>
<script src="{{asset('asset_website/js/videojs-resolution-switcher.js')}}"></script>
<script>
  $(document).ready(function() {
    var myPlayer = videojs('player');
   });
   
  
</script>

@endsection