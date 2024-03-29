@extends('layout.website.website')

@section('title', 'Home')

@section('head')
    <style>
        .home-slide::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            border-radius: 20px;
            background: rgba(1, 1, 1, 0.3)
        }

        .btn-outline-white{
            border: 1px solid #fff;
            color: #fff;
        }        
        
        .btn-outline-white:hover{
            color: rgb(124, 124, 124);
        }

        .heading-black1{
            color: #fff;
            font-size: 33px;
            font-weight: 700;
        }

        .owl-carousel .owl-stage-outer{
            border-radius: 20px;
        }

    </style>
@endsection

@section('content')

    <section class="home-banner" style="border-radius: 20px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p0">
                    <div class="owl-slider">
                        <div id="carousel-banner" class="owl-carousel" style="border-radius: 20px">
                            @foreach ($banner as $item)
                                <div class="item" style="border-radius: 20px">
                                    <div class="home-slide"><img src="{{ asset($item->banner_image) }}"
                                            style="border-radius: 20px" class="w100"></div>
                                    <div class="home-desc">
                                        <h2 class="heading-black1 mb-4">{!! $item->name !!}</h2>
                                        {{-- <p class="banner-para">{!! $item->description !!}</p> --}}
                                        @if ($item->course_id != null)
                                            <div><a href="{{ route('website.course.details', ['id' => \Crypt::encrypt($item->course_id)]) }}"
                                                    target="_blank" class="btn btn-outline-white">View More</a></div>
                                        @endif
                                    </div>
                                </div>

                            @endforeach
                            {{-- <div class="item">
                            <div class="home-slide"><img src="{{asset('asset_website/img/home/banner1.png')}}" class="w100"></div>
                            <div class="home-desc">
                                <h2 class="heading-black">Find the Best Courses &amp;
                                    Upgrade Your Skills.</h2>
                                <p class="banner-para">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                <div><a href="about.html" target="_blank" class="about-view">View More</a></div>
                            </div>
                        </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="about-us">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 about-left">
                    <p class="cross-line">
                        <span>ABOUT US</span>
                    </p>
                    <h2 class="heading-black">Learning Beyond Limits</h2>
                <p>With a rapid increase in technology and anything being available at just a click away, people are becoming more inclined towards modern technological gadgets. The digital urgency has proved to be a boon for society as a whole.</p>
                <p>Learning has invariably expanded its horizons and has carved a niche for itself in the larger scenario. The advent of a more learner-centric, skill-based approach has eventually led to the rise of a platform for learners online. </p>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="icon-best-learning--09" style="font-size: 35px"></span>
                                    <h3 class="small-heading-black">Best Learning Communities</h3>
                                    <p>Abith Siksha is an interactive learning platform created to improve student engagement and teacher efficiency. Join millions of learners from around the world, find the right instructor for you, choose from many topics, skill levels, and languages.</p>
                                </div>
        
                                <div class="col-md-6">
                                    <span class="icon-learn-online-09" style="font-size: 35px"></span>
                                <h3 class="small-heading-black">Learn Courses Online</h3>
                                <p>Unlimited access to a wide range of courses, specializations, and certifications. Earn recognition for every learning program that you complete.  </p>
                                </div>
                            </div>
                        </div>
                    <div><a href="{{ route('website.about') }}" target="_blank" class="about-view">View More</a></div>
                </div>
                <div class="col-lg-5 about-right">
                    <div class="enquiry-form">
                        <h3 class="form-heading mb0">Enquiry</h3>
                        <div class="form-div">
                            <form id="enquiryFormSubmit">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Name" id="name" maxlength="30" pattern="^[a-zA-Z]+\s?[a-zA-Z]+\s?[a-zA-Z]+" title="Only alphabets are accepted. Space between word allowed is 2" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone Number" id="phone" pattern="(0|91)?[6-9][0-9]{9}" title="Phone number should start with 6 or 7 or 8 or 9 and 10 chars long. ( e.g 7896845214)" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="Email Id" id="email" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a valid email address." required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" rows="5" name="message" placeholder="Enquiry reason" id="message" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-block knowledge-link enquiry-form-btn">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="home-courses">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12  p0">
                    <ul class="list-inline courses-list">
                        <li>
                            <p class="cross-line1">
                                <span>SUGGESTION OF COURSES</span>
                            </p>
                            <h2 class="heading-black">The world’s largest
                                selection of courses</h2>
                            <p>Choose from over 100,000 online video courses with
                                new additions published every month</p>
                            <div class="mt-5"><a href="{{ route('website.course') }}" target="_blank"
                                    class="knowledge-link">View All
                                    Coures</a></div>
                        </li>

                        @foreach ($publishCourse as $key => $item)
                            <li>

                                <div class="course-pic"><img src="{{ asset($item['course_pic']) }}"
                                        class="w100"></div>
                                <div class="course-desc"><span
                                        class="icon-clock-09 clock-icon"></span><span>{{ $item['duration'] }}</span>
                                    <h4 class="small-heading-black">{{ $item['name'] }}</h4>
                                    <span><i class="fa fa-inr" aria-hidden="true"></i>{{ $item['final_price'] }}</span>
                                    <a href="{{ route('website.course.details', ['id' => \Crypt::encrypt($item['id'])]) }}"
                                        class="enroll" target="_blank">Enroll Now</a>
                                </div>
                            </li>
                            @if ($key + 1 >= 5)
                            @break
                        @endif
                        @endforeach

                        {{-- <li>
                        <div class="course-pic"><img src="{{asset('asset_website/img/home/image2.jpg')}}" class="w100"></div>
                        <div class="course-desc"><span class="icon-clock-09 clock-icon"></span><span>10-15 Weeks</span>
                            <h4 class="small-heading-black">Competitive Strategy law for all
                                students</h4>
                            <span><i class="fa fa-inr" aria-hidden="true"></i>3399</span>
                            <a href="course-details.html" class="enroll" target="_blank">Enroll now</a>
                        </div>
                    </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="upcoming-course">
        <div class="container-fluid">
            <div class="row">
                @if (! empty($upComingCourse) )
                    <div class="col-lg-12 text-center">
                        <p class="cross-line2">
                            <span>UPCOMING COURSES</span>
                        </p>

                        <h2 class="heading-black">Some of our upcoming courses</h2>
                    </div>
                    <div class="col-lg-12">
                        <div class="owl-slider">
                            <div id="carousel" class="owl-carousel">
                                @foreach ($upComingCourse as $key => $item)

                                <div class="item">
                                    <div class="upcoming-image"><img src="{{ asset($item['course_pic']) }}"
                                            class="w100"></div>
                                    <div class="upcoming-desc"><span class="icon-clock-09 clock-icon1"></span>
                                        <span>{{ $item['duration'] }}</span>
                                        <h4 class="small-heading-white">{{ $item['name'] }}</h4>
                                        <span><i class="fa fa-inr"
                                                aria-hidden="true"></i>{{ $item['final_price'] }}</span>
                                    </div>
                                </div>
                                    @if ($key + 1 >= 5)
                                        @break
                                    @endif

                                @endforeach

                            </div>
                        </div>
                    </div>
                @endif
                
            </div>
        </div>
    </section>


    <section class="knowledge">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="heading-black">Knowledge forum</h2>
                    <p class="knowledge-para">Learn something new every day. Loaded with Knowledgebase, Forum &amp; more!
                    </p>
                    <div><a href="{{ route('website.knowledge.forum') }}" target="_blank" class="knowledge-link">Find
                            out</a></div>
                </div>
            </div>
        </div>
    </section>


    <section class="testimonial">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 testimonial-left">
                    <p class="cross-line3">
                        <span>TESTIMONIAL</span>
                    </p>
                    <h2 class="heading-white">See What Students
                        Says about Ours
                        Courses.</h2>
                </div>
                <div class="col-lg-8 testimonial-right">
                    <div class="owl-slider">
                        <div id="carousel-testimonial" class="owl-carousel">
                            <div class="item">
                                <div class="">
                                    <div class=" testimonial-image"><img
                                            src="{{ asset('asset_website/img/home/user.jpg ') }}" class="w100">
                                    </div>
                                    <div class="testimonial-desc">
                                        <h5>Rajdeep Das</h5>
                                        <p>MSC students</p>
                                    </div>
                                </div>
                                <div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                        irure
                                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur.
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                        mollit anim id est laborum</p>
                                </div>
                            </div>
                            <div class="item">
                                <div class="">
                                    <div class=" testimonial-image"><img
                                            src="{{ asset('asset_website/img/home/user.jpg') }}" class="w100">
                                    </div>
                                    <div class="testimonial-desc">
                                        <h5>Rajdeep Das</h5>
                                        <p>MSC students</p>
                                    </div>
                                </div>
                                <div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                        irure
                                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur.
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                        mollit anim id est laborum</p>
                                </div>
                            </div>
                            <div class="item">
                                <div>
                                    <div class="testimonial-image"><img
                                            src="{{ asset('asset_website/img/home/user.jpg') }}" class="w100">
                                    </div>
                                    <div class="testimonial-desc">
                                        <h5>Rajdeep Das</h5>
                                        <p>MSC students</p>
                                    </div>
                                </div>
                                <div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                        irure
                                        dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur.
                                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                                        mollit anim id est laborum</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="blogs">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <p class="cross-line4">
                        <span>BLOGS</span>
                    </p>
                    <h2 class="heading-black">Our Latest Blogs</h2>
                    <p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis
                        libero tempus, blandit posuere and ligula varius magna a porta</p>
                </div>
                <div class="col-lg-6">
                    <div><a href="{{ route('website.blog') }}" target="_blank" class="view">Read More
                            Stories</a></div>
                </div>
                <div class="col-lg-12">
                    <ul class="list-inline blog-list">
                        @foreach ($blogs as $item)
                            <li><span
                                    class="icon-Calender-09 calendar-icon"></span><span>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</span>
                                <div class="block-ellipsis1">
                                    <h4 class="small-heading-black">
                                        {!! Illuminate\Support\Str::limit(strip_tags($item->name), $limit = 100, $end = '...') !!}</h4>
                                </div>
                                <div class="block-ellipsis2 ">
                                    {!! Illuminate\Support\Str::limit(strip_tags($item->blog), $limit = 100, $end = '...') !!}
                                </div>
                                <div><a href="{{ route('website.blog.details', ['id' => \Crypt::encrypt($item->id)]) }}"
                                        target="_blank" class="read-more">Read More</a></div>
                            </li>

                        @endforeach

                        {{-- <li><span class="icon-Calender-09 calendar-icon"></span><span>April 20, 2021</span>
                        <div class="block-ellipsis1">
                            <h4 class="small-heading-black">Integer congue magna at pretium
                                purus pretium Integer congue magna at pretium
                                purus pretium</h4>
                        </div>
                        <p class="block-ellipsis2 ">Lorem ipsum dolor sit amet, consectetur sed do
                            eiusmod tempor incididunt ut labore et dolore
                            magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat</p>
                        <div><a href="blog-details.html" target="_blank" class="read-more">Read More</a></div>
                    </li>
                    <li><span class="icon-Calender-09 calendar-icon"></span><span>April 20, 2021</span>
                        <div class="block-ellipsis1">
                            <h4 class="small-heading-black">Integer congue magna at pretium
                                purus pretium Integer congue magna at pretium
                                purus pretium</h4>
                        </div>
                        <p class="block-ellipsis2 ">Lorem ipsum dolor sit amet, consectetur sed do
                            eiusmod tempor incididunt ut labore et dolore
                            magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat</p>
                        <div><a href="blog-details.html" target="_blank" class="read-more">Read More</a></div>
                    </li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="professionals">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="heading-blue">We’re Professionals For<br />
                        Grow Your Skill!</h2>
                    <p class="small-heading-black mb0">Start Online Learning Today</p>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')

    <script>
        jQuery("#carousel").owlCarousel({
            loop: true,
            autoplay: true,
            rewind: true,
            /* use rewind if you don't want loop */
            margin: 20,
            responsiveClass: true,
            autoHeight: true,
            autoplayTimeout: 7000,
            smartSpeed: 800,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },

                600: {
                    items: 3
                },

                1024: {
                    items: 3
                },

                1366: {
                    items: 3
                }
            }
        });

        jQuery("#carousel-testimonial").owlCarousel({
            loop: true,
            autoplay: true,
            rewind: true,
            /* use rewind if you don't want loop */
            margin: 20,
            responsiveClass: true,
            autoHeight: true,
            autoplayTimeout: 7000,
            smartSpeed: 800,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },

                600: {
                    items: 1
                },

                1024: {
                    items: 1
                },

                1366: {
                    items: 1
                }
            }
        });

        jQuery("#carousel-banner").owlCarousel({
            loop: true,
            autoplay: true,
            rewind: true,
            /* use rewind if you don't want loop */
            margin: 20,
            responsiveClass: true,
            autoHeight: true,
            autoplayTimeout: 7000,
            smartSpeed: 800,
            nav: false,
            responsive: {
                0: {
                    items: 1
                },

                600: {
                    items: 1
                },

                1024: {
                    items: 1
                },

                1366: {
                    items: 1
                }
            }
        });




        $('#enquiryFormSubmit').on('submit',function(e){
            e.preventDefault();

            let formData = new FormData(this);
            $('.enquiry-form-btn').text('submiting....');
            $('.enquiry-form-btn').attr('disabled',true);

            if($('#name').val().length == 0){
                toastr.error('Name is required');
            }else if($('#phone').val().length == 0){
                toastr.error('Phone number is required');
            }else if($('#email').val().length == 0){
                toastr.error('Email is required');
            }else if($('#message').val().length == 0){
                toastr.error('Message is required');
            }else{
                $.ajax({
                    url:'{{route("website.save.enquiry.details")}}',
                    type:'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data:formData,
                    success:function(data){
                        if(data.status == 1){
                            toastr.success(data.message);
                            $('.enquiry-form-btn').text('Submit');
                             $('.enquiry-form-btn').attr('disabled',false);
                            $('#enquiryFormSubmit')[0].reset();
                        }else{
                            toastr.error(data.message);
                            $('.enquiry-form-btn').text('Submit');
                             $('.enquiry-form-btn').attr('disabled',false);
                        }
                    },
                    error:function(xhr, status, error){
                        if(xhr.status == 500 || xhr.status == 422){
                            toastr.error('Oops! Something went wrong while saving.');
                        }
                    }
                });
            }     
        });
    </script>

@endsection
