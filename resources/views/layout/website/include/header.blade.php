@php
    use App\Models\Cart;
    use Illuminate\Support\Facades\Auth;
    if(Auth::check()){
        $cart_items = Cart::where('user_id',Auth::user()->id)->where('is_paid', 0)->where('is_remove_from_cart', 0)->count();
    }
@endphp


<div class="top-header">
    <div class="container-fluid">
        <div class="row  g-1">
            <div class="col-lg-3 col-8 header-text">HELPING CREATE SUCCESS</div>
            <div class="col-lg-3 col-3">
                <ul class="list-inline header-social  mb0">
                    <li><a href="#"><span class="icon-facebook-07 header-social-icon"></span></a></li>
                    <li><a href="#"><span class="icon-linkdin-07 header-social-icon"></span></a></li>
                    <li><a href="#"><span class="icon-twitter-07 header-social-icon"></span></a></li>
                    <li><a href="#"><span class="icon-instagram-07 header-social-icon"></span></a></li>
                </ul>
            </div>
            @auth
            <div class="col-lg-6  col-sm-12">
                <ul class="list-inline login-details">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle login-text" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="icon-user-08 login-details-icon"><span class="path1"></span><span class="path2"></span><span class="path3"></span></span>{{Auth::user()->firstname}}<span class="caret"></span></a>
                        <ul class="dropdown-menu account-list">
                            <li class="ac-list"><a href="{{route('website.user.account')}}" class="login-text1">My Account</a></li>
                            <li class="ac-list">
                                <form action="{{route('website.auth.logout')}}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-default" style="margin-left:-10px;color:black;font-weight:500;border:none;font-size:13px;">Sign Out</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('website.cart')}}" class="login-text"><span class="icon-cart-08 login-details-icon"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></span>Cart ( {{ $cart_items }} )</a>                            
                    </li>
                </ul>
            </div>
            @endauth
            @guest
                <div class="col-lg-6 col-12">
                    <ul class="list-inline login-details">
                        <li>
                            <a href="{{route('website.login')}}" class="login-text" target="_parent"><i class="fa fa-user" aria-hidden="true"></i>  Login/Sign Up</a>
                        </li>
                        <li>
                            <a href="{{route('teacher.login')}}" class="login-text" target="_parent"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Become a Teacher &nbsp;</a>
                        </li>
                        
                        <li>
                            <a href="{{route('website.cart')}}" class="login-text"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Cart</a>
                        </li>
                    </ul>

                </div>
            @endguest
        </div>
    </div>
</div>
