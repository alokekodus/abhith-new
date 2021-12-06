@extends('layout.website.website')

@section('title','Cart')

@section('head')
<style>
    .bold-600{
        font-weight: 600;
    }

    .btn-bg-main{
        background-image: linear-gradient(to left, #076fef, #01b9f1);
        border: none;
        color: #fff
    }
    
    .shipping-btn:hover{
        background: #111;
        color: #fff;
    }
</style>
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

<section class="cart-describtion">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <ul class="list-inline cart-course-list1">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>    
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>    
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @forelse ($cart as $item)
                    <li>
                        <div class="cart-course-image1"><img src="{{asset($item->course->course_pic)}}" style="height:50px;width:70px;"></div>
                        <div class="cart-course-desc">
                            <h6 data-brackets-id="12020">Chapter: {{$item->chapter->name}}</h6>
                            <p>Course: {{$item->course->name}}</p>
                            {{-- <div class="dropdown course-tooltip">
                                <button class="dropbtn">Course Item Details<span><i class="fa fa-info-circle ml5" aria-hidden="true"></i></span></button>
                                <div class="dropdown-content box arrow-top">
                                    <div class="scrollbar" id="style-1">
                                        <div class="force-overflow">
                                            <h6>Lessons</h6>
                                            <ul class="list-inline tooltip-course-list">
                                                <li>
                                                    <span class="star"><i class="fa fa-star" aria-hidden="true"></i></span>{{$item->chapter->name}}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <span class="course-price2" id="itemPrice"><i class="fa fa-inr" aria-hidden="true"></i>{{$item->chapter->price}}</span>
                            <div class="mt10"><a href="#" class="remove removeCartItem" data-id="{{$item->chapter_id}}">Remove</a></div>
                        </div>
                    </li>
                    @empty
                        <h4 class="text-center pb-3">Cart empty !</h4>
                    @endforelse
                </ul>
                <div class="shipping-div text-center"><a href="{{route('website.course')}}" class="shipping-btn">Continue Enrolling</a></div>
                
            </div>
            <div class="col-lg-4">
                @auth   
                    <div class="cart-checkout">
                        <label class="bold-600">Total:</label>
                        <h2 class="heading-black mb20"><i class="fa fa-inr" aria-hidden="true"></i>{{ $countPrice}}</h2>
                        @if ($countPrice == 0)
                            <a href="javascript:void(0)" class="btn btn-block btn-secondary bold-600" disabled>Checkout</a>
                        @else
                            <button class="btn btn-block knowledge-link-new checkoutBtn" data-checkout="{{$countPrice}}">Checkout</button>
                        @endif
                    </div>
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection
 
@section('scripts')
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('.removeCartItem').on('click',function(e){
        $.ajax({
            url:"{{route('website.remove-from-cart')}}",
            type:"POST",
            data:{
                '_token' : "{{csrf_token()}}",
                'chapter_id' : $(this).data('id'),
            },
            success:function(result){
                toastr.success(result.message);
                location.reload(true);
            },
            error:function(xhr, status, error){
                if(xhr.status == 500 || xhr.status == 422){
                    toastr.error('Something Went Wrong');
                }
            }
        });
    });


    $('.checkoutBtn').on('click',function(e){
        let checkoutPrice = $(this).data('checkout');

        if(checkoutPrice > 500000){
            toastr.error('At a time user can checkout with a maximum amount of Rs 5,00,000.');
        }else{
            window.location.href="{{route('website.checkout')}}";
        }

    });

</script>
@endsection
