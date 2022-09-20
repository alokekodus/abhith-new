@extends('layout.website.website')

@section('title','Cart')

@section('head')
<style>
    .bold-600 {
        font-weight: 600;
    }

    .btn-bg-main {
        background-image: linear-gradient(to left, #076fef, #01b9f1);
        border: none;
        color: #fff
    }

    .shipping-btn:hover {
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
                {{-- <ul class="list-inline cart-course-list1">
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
                    @include('website.cart.cart-items')
                    @empty
                        <h4 class="text-center pb-3">Cart empty !</h4>
                    @endforelse
                </ul>
                <div class="shipping-div text-center"><a href="{{route('website.course')}}" class="shipping-btn">Continue Enrolling</a></div> --}}
                <div class="cart-course d-flex justify-content-between">
                    <p class="courseName">SEBA - Class 9</p>
                    <p>Full Course</p>
                </div>
                <div class="cart-course-description d-flex justify-content-between">
                    <div class="subject-div d-flex">
                        <div class="subject-img mr-3">
                            <img src="{{asset('asset_website/img/image.jpg')}}" alt="">
                        </div>
                        <div class="subjectName">
                            <h4>Maths</h4>
                            <p>34 Lessons</p>
                            <a href="#">View</a>
                        </div>
                    </div>
                    <div class="price-div">
                        <p><i class="fa fa-inr mr-2" aria-hidden="true"></i>3499</p>
                    </div>
                </div>
                <div class="cart-course-description d-flex justify-content-between">
                    <div class="subject-div d-flex">
                        <div class="subject-img mr-3">
                            <img src="{{asset('asset_website/img/image.jpg')}}" alt="">
                        </div>
                        <div class="subjectName">
                            <h4>Maths</h4>
                            <p>34 Lessons</p>
                            <a href="#">View</a>
                        </div>
                    </div>
                    <div class="price-div">
                        <p><i class="fa fa-inr mr-2" aria-hidden="true"></i>3499</p>
                    </div>
                </div>
                <div class="cart-course-description d-flex justify-content-between">
                    <div class="subject-div d-flex">
                        <div class="subject-img mr-3">
                            <img src="{{asset('asset_website/img/image.jpg')}}" alt="">
                        </div>
                        <div class="subjectName">
                            <h4>Maths</h4>
                            <p>34 Lessons</p>
                            <a href="#">View</a>
                        </div>
                    </div>
                    <div class="price-div">
                        <p><i class="fa fa-inr mr-2" aria-hidden="true"></i>3499</p>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-4">
                @auth   
                    <div class="cart-checkout">
                        {{-- <label class="bold-600">Total:</label>
                        <h2 class="heading-black mb20"><i class="fa fa-inr" aria-hidden="true"></i> {{number_format($countPrice,2,'.','')}}</h2>
                        <label class="bold-600">Apply Promo Code If Any Available:</label> --}}
                        <div class="checkout-details d-flex justify-content-between">
                            <p class="checkout-details-text">Course Price</p>
                            <p><i class="fa fa-inr mr-2" aria-hidden="true"></i>3499</p>
                        </div>
                        <div class="checkout-details d-flex justify-content-between">
                            <p class="checkout-details-text">Discount</p>
                            <p>
                                <span class="mr-1 font-weight-bold">-</span>
                                <i class="fa fa-inr mr-2" aria-hidden="true"></i>200</p>
                        </div>
                        <div class="checkout-details d-flex justify-content-between">
                            <p class="checkout-details-text">Tax</p>
                            <p><i class="fa fa-inr mr-2" aria-hidden="true"></i>50</p>
                        </div>
                        <div class="total-price d-flex justify-content-between">
                            <p class="checkout-details-text">Total</p>
                            <p><i class="fa fa-inr mr-2" aria-hidden="true"></i>3349</p>
                        </div>
                        @if ($countPrice == 0)
                            <a href="javascript:void(0)" class="btn btn-block btn-secondary bold-600" disabled>Checkout</a>
                        @else
                            <button class="btn btn-block knowledge-link-new checkoutBtn" id="checkoutBtn" data-checkout="{{number_format($countPrice,2,'.','')}}">Checkout</button>
                        @endif
                    </div>
                @endauth
                @auth
                    <a href="#" class="cart-coupon d-flex justify-content-between">
                        <p class="coupon-text">
                            <img src="{{asset('asset_website/img/coupun.png')}}" class="mr-2" alt="">Apply Coupon
                        </p>
                        <p class="coupon-arrow">
                            <img src="{{asset('asset_website/img/arrow.png')}}" alt=""></p>
                    </a>
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
                'cart_id' : $(this).data('id'),
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


    $('#checkoutBtn').on('click',function(e){
      
        let checkoutPrice = $(this).data('checkout');

        if(checkoutPrice > 500000){
            toastr.error('At a time user can checkout with a maximum amount of Rs 5,00,000.');
        }else{
          
            window.location.href="{{route('website.checkout')}}";
        }

    });

</script>
@endsection