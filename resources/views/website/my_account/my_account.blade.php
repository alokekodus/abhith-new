@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<link href="{{ asset('asset_website/css/my_account.css') }}" rel="stylesheet">
<style>
    .img-top-left {
        position: absolute;
        top: 8px;
        left: 26px;
        color: aliceblue;
    }
</style>
@endsection

@section('content')
@include('layout.website.include.forum_header')
<section class="account-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-12">
                <div class="knowledge-forum-right1 sidebar">
                    <div class="knowledge-forum-profile-top">
                        <img src="{{ asset('asset_website/img/knowladge-forum/bg.png') }}" class="w100">
                    </div>
                    <div class="knowledge-forum-profile-bottom1">
                        <div class="knowledge-pic">

                            @if ($user_details != null)
                            <img src="{{ asset('/files/profile/' . $user_details->image) }}"
                                onerror="this.onerror=null;this.src='{{ asset('asset_website/img/noimage.png') }}';"
                                style="border:3px solid white;" height="110px" width="110px" class="rounded-circle">
                            @else
                            <img src="{{ asset('asset_website/img/knowladge-forum/image1.png') }}" class="w100">
                            @endif
                        </div>
                        <div class="knowledge-desc mt-2">
                            <h4 class="small-heading-black text-center mb0">{{ Auth::user()->name }}</h4>
                            @if ($user_details != null)
                            <p class="text-center">{{ $user_details->education }}</p>
                            @else
                            <p class="text-center">Your Education Details</p>
                            @endif
                        </div>
                    </div>

                    <ul class="nav nav-tabs flex-column profile-tab" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#photo" role="tab"
                                aria-controls="photo">Photo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#account" role="tab"
                                aria-controls="account">Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#mycourses" role="tab"
                                aria-controls="mycourses">My Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#myperformance" role="tab"
                                aria-controls="myperformance">My Performance</a>
                        </li>
                        {{--
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#notification" role="tab"
                                aria-controls="notification">Notification <span class="notification-badge">4</span></a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#purchase" role="tab"
                                aria-controls="purchase">Purchase History</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-8 col-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="profile" role="tabpanel">
                        <div class="profile-form">
                            <form class="row" id="profileForm">
                                @csrf
                                <div class="col-lg-6 col-6">
                                    <h4 class="small-heading-black">Profile</h4>
                                </div>
                                <div class="col-lg-6 col-6 text-right ">
                                    <a class="btn btn-secondary edit-btn" href="#">Edit Profile</a>&nbsp;
                                    <a class="btn btn-warning cancel-edit-btn" href="#">Cancel Edit</a>
                                </div>
                                @if ($user_details != null)
                                <div class="form-group col-lg-6 pr10">
                                    <label>Name</label>
                                    {{-- <input type="text" class="form-control" name="name" placeholder="Enter Name"
                                        id="name" pattern="^([a-zA-Z]+)\s?([a-zA-z]+)"
                                        title="Please Enter Letters only." value="{{Auth::user()->name}}" required> --}}

                                    <input type="text" class="form-control" name="name" placeholder="Enter Name"
                                        id="name" value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="form-group col-lg-6 pr10">
                                    <label>Email ID</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email"
                                        id="email" value="{{ Auth::user()->email }}" required>
                                </div>
                                <div class="form-group col-lg-6 pr10">
                                    <label>Mobile number</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone"
                                        id="phone" pattern="(0|91)?[6-9][0-9]{9}"
                                        title="Phone number should start with 6 or 7 or 8 or 9 and 10 chars long. ( e.g 7896845214)"
                                        value="{{ $user_details->phone }}" required>
                                </div>
                                <div class="form-group col-lg-6 pl10">
                                    <label>Education</label>
                                    <input type="text" class="form-control" name="education"
                                        placeholder="Enter Education" id="education"
                                        value="{{ $user_details->education }}" required>
                                </div>
                                <div class="form-group col-lg-6 pl10">
                                    <label>Gender</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="{{ $user_details->gender }}">{{ $user_details->gender }}
                                        </option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 pr10">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Enter Address"
                                        id="address" title="Please Enter valid address."
                                        value="{{ $user_details->address ?? '' }}" required>
                                </div>
                                @else
                                <div class="form-group col-lg-6 pr10">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name"
                                        id="name" value="{{ Auth::user()->name ?? '' }}" required>
                                </div>
                                <div class="form-group col-lg-6 pr10">
                                    <label>Email ID</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email"
                                        id="email" value="{{ Auth::user()->email }}" required>
                                </div>
                                <div class="form-group col-lg-6 pr10">
                                    <label>Mobile number</label>
                                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone"
                                        id="phone" pattern="(0|91)?[6-9][0-9]{9}" value="{{ Auth::user()->phone }}"
                                        title="Phone number should start with 6 or 7 or 8 or 9  and 10 chars long.( e.g 7896845214)"
                                        required>
                                </div>
                                <div class="form-group col-lg-6 pl10">
                                    <label>Education</label>
                                    <input type="text" class="form-control" name="education"
                                        placeholder="Enter Education" id="education" required>
                                </div>
                                <div class="form-group col-lg-6 pl10">
                                    <label>Gender</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 pr10">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Enter Address"
                                        id="address" value="{{ $user_details->address ?? 'NA' }}" required>
                                </div>
                                @endif
                                <div class="form-group col-lg-12">
                                    <div class="button-div"><button type="submit"
                                            class="btn btn-block knowledge-link profile-save-btn">Save</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="photo" role="tabpanel">
                        <form class="row" enctype="multipart/form-data" id="photoUploadForm">
                            @csrf
                            <div class="col-lg-12 col-12">
                                <h4 class="small-heading-black">Preview Photo</h4>
                            </div>
                            <div class="form-group col-lg-12">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <p class="heading-form">Add / Change Image</p>
                                        <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg"
                                            onchange="previewImage(event)" required>
                                        <label for="imageUpload"></label>
                                        <div class="btn-div2"><button type="submit"
                                                class="btn btn-md knowledge-link upload-photo-btn">Save</button></div>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                    <div class="avatar-preview">
                                        <img id="outputImage" src="{{ asset('/asset_website/img/imgPreview.png') }}"
                                            alt="">
                                        {{-- <div id="outputImage"
                                            style="background-image: url(http://i.pravatar.cc/500?img=7);">
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="account" role="tabpanel">
                        <div class="account-form">
                            <form class="row" id="updatePasswordForm">
                                @csrf
                                <div class="col-lg-12 col-6 mb-2">
                                    <h4 class="small-heading-black">Password</h4>
                                </div>

                                <div class="form-group col-lg-7">
                                    <input type="password" class="form-control" name="currentPassword"
                                        placeholder="Enter Current Password" id="currentPassword" required>
                                </div>
                                <div class="form-group col-lg-7">
                                    <input type="password" class="form-control" name="newPassword"
                                        placeholder="Enter New Password" id="newPassword" required>
                                </div>
                                <div class="form-group col-lg-7">
                                    <input type="password" class="form-control" name="confirmPassword"
                                        placeholder="Confirm Password" id="confirmPassword" required>
                                </div>
                                <div class="form-group col-lg-7">
                                    <div class="button-div1">
                                        <button type="submit"
                                            class="btn btn-block knowledge-link change-password-btn">Change
                                            Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="mycourses" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12 col-6">
                                <h4 class="font-weight-bold">My Courses</h4>
                                {{-- <h4 class="small-heading-black">My Courses</h4> --}}
                            </div>
                            <div class="col-lg-12 mt-4">
                                <table id="purchase_history_table" class="table table-striped">
                                    <tbody>
                                        @forelse ($purchase_history as $key => $item)
                                        <div class="row mb-4">
                                            <div class="col-lg-2 col-md-3">
                                                @if ($item->board->logo == '')
                                                <img src="{{ asset('asset_website/img/Image.png') }}"
                                                    style="height: 125px; width:125px; object-fit:cover; border-radius:10px"
                                                    alt="">

                                                @else
                                                <img src="{{ asset($item->board->logo) }}"
                                                    style="height: 125px; width:125px; object-fit:cover; border-radius:10px"
                                                    alt="">

                                                @endif
                                            </div>
                                            <div class="col-lg-10 col-md-9">
                                                <div class="d-flex justify-content-between myCourses-details">
                                                    <div style="width: 25%; display:flex; flex-direction: column">
                                                        <h6>Board</h6>
                                                        <h5 class="font-weight-bold">
                                                            {{ $item->board->exam_board }}</h5>

                                                        <div class="myCourses-view-btn">
                                                            <a href="{{ route('website.user.courses', Crypt::encrypt($item->id)) }}"
                                                                target="_blank" class="btn-sm btn-primary">View
                                                                Details</a>
                                                        </div>
                                                    </div>
                                                    <div style="width: 25%">
                                                        <h6>Class</h6>
                                                        <h5 class="font-weight-bold">
                                                            {{ $item->assignClass->class ?? '' }}
                                                        </h5>
                                                    </div>
                                                    <div style="width: 25%">
                                                        <h6>Course Type</h6>
                                                        <h5 class="font-weight-bold">
                                                            @if ($item->is_full_course_selected == 1)
                                                            Full Course
                                                            @else
                                                            Custom package
                                                            @endif
                                                        </h5>
                                                    </div>
                                                    <div>
                                                        <h6>Subjects</h6>
                                                        <h5 class="font-weight-bold text-center">
                                                            {{ $item->assignSubject->count() }}</h5>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{-- <div class="course-pic"><img src="{{asset('files/course/courses.jpeg')}}"
                                                class="w100">
                                            <div class="img-top-left"><b>{{$item->board->exam_board}} ||
                                                    Class-{{$item->assignClass->class??''}}</b></div>
                                        </div>
                                        <div class="course-desc">

                                            <h5><b>{{$item->board->exam_board}} ||
                                                    Class-{{$item->assignClass->class??''}}</b></h5>


                                            <a href="{{route('website.user.courses',Crypt::encrypt($item->id))}}"
                                                class="enroll">View
                                                Details</a>
                                        </div> --}}
                                        @empty
                                        <tr>
                                            <div class="text-center">
                                                <p>Oops! No items purchased yet.</p>
                                                <div class="shipping-div text-center"><a
                                                        href="{{ route('website.course') }}"
                                                        class="shipping-btn">Continue
                                                        shoping</a></div>
                                            </div>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>



                                {{-- <div class="row">
                                    <div class="col-lg-2 col-md-3">
                                        <img src="{{asset('asset_website/img/Image.png')}}" style="height: 125px"
                                            alt="">
                                    </div>
                                    <div class="col-lg-10 col-md-9">
                                        <div class="d-flex justify-content-between myCourses-details">
                                            <div>
                                                <h6>Board</h6>
                                                <h5 class="font-weight-bold">SEBA</h5>
                                            </div>
                                            <div>
                                                <h6>Class</h6>
                                                <h5 class="font-weight-bold">Class 9</h5>
                                            </div>
                                            <div>
                                                <h6>Course Type</h6>
                                                <h5 class="font-weight-bold">Full Course</h5>
                                            </div>
                                            <div>
                                                <h6>Subjects</h6>
                                                <h5 class="font-weight-bold text-center">8</h5>
                                            </div>
                                        </div>
                                        <div class="myCourses-view-btn">
                                            <a href="#" class="btn btn-primary">View Details</a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="myperformance" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-6">
                                <h2 class="font-weight-bold">My Performance</h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Select Subject
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div id="subjectoption"></div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-5 mb-5">
                                <h3 class="text-center font-weight-bold">All Subject</h3>
                            </div>
                            <div class="col-lg-6 circular-left">
                                <div class="d-flex progress-main">
                                    <div class="circleOne">
                                        <div class="circular-progress-one">
                                            <span class="progress-value-one"></span>
                                        </div>
                                    </div>
                                    <div class="circularText">
                                        <div class="watched d-flex">
                                            <span class="dot mr-2"></span>
                                            <p> Watched Videos</p>
                                        </div>
                                        <div class="not-watched d-flex">
                                            <span class="dot mr-2"></span>
                                            <p>Not Watched Videos</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6 circular-right">
                                <div class="d-flex progress-main">
                                    <div class="circleTwo">
                                        <div class="circular-progress-two">
                                            <span class="progress-value-two">0%</span>
                                        </div>
                                    </div>
                                    <div class="circular-text">
                                        <h5>Subject Progress</h5>
                                        <h6>Based on your video</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 mt-5">
                                <div class="progress-bar-text d-flex justify-content-between">
                                    <div class="progress-bar-left">
                                        <h5 class="font-weight-bold">Time Spent</h5>
                                        <p>Based on your activities in app ( Mins)</p>
                                    </div>
                                    <div class="progress-bar-right">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item mb-2" role="presentation">
                                                <button class="nav-link active" id="daily-tab" data-toggle="tab"
                                                    data-target="#daily" type="button" role="tab" aria-controls="daily"
                                                    aria-selected="true">Daily</button>
                                            </li>
                                            {{-- <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="monthly-tab" data-toggle="tab"
                                                    data-target="#monthly" type="button" role="tab"
                                                    aria-controls="monthly" aria-selected="false">Monthly</button>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">
                                    <div>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                    {{-- <div class="tab-pane fade show active" id="daily" role="tabpanel"
                                        aria-labelledby="daily-tab">
                                        <div class="monthly-progress-bar">
                                            <div class="weekly-bar">
                                                <div class="week-percent" style="height: 25%">
                                                    <div class="percent"><span id="monday"></span></div>
                                                </div>
                                                <div class="weekday-name">Mon</div>
                                            </div>
                                            <div class="weekly-bar">
                                                <div class="week-percent" style="height: 65%">
                                                    <div class="percent"><span id="tueday"></span></div>
                                                </div>
                                                <div class="weekday-name">Tue</div>
                                            </div>
                                            <div class="weekly-bar">
                                                <div class="week-percent" style="height: 30%">
                                                    <div class="percent"><span id="wedday"></span></div>
                                                </div>
                                                <div class="weekday-name">Wed</div>
                                            </div>
                                            <div class="weekly-bar">
                                                <div class="week-percent" style="height: 67%">
                                                    <div class="percent"><span id="thuday"></span></div>
                                                </div>
                                                <div class="weekday-name">Thu</div>
                                            </div>
                                            <div class="weekly-bar">
                                                <div class="week-percent" style="height: 60%">
                                                    <div class="percent"><span id="friday"></span></div>
                                                </div>
                                                <div class="weekday-name">Fri</div>
                                            </div>
                                            <div class="weekly-bar">
                                                <div class="week-percent" style="height: 23git %">
                                                    <div class="percent"><span id="satday"></span></div>
                                                </div>
                                                <div class="weekday-name">Sat</div>
                                            </div>
                                            <div class="weekly-bar">
                                                <div class="week-percent" style="height: 60%">
                                                    <div class="percent"><span id="sunday"></span></div>
                                                </div>
                                                <div class="weekday-name">Sun</div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="tab-pane fade" id="monthly" role="tabpanel"
                                        aria-labelledby="monthly-tab">
                                        <div class="monthly-progress-bar">
                                            <div class="monthly-bar">
                                                <div class="monthly-percent" style="height: 25%">
                                                    <div class="percent">15</div>
                                                </div>
                                                <div class="month-name">Jan</div>
                                            </div>
                                            <div class="monthly-bar">
                                                <div class="monthly-percent" style="height: 65%">
                                                    <div class="percent">45</div>
                                                </div>
                                                <div class="month-name">Feb</div>
                                            </div>
                                            <div class="monthly-bar">
                                                <div class="monthly-percent" style="height: 30%">
                                                    <div class="percent">20</div>
                                                </div>
                                                <div class="month-name">Mar</div>
                                            </div>
                                            <div class="monthly-bar">
                                                <div class="monthly-percent" style="height: 67%">
                                                    <div class="percent">47</div>
                                                </div>
                                                <div class="month-name">Apr</div>
                                            </div>
                                            <div class="monthly-bar">
                                                <div class="monthly-percent" style="height: 60%">
                                                    <div class="percent">40</div>
                                                </div>
                                                <div class="month-name">May</div>
                                            </div>
                                            <div class="monthly-bar">
                                                <div class="monthly-percent" style="height: 23%">
                                                    <div class="percent">13</div>
                                                </div>
                                                <div class="month-name">Jun</div>
                                            </div>
                                            <div class="monthly-bar">
                                                <div class="monthly-percent" style="height: 50%">
                                                    <div class="percent">35</div>
                                                </div>
                                                <div class="month-name">Jul</div>
                                            </div>
                                            <div class="monthly-bar">
                                                <div class="monthly-percent" style="height: 45%">
                                                    <div class="percent">30</div>
                                                </div>
                                                <div class="month-name">Aug</div>
                                            </div>
                                            <div class="monthly-bar">
                                                <div class="monthly-percent" style="height: 36%">
                                                    <div class="percent">25</div>
                                                </div>
                                                <div class="month-name">Sep</div>
                                            </div>
                                            <div class="monthly-bar">
                                                <div class="monthly-percent" style="height: 53%">
                                                    <div class="percent">38</div>
                                                </div>
                                                <div class="month-name">Oct</div>
                                            </div>
                                            <div class="monthly-bar">
                                                <div class="monthly-percent" style="height: 48%">
                                                    <div class="percent">33</div>
                                                </div>
                                                <div class="month-name">Nov</div>
                                            </div>
                                            <div class="monthly-bar">
                                                <div class="monthly-percent" style="height: 28%">
                                                    <div class="percent">17</div>
                                                </div>
                                                <div class="month-name">Dec</div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-md-4 mt-5">
                                <h5 class="font-weight-bold">MCQ Test Performance</h5>
                                <div class="mcq-box mt-4 d-flex">
                                    <div class="icon-box">
                                        <img src="{{ asset('asset_website/img/icon.png') }}" alt="">
                                    </div>
                                    <div class="mcq-text">
                                        <h6>Test Attempt</h6>
                                        <p><span id="test_attempt"></span></p>
                                    </div>
                                </div>
                                <div class="mcq-box mt-3 d-flex">
                                    <div class="icon-box">
                                        <img src="{{ asset('asset_website/img/icon.png') }}" alt="">
                                    </div>
                                    <div class="mcq-text">
                                        <h6>Correct Answer</h6>
                                        <p><span id="correct_answer"></span></p>
                                    </div>
                                </div>
                                <div class="mcq-box mt-3 d-flex">
                                    <div class="icon-box">
                                        <img src="{{ asset('asset_website/img/icon.png') }}" alt="">
                                    </div>
                                    <div class="mcq-text">
                                        <h6>Accuracy</h6>
                                        <p><span id="accuracy"></span></p>
                                    </div>
                                </div>
                                <div class="mcq-box mt-3 d-flex">
                                    <div class="icon-box">
                                        <img src="{{ asset('asset_website/img/icon.png') }}" alt="">
                                    </div>
                                    <div class="mcq-text">
                                        <h6>Total Time</h6>
                                        <p><span id="totaltime"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <span class="text">Based on video Watched</span> --}}
                        {{-- <input type="text" data-plugin="knob" class="dial" data-width="150" data-height="250"
                            data-fgColor="blue" value="50" data-max="100" data-skin="tron" data-readOnly=true
                            data-thickness=".2" data-displayInput=false /> --}}
                        {{-- <div class="col-lg-6">
                            <input type="text" class="dial" value="93" data-width="125" data-height="125"
                                data-thickness="0.25" data-fgcolor="#9C27B0"
                                style="width: 66px; height: 41px; position: absolute; vertical-align: middle; margin-top: 41px; margin-left: -95px; border: 10px; background: none; font: bold 25px Arial; text-align: center; color: rgb(156, 39, 176); padding: 0px; appearance: none;"
                                data-angleOffset="180">
                        </div> --}}
                        {{-- <input data-plugin="knob" class="dial" data-width="120" data-height="120"
                            data-linecap=round data-fgColor="#2abfcc" value="20" data-max="100" data-skin="tron"
                            data-angleOffset="180" data-readOnly=true data-thickness=".1" /> --}}
                        {{-- <div class="skill">
                            <div class="skill-outer">
                                <div class="skill-inner">
                                    <div id="skillNumber"></div>
                                </div>
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px">
                                <defs>
                                    <linearGradient id="GradientColor">
                                        <stop offset="0%" stop-color="#e91e63" />
                                        <stop offset="100%" stop-color="#673ab7" />
                                    </linearGradient>
                                </defs>
                                <circle cx="80" cy="80" r="70" />
                            </svg>
                        </div> --}}
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="160px" height="160px">
                            <defs>
                                <linearGradient id="GradientColor">
                                    <stop offset="0%" stop-color="#e91e63" />
                                    <stop offset="100%" stop-color="#673ab7" />
                                </linearGradient>
                            </defs>
                            <circle cx="80" cy="80" r="70" stroke-linecap="round" />
                        </svg> --}}
                    </div>
                    <div class="tab-pane" id="purchase" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-12 col-6">
                                <h4 class="small-heading-black">Purchase History</h4>
                            </div>
                            <div class="col-lg-12">
                                <table id="purchase_history_table" class="table table-striped">
                                    @if (!$purchase_history->isEmpty())
                                    <thead>
                                        <tr class="text-center">
                                            {{-- <th>Sl No.</th> --}}
                                            <th>Board Name</th>
                                            <th>Subject</th>
                                            <th>Class Name</th>
                                            <th>Subjects</th>
                                            <th>Total Price</th>
                                            <th>Purchase Date</th>
                                            <th>E-Receipt</th>
                                        </tr>
                                    </thead>
                                    @endif
                                    <tbody>
                                        @forelse ($purchase_history as $key => $item)
                                        <tr class="text-center">
                                            {{-- <td>{{$key + 1}}</td> --}}
                                            <td>{{ $item->board->exam_board }}</td>
                                            <td></td>
                                            <td>{{ $item->assignClass->class }}</td>
                                            <td>
                                                @if ($item->is_full_course_selected == '1')
                                                All Subjects
                                                @else
                                                Custom Package
                                                @endif
                                            </td>

                                            <td>{{ number_format($item->assignClass->subjects->sum('subject_amount') ??
                                                '00', 2, '.', '') }}
                                            </td>
                                            <td>{{ $item->updated_at->format('d-M-Y') }}</td>
                                            <td><a href="#">Download</a></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <div class="text-center">
                                                <p>Oops! No items purchased yet.</p>
                                                <div class="shipping-div text-center"><a
                                                        href="{{ route('website.course') }}"
                                                        class="shipping-btn">Continue
                                                        shoping</a></div>
                                            </div>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@include('layout.website.include.modals')
@endsection

@section('scripts')
@include('layout.website.include.modal_scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function previewImage(event) {
            let reader = new FileReader();
            reader.onload = function() {
                let output = document.getElementById('outputImage');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }




        /******************  For Profile Section ******************/
        $('#name').attr("disabled", true);
        $('#email').attr("readonly", "readonly");
        $('#phone').attr("readonly", "readonly");
        $('#education').attr("disabled", true);
        $('#gender').attr("disabled", true);
        $('#address').attr("disabled", true);
        $('.profile-save-btn').attr("disabled", true);
        $('.profile-save-btn').addClass('knowledge-link-old');
        $('.profile-save-btn').removeClass('knowledge-link');
        // $('#profileForm input').attr('readonly', 'readonly');
        $('.cancel-edit-btn').hide();
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "positionClass": "toast-top-right"
        };

        $('.edit-btn').on('click', function() {
            $('#name').attr("disabled", false);
            $('#education').attr("disabled", false);
            $('#gender').attr("disabled", false);
            $('#address').attr("disabled", false);
            $('.profile-save-btn').attr("disabled", false);
            // $('#profileForm input').attr('readonly', false);
            $('.edit-btn').hide();
            $('.cancel-edit-btn').show();
            $('.profile-save-btn').addClass('knowledge-link');
            $('.profile-save-btn').removeClass('knowledge-link-old');
        });

        $('.cancel-edit-btn').on('click', function() {
            $('.edit-btn').show();
            $('.cancel-edit-btn').hide();
            $('#name').attr("disabled", true);
            $('#education').attr("disabled", true);
            $('#gender').attr("disabled", true);
            $('#address').attr("disabled", true);
            $('.profile-save-btn').attr("disabled", true);
            // $('#profileForm input').attr('readonly', 'readonly');
            $('.profile-save-btn').addClass('knowledge-link-old');
            $('.profile-save-btn').removeClass('knowledge-link');
        });


        $('#profileForm').on('submit', function(e) {
            e.preventDefault();

            $('.profile-save-btn').text('saving...');

            $.ajax({
                url: "{{ route('website.user.details') }}",
                type: "POST",
                data: $('#profileForm').serialize(),

                success: function(data) {
                    toastr.success(data.message);
                    $('#gender').attr("disabled", true);
                    $('.profile-save-btn').attr("disabled", true);
                    $('#profileForm input').attr('readonly', 'readonly');
                    $('.profile-save-btn').text('save');
                    $('.cancel-edit-btn').hide();
                    $('.edit-btn').show();
                },
                error: function(xhr, status, error) {
                    if (xhr.status == 500 || xhr.status == 422) {
                        toastr.error('Oops! Something went wrong while saving.');
                    }
                    $('.cancel-edit-btn').hide();
                    $('.edit-btn').show();
                    $('.profile-save-btn').text('save');
                }
            });
        });



        /*******************************User Photo Upload*****************************/
        $('#photoUploadForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            $('.upload-photo-btn').text('uploading...');

            let photoName = $('#imageUpload').val();
            let extension = photoName.split('.').pop();

            if (!(extension == 'jpg' || extension == 'png' || extension == 'jpeg')) {
                toastr.error('Oops! Not an image. Allowed extensions JPG, PNG, JPEG');
                $('#photoUploadForm')[0].reset();
                $('.upload-photo-btn').text('save');
            } else {
                $.ajax({
                    url: "{{ route('website.user.upload.photo') }}",
                    type: "POST",
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function(data) {
                        toastr.success(data.message);
                        $('#photoUploadForm')[0].reset();
                        $('.upload-photo-btn').text('save');
                        location.reload(true);
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status == 500 || xhr.status == 422) {
                            toastr.error('Oops! Something went wrong while saving.');
                        }
                        $('#photoUploadForm')[0].reset();
                        $('.upload-photo-btn').text('save');
                    }
                });
            }
        });

        /**************************** Update Password Section **************************/
        $('#updatePasswordForm').on('submit', function(e) {
            e.preventDefault();
            $('.change-password-btn').text('please wait...')

            let crntPwd = $('#currentPassword').val();
            let newPwd = $('#newPassword').val();
            let confPwd = $('#confirmPassword').val();

            if (crntPwd == newPwd) {
                toastr.error('Oops! New Password and Current Password should not be same');
                $('#updatePasswordForm')[0].reset();
                $('.change-password-btn').text('Change Password');
            } else if (newPwd.length < 4) {
                toastr.error('Oops! password length should not be less than 4 characters');
                $('#updatePasswordForm')[0].reset();
                $('.change-password-btn').text('Change Password');
            } else if (newPwd != confPwd) {
                toastr.error('Oops! password not matched');
                $('#updatePasswordForm')[0].reset();
                $('.change-password-btn').text('Change Password');
            } else {
                $.ajax({
                    url: "{{ route('website.update.password') }}",
                    type: "POST",
                    data: $('#updatePasswordForm').serialize(),
                    success: function(data) {
                        if (data.status == 1) {
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                        $('#updatePasswordForm')[0].reset();
                        $('.change-password-btn').text('Change Password');
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status == 500 || xhr.status == 422) {
                            toastr.error('Oops! Something went wrong while saving.');
                        }
                        $('#updatePasswordForm')[0].reset();
                        $('.change-password-btn').text('Change Password');
                    }
                });
            }
        });

        /*******************************  Purchase History***************************************/
        $(document).ready(function() {
            $('#purchase_history_table').DataTable({
                "processing": true,
                dom: 'Bfrtip',
                buttons: ['excel', 'pdf', 'print'
                    // {
                    //     extend:'pdfHtml5',
                    //     title:'Purchase History',
                    //     orientation:'landscape',
                    //     header:true,

                    //     customize:function(doc){
                    //         let colCount = new Array();
                    //         $('#purchase_history_table').find('tbody tr:first-child td').each(function(){
                    //             if($(this).attr('colspan')){
                    //                 for(let i=1;i<=$(this).attr('colspan'); i++){
                    //                     colCount.push('*');
                    //                 }
                    //             }else{
                    //                 colCount.push('*');
                    //             }
                    //         });
                    //         doc.content[1].table.widths = colCount;
                    //     }

                    // }
                ]
            });
        });
        // $(function() {
        //     $(".dial").knob();
        // });



        $(document).ready(function() {
            $.ajax({
                url: "{{ route('website.user.performance') }}",
                method: 'get',

                success: function(result) {
                    console.log(result);
                    progreceGraph(result.result);
                    mcqTestPerformance(result.result);
                    // dailyGraph(result.result);
                }
            })
        })
        function progreceGraph(result){
           
            var TimeSpent=result.time_spent;
            var MondayTimeSpent=TimeSpent.Mon;
            var TuedayTimeSpent=TimeSpent.Tue;
            var WeddayTimeSpent=TimeSpent.Wed;
            var ThudayTimeSpent=TimeSpent.Thu;
            var FridayTimeSpent=TimeSpent.Fri;
            var SatdayTimeSpent=TimeSpent.Sat;
            var SundayTimeSpent=TimeSpent.Sun;
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat','Sun'],
                datasets: [{
                    label: '# Time Spent',
                    data: [MondayTimeSpent,TuedayTimeSpent,WeddayTimeSpent,ThudayTimeSpent,FridayTimeSpent,SatdayTimeSpent,SundayTimeSpent],
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
            });
        }
        function mcqTestPerformance(result){
            
            $("#test_attempt").html(result.mcq_performance.test_attempted);
            $("#correct_answer").html(result.mcq_performance.total_correct);
            $("#accuracy").html(result.mcq_performance.total_correct);
            $("#totaltime").html(result.mcq_performance.total_duration);
        }

        // function progreceGraph(result) {
        //     let not_watched_percentage = result.subject_progress.not_watched_percentage;
        //     let watched_percentage = result.subject_progress.watched_percentage;
        //     let total_video = not_watched_percentage + watched_percentage;
        //     var total = result.subject_progress.total;
        //     let circularProgressOne = document.querySelector(".circular-progress-one"),
        //         progressValueOne = document.querySelector(".progress-value-one");

        //     let progressStartValueOne = 0,
        //         progressEndValueOne = total,
        //         speedOne = 100;

        //     let progessOne = setInterval(() => {
        //         progressStartValueOne++;

        //         progressValueOne.textContent = `${result.subject_progress.not_watched_percentage}/${total_video}`
        //         circularProgressOne.style.background =
        //             `conic-gradient(#36b872 ${progressStartValueOne * 3.6}deg, #ededed 0deg)`

        //         if (progressStartValueOne == progressEndValueOne) {
        //             clearInterval(progessOne);
        //         }
        //     })

        //     let circularProgress = document.querySelector(".circular-progress-two"),
        //         progressValue = document.querySelector(".progress-value-two");

        //     let progressStartValue = 0,
        //         progressEndValue = result.subject_progress.watched_percentage,
        //         speed = 100;

        //     let progess = setInterval(() => {
        //         progressStartValue++;

        //         progressValue.textContent = `${progressStartValue}%`
        //         circularProgress.style.background =
        //             `conic-gradient(#36b872 ${progressStartValue * 3.6}deg, #ededed 0deg)`

        //         if (progressStartValue == progressEndValue) {
        //             clearInterval(progess);
        //         }
        //     })
        // }

        function dailyGraph(result) {
            var time_spent = result.time_spent;
            console.log(time_spent);
            $("#monday").html(time_spent['Mon']);
            $("#tueday").html(time_spent['Tue']);
            $("#wedday").html(time_spent['Wed']);
            $("#thuday").html(time_spent['Thu']);
            $("#friday").html(time_spent['Fri']);
            $("#satday").html(time_spent['Sat']);
            $("#sunday").html(time_spent['Sun']);
        }
</script>
@endsection