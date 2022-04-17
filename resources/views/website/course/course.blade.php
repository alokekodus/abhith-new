@extends('layout.website.website')

@section('title','Courses')

@section('content')

<section class="subheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 p0">
                <div class="subheader-image"><img src="{{asset('asset_website/img/course/banner.png')}}" class="w100"></div>
                <div class="subheader-image-desc">
                    <h2 class="heading-black">Our Courses<br>
                        <span class="heading-blue">Study Beyond The Classroom</span></h2>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-courses">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                <h2 class="heading-black">All Courses</h2>
            </div>
            <div class="col-lg-5 p0">
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label" style="font-size:15px; font-weight:bold;">Select Board</label>
                    <div class="col-sm-9">
                      <select class="form-control">
                        <option value=''>-- select --</option>
                        @forelse ($boards as $item)
                            <option>{{$item->exam_board}}</option>
                        @empty
                            <option>No boards to show</option>
                        @endforelse
                      </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 p-0">
                <ul class="list-inline courses-list">
                    {{-- @foreach ($publishCourse as $item) --}}
                    <li>
                        <div class="course-pic"><img src="{{asset('asset_website/img/course/banner.png')}}" class="w100"></div>
                        <div class="course-desc"><span class="icon-clock-09 clock-icon">
                            {{-- </span><span>{{$item['duration']}}</span> --}}
                            <div class="block-ellipsis5"><h4 class="small-heading-black">Class 1</h4></div>
                            {{-- <span>₹{{$item['final_price']}}</span> --}}
                            <a href="#"  class="enroll">Enroll Now</a>
                        </div>
                    </li>

                    {{-- @endforeach --}}
                </ul>
                {{-- <div style="float:right;margin-top:10px;">
                    {{$publishCourse->links()}}
                </div>--}}
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')

<script>
    // const select = document.querySelectorAll('.selectBtn');
    // const option = document.querySelectorAll('.option');
    // let index = 1;

    // select.forEach(a => {
    //     a.addEventListener('click', b => {
    //         const next = b.target.nextElementSibling;
    //         next.classList.toggle('toggle');
    //         next.style.zIndex = index++;
    //     })
    // })
    // option.forEach(a => {
    //     a.addEventListener('click', b => {
    //         b.target.parentElement.classList.remove('toggle');

    //         const parent = b.target.closest('.course-select').children[0];
    //         parent.setAttribute('data-type', b.target.getAttribute('data-type'));
    //         parent.innerText = b.target.getAttribute('data-type');
    //     })
    // })
</script>

@endsection
