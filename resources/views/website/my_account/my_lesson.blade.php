@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<style>
    .sidebar {
        position: sticky;
        top: 150px;
    }
    @import url("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
    table{
        border: 1px solid #f3f3f3;
        border-radius: 10px;
        box-shadow: 0px 5px 5px #efecec;
    }
    th{
        border-top:0px !important;
    }
    #purchase_history_table_filter{
        margin-top:-40px;
    }
    #forum-search-bar{
        display:none;
    }
</style>

@endsection

@section('content')
@include('layout.website.include.forum_header')

<section class="account-section">
    <div class="container-fluid">
     <div class="row">
        <div class="accordion" id="accordionExample">
            @foreach($all_lessons as $key=>$lesson)
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$lesson->id}}" aria-expanded="true" aria-controls="collapseOne">
                   {{$lesson->name}}
                  </button>
                </h2>
              </div>
          
              <div id="collapse{{$lesson->id}}" class="collapse @if($key==0) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  Some placeholder content for the first accordion panel. This panel is shown by default, thanks to the <code>.show</code> class.
                </div>
              </div>
            </div>
            @endforeach
             
          </div>
     </div>
    </div>
</section>

@endsection


