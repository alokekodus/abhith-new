@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<link href="{{asset('asset_website/css/my_account.css')}}" rel="stylesheet">
<style>
    .scroll {
        overflow-y: scroll;
        max-height: 400px;
        background-color: #fff;

    }

    .scroll::-webkit-scrollbar {
        width: 5px;
    }

    .scroll::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        border-radius: 5px;
    }

    .scroll::-webkit-scrollbar-thumb {
        border-radius: 5px;
        -webkit-box-shadow: inset 0 0 6px #076fef;
    }
</style>
@endsection

@section('content')
@include('layout.website.include.forum_header')
<br>
<section class="account-section">
    <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-4">
                <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
                    
                    <ul class="list-group">
                        <a href="#submenu1" data-toggle="collapse" aria-expanded="false"
                            class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-start align-items-center">
                                <span class="fa fa-dashboard fa-fw mr-3"></span>
                                <span class="menu-collapsed">{{$lesson->name}}</span>
                                <span class="submenu-icon ml-auto"></span>
                            </div>
                        </a>
                        <div id='submenu1' class="collapse sidebar-submenu">
                            @foreach($lesson->topics as $key=>$topic)
                            <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                                <span class="menu-collapsed">{{$topic->name}}</span>
                            </a>
                            @endforeach

                        </div>
                    </ul>
                </div>
            </nav>
            <div class="col-sm-9 col-8" id="myScrollspy">
                <div class="card">
                    <div class="card-body">
                        {!!$lesson->content!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection