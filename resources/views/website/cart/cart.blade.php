@extends('layout.website.website')

@section('title','Cart')

@section('head')

@endsection

@section('content')
<section class="cart">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="heading-black mb0">Cart({{$carts->count()}})</h2>
            </div>
        </div>
    </div>
</section>

<section class="selected-course">
    @foreach($carts as $key=>$cart)
    <div class="container-fluid" id="cart-container" style="margin-bottom:15px;">
        <div class="course-subject">
            <div class="course-subject-header d-flex justify-content-between">
                <div class="course-subject-div d-flex">
                    <div class="board">
                        <p>Board</p>
                        <h5>{{$cart->board->exam_board}}</h5>
                    </div>
                    <div class="class">
                        <p>Class</p>
                        <h5>{{$cart->assignClass->class}}</h5>
                    </div>
                    <div class="course-type">
                        <p>Course Type</p>
                        <h5>@if($cart->is_full_course_selected)Full Package @else Custom Package @endif</h5>
                    </div>
                </div>
                <div class="coursePrice">
                    <h3><i class="fa fa-inr mr-2" aria-hidden="true"></i>{{$cart->assignSubject->sum('amount')}}</h3>
                </div>
                
            </div>
        </div>
        <div class="subjectDetails mt-3">
            <p>Subjects</p>
            <h5>@foreach($cart->assignSubject as $key=> $assign_subject) {{$assign_subject->subject->subject_name}} 
                 @endforeach</h5>
        </div>
        <div class="way-to-cart d-flex">
            <div class="remove-cart mr-4">
                <a href="">Remove</a>
            </div>
            <div class="go-to-cart">
                <a href="{{route('website.cart.details',Crypt::encrypt($cart->id))}}">Purchase</a>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection

@section('scripts')

@endsection