@extends('layout.website.website')

@section('title','Cart')

@section('head')

@endsection

@section('content')
<section class="cart">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="heading-black mb0">Cart({{$countCartItem}})</h2>
            </div>
        </div>
    </div>
</section>

<section class="selected-course">
    <div class="container-fluid" id="cart-container">
        <div class="course-subject">
            <div class="course-subject-header d-flex justify-content-between">
                <div class="course-subject-div d-flex">
                    <div class="board">
                        <p>Board</p>
                        <h3>SEBA</h3>
                    </div>
                    <div class="class">
                        <p>Class</p>
                        <h3>Class 9</h3>
                    </div>
                    <div class="course-type">
                        <p>Course Type</p>
                        <h3>Full Course</h3>
                    </div>
                </div>
                <div class="coursePrice">
                    <h3><i class="fa fa-inr mr-2" aria-hidden="true"></i>3499</h3>
                </div>
                
            </div>
        </div>
        <div class="subjectDetails mt-3">
            <p>Subjects</p>
            <h5>Mathematics, History, English, Social Science, Computer Science, Dance, Fine Arts</h5>
        </div>
        <div class="way-to-cart d-flex">
            <div class="remove-cart mr-4">
                <a href="">Remove</a>
            </div>
            <div class="go-to-cart">
                <a href="{{route('website.cart.details')}}">Go to Cart</a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')

@endsection