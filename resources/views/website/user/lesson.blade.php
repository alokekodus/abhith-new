@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<link href="{{asset('asset_website/css/my_account.css')}}" rel="stylesheet">



@endsection

@section('content')
{{-- @include('layout.website.include.forum_header') --}}
<br>
<section class="account-section">
 
    <div class="col-5">
      <div id="accordion">
        @foreach($lessons as $key=>$lesson)
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
               {{$lesson->name}}
              </button>
            </h5>
          </div>

          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
             
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="col-7">

    </div>
  
</section>
@endsection
@section('scripts')


@endsection