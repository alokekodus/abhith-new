@extends('layout.website.website')
@section('head')
    <style>
        #header{
            display:none;
        }
        .top-header .become-a-teacher-tag{
            display: none;
        }

        .top-header .header-cart-btn{
            display: none;
        }

        @media (max-width: 767px){
            #header{
                display: block;
                top: 70px;
            }
            .mobile-nav-toggle {
                top: 94px;
            }
            .support-team{
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
            .support-team-icon1 img{
                width: 350px;
                height: 375px;
                text-align: center;
            }
            .support-team-icon2{
                display: none;
            }
            .fade img{
                width: inherit;
            }
            .leftBlock img, .centerBlock img, .rightBlock img{
                width: 75px;
            }
        }
        @media (min-width:768px) and (max-width:991px){
            #header{
                display: block;
                background: none;
            }
            .login-details {
                float: none;
            }
            .support-team-icon1 img, .support-team-icon2 img {
                width: 250px;
                height: 275px;
            }
            .fade img{
                width: 100%;
            }
        }
    </style>
    
@endsection
@section('content')

    <section class="become-a-teacher">

        <!-- Reasons -->
        <div class="container">
            <h1 class="heading-black text-center">So many reasons to start</h1>
            <div class="row mt-5">
                <div class="col-md-4 text-center mb-2 leftBlock">
                    <img src="{{asset('asset_website/img/becomeTeacher/Teach_your_way.png')}}" alt="">
                    <h5><b>Teach your way</b></h5>
                    <p>Publish the course you want, in the way you want, and always have of control your own content.</p>
                </div>
                <div class="col-md-4 text-center mb-2 centerBlock">
                    <img src="{{asset('asset_website/img/becomeTeacher/Inspire_Learners.png')}}" alt="">
                    <h5><b>Inspire learners</b></h5>
                    <p>Teach what you know and help learners explore their interests, gain new skills, and advance their careers.</p>
                </div>
                <div class="col-md-4 text-center mb-2 rightBlock">
                    <img src="{{asset('asset_website/img/becomeTeacher/Get_Rewarded.png')}}" alt="">
                    <h5><b>Get rewarded</b></h5>
                    <p>Expand your professional network, build your expertise, and earn money on each paid enrollment.</p>
                </div>
            </div>
        </div>
        <!-- End Reasons -->
        
        <!-- How to Begin -->
        <div class="container mt-5">
            <h2 class="heading-black text-center">How to begin</h2>
            <nav class="mt-4">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Curriculum</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Record</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Launch course</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <p>You start with your passion and knowledge. Then choose a promising topic with the help of our Marketplace Insights tool.</p>
                                <p>The way that you teach — what you bring to it — is up to you.</p>
                                <h5><b>How we help you</b></h5>
                                <p>We offer plenty of resources on how to create your first course. And, our instructor dashboard and curriculum pages help keep you organized.</p>
                            </div>
                            <div class="col-md-6">
                                <img src="{{asset('asset_website/img/becomeTeacher/plan-your-curriculum-v3.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <p>Use basic tools like a smartphone or a DSLR camera. Add a good microphone and you’re ready to start.</p>
                                <p>If you don’t like being on camera, just capture your screen. Either way, we recommend two hours or more of video for a paid course.</p>
                                <h5><b>How we help you</b></h5>
                                <p>Our support team is available to help you throughout the process and provide feedback on test videos.</p>
                            </div>
                            <div class="col-md-6">
                                <img src="{{asset('asset_website/img/becomeTeacher/record-your-video-v3.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <p>Gather your first ratings and reviews by promoting your course through social media and your professional networks.</p>
                                <p>Your course will be discoverable in our marketplace where you earn revenue from each paid enrollment.</p>
                                <h5><b>How we help you</b></h5>
                                <p>Our custom coupon tool lets you offer enrollment incentives while our global promotions drive traffic to courses. There’s even more opportunity for courses chosen for Udemy Business.</p>
                            </div>
                            <div class="col-md-6">
                                <img src="{{asset('asset_website/img/becomeTeacher/launch-your-course-v3.jpg')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- Responsive view -->
            {{-- <div id="accordion">
                <div class="card">
                  <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Collapsible Group Item #1
                      </button>
                    </h5>
                  </div>
              
                  <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Collapsible Group Item #2
                      </button>
                    </h5>
                  </div>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Collapsible Group Item #3
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                  </div>
                </div>
              </div> --}}
            <!-- End Responsive view -->

        <!-- End How to Begin -->

        <!-- Support Team -->
        <div class="container-fluid mt-5">
            <div class="d-flex support-team">
            <div class="support-team-icon1">
                <img src="{{asset('asset_website/img/becomeTeacher/support-1-2x-v3.jpg')}}" alt="">
            </div>
            <div class="col-md-5 support-team-text text-center pt-4">
                <h2 class="heading-black">You won’t have to do it alone</h2>
                <p>Our <b>Instructor Support Team</b> is here to answer your questions and review your test video, while our <b>Teaching Center</b> gives you plenty of resources to help you through the process. Plus, get the support of experienced instructors in our <b>online community</b>.</p>
            </div>
            <div class="support-team-icon2">
                <img src="{{asset('asset_website/img/becomeTeacher/support-2-v3.jpg')}}" alt="">
            </div>
        </div>
        <!-- ENd Support Team -->

        <!-- Instructor Today -->
        <div class="container-fluid text-center mt-5">
            <div class="py-5">
                <h2 class="heading-black">Become an instructor today</h2>
                <p>Join one of the world’s largest online learning marketplaces.</p>
                <div class="teacher-btn">
                    <a href="{{route('website.login')}}" class="btn btn-primary">Get Started</a>
                </div>
            </div>
        </div>
        <!-- ENd Instructor Today -->

    </section>

@endsection