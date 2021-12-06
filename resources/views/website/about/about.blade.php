@extends('layout.website.website')

@section('title','About')

@section('head')
@endsection

@section('content')
<section class="subheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 p0">
                <div class="subheader-image"><img src="{{asset('asset_website/img/about/banner.png')}}" class="w100"></div>
                <div class="subheader-image-desc">
                    <h2 class="heading-black">Transform your life through<br>
                        <span class="heading-blue">Abhith Siksha</span></h2>

                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-us1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 about-left">
                <p class="cross-line">
                    <span>ABOUT US</span>
                </p>
                <h2 class="heading-black">Offering The Best In Education To The World.</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                <ul class="list-inline about-list">
                    <li>
                        <span class="icon-best-learning--09"></span>
                        <h3 class="small-heading-black">Best Learning Communities</h3>
                        <p>Lorem ipsum dolor sit amet adipisicing elit, sed do eiusmod tempor.</p>
                    </li>
                    <li>
                        <span class="icon-learn-online-09"></span>
                        <h3 class="small-heading-black">Learn Courses Online</h3>
                        <p>Lorem ipsum dolor sit amet adipisicing elit, sed do eiusmod tempor</p>
                    </li>
                </ul>
            </div>
            <div class="col-lg-5 about-right">
                <div class="about-us-img">
                    <img src="{{asset('asset_website/img/about/image.png')}}" class="w100">
                </div>
            </div>
        </div>
    </div>
</section>


<section class="counter">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 p0">
                <ul class="list-inline counter-list">
                    <li>
                        <img src="{{asset('asset_website/img/about/image1.png')}}" class="w100" alt="">
                    </li>
                    <li>
                        <img src="{{asset('asset_website/img/about/image2.png')}}" class="w100" alt="">
                    </li>
                    <li>
                        <p class="cross-line3">
                            <span>Who We Are</span>
                        </p>
                        <h2 class="heading-white">Who We Are</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat</p>
                        <div id="projectFacts">
                            <div class="">
                                <div class="projectFactsWrap ">
                                    <div class="item" data-number="12">
                                        <span class="number-icon icon1"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                        <p id="number1" class="number">3045</p>
                                        <p>Student enroll</p>
                                    </div>
                                    <div class="item" data-number="55">
                                        <span class="number-icon icon2"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                        <p id="number2" class="number">10690</p>
                                        <p>Available Courses</p>
                                    </div>
                                    <div class="item" data-number="359">
                                        <span class="number-icon icon3"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                        <p id="number3" class="number">8963</p>
                                        <p>Available Courses</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section class="moto">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 p0">
                <ul class="list-inline moto-list">
                    <li>
                        <div class="moto-image"><img src="{{asset('asset_website/img/about/mission.png')}}" class="w100" alt=""></div>
                        <h2 class="heading-black">Mission</h2>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis
                            et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                            Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed quia non numquam eius modi tempora
                            incidunt ut labore et dolore magnam aliquam quaerat voluptatem</p>
                    </li>
                    <li>
                        <div class="moto-image"><img src="{{asset('asset_website/img/about/vision.png')}}" class="w100" alt=""></div>
                        <h2 class="heading-black">Vision</h2>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque
                            laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis
                            et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam
                            voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                            consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.
                            Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet,
                            consectetur, adipisci velit, sed quia non numquam eius modi tempora
                            incidunt ut labore et dolore magnam aliquam quaerat voluptatem</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
    $.fn.jQuerySimpleCounter = function(options) {
        var settings = $.extend({
            start: 0,
            end: 100,
            easing: 'swing',
            duration: 400,
            complete: ''
        }, options);

        var thisElement = $(this);

        $({
            count: settings.start
        }).animate({
            count: settings.end
        }, {
            duration: settings.duration,
            easing: settings.easing,
            step: function() {
                var mathCount = Math.ceil(this.count);
                thisElement.text(mathCount);
            },
            complete: settings.complete
        });
    };


    $('#number1').jQuerySimpleCounter({
        end: 3045,
        duration: 2000
    });
    $('#number2').jQuerySimpleCounter({
        end: 10690,
        duration: 2000
    });
    $('#number3').jQuerySimpleCounter({
        end: 8963,
        duration: 2000
    });
</script>
@endsection
