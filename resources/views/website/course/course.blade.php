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
                        <div class="input-group">
                            <select class="form-control" name="board" id="board">
                                <option value=''>-- select --</option>
                                @forelse ($boards as $item)
                                    <option value="{{$item->id}}">{{$item->exam_board}}</option>
                                @empty
                                    <option>No boards to show</option>
                                @endforelse
                              </select>
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" type="button">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 p-0">
                <ul class="list-inline courses-list">
                    @forelse ($subjects as $item)
                        <li>
                            <div class="course-pic"><img src="{{asset($item->image)}}" class="w100" style="object-fit: cover; object-position:top;"></div>
                            <div class="course-desc">
                                <i class="fa fa-dashcube"></i>
                                <span>{{$item->boards->exam_board}} Board</span>
                                <div class="block-ellipsis5"><h4 class="small-heading-black">Class {{$item->assignClass->class}} {{$item->subject_name}}</h4></div>
                                {{-- <span>₹{{$item['final_price']}}</span> --}}
                                <a href="#"  class="enroll">Enroll Now</a>
                            </div>
                        </li>
                    @empty
                        <div class="text-center">
                            No course to show
                        </div>
                    @endforelse
                </ul>
                {{-- <div style="float:right;margin-top:10px;">
                    {{$subjects->links()}}
                </div> --}}
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')

<script>

    $('#board').on('change', function(){
        if($(this).val() == ''){
            // toastr.error('Select board');
        }else{
            let board_id = $(this).val();

            $.ajax({
                url:"{{route('website.course')}}",
                type:"get",
                data:{
                    '_token' : "{{csrf_token()}}",
                    'board_id' : board_id
                },
                success:function(data){
                    console.log(data);
                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Whoops! Something went wrong. Failed to fetch course');
                    }
                }
            });
        }
    });
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
