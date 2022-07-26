@extends('layout.admin.layout.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    label.error {
        color: #dc3545;
        font-size: 14px;
    }
</style>

@if(auth()->user()->hasRole('Teacher') && !isTeacherApply())
@include('admin.teacher.applicationform')
@else
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span> Dashboard
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('asset_admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total Registered Student <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">{{$total_student}}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('asset_admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total Registered Teacher <i
                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">{{$total_teacher}}</h2>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('asset_admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">95,5741</h2>
                <h6 class="card-text">Increased by 5%</h6>
            </div>
        </div>
    </div> --}}
</div>
@endif
@endsection
@section('scripts')
<script>
    var myVideos = [];

    window.URL = window.URL || window.webkitURL;
    document.getElementById('fileUp').onchange = setFileInfo;

        function setFileInfo() {
        var files = this.files;
        myVideos.push(files[0]);
        var video = document.createElement('video');
        video.preload = 'metadata';

        video.onloadedmetadata = function() {
            window.URL.revokeObjectURL(video.src);
            var duration = video.duration;
            myVideos[myVideos.length - 1].duration = duration;
            updateInfos();
        }

        video.src = URL.createObjectURL(files[0]);;
        }
        function updateInfos() {
        
      
        for (var i = 0; i < myVideos.length; i++) {
           if(myVideos[i].duration/60>=5){
            toastr.error('Video Dureation should be less then 5 minutes');
            $('#applicationSubmit').attr('disabled',true);
           }else{
            $('#applicationSubmit').attr('disabled',false);
           }
        }
      }
</script>
<script>
    function changeBoard()
      {
        let board_id=$("#assignedBoard").val();
        console.log(board_id);
          $.ajax({
                url:"{{route('board.class')}}",
                type:"POST",
                data:{
                    '_token' : "{{csrf_token()}}",
                    'board_id' : board_id
                },
                success:function(data){
                   
                    $('#board-class-dd').html('<option value="">Select Class</option>');
                    data.forEach((boardClass) => {
                        $("#board-class-dd").append('<option value="' + boardClass
                                .id + '">'+'Class-' + boardClass.class + '</option>');
                    });
                    $('#board-subject-dd').html('<option value="">Select Subject</option>');


                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Whoops! Something went wrong. Failed to fetch course');
                    }
                }
            });
      }
      $('#board-class-dd').on('change', function () {
                var classId = this.value;
                var boardId=$("#assignedBoard").val();
                $("#board-subject-dd").html('');
                $.ajax({
                    url: "{{route('board.class.subject')}}",
                    type: "POST",
                    data: {
                         class_id: classId,
                         board_id:boardId,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (data) {
                        $('#board-subject-dd').html('<option value="">Select Subject</option>');
                        data.forEach((subject) => {
                        $("#board-subject-dd").append('<option value="' + subject
                                .id + '">'+'Subject-' + subject.subject_name + '</option>');
                        });

                    }
                });
     });
    
</script>
{{-- <script>
    $('#verifyOtpBtn').attr('disabled',true);

        let interval = '';
        let no_of_otp_sent = 0;
        let nameRegex = /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/;
        let emailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        let phoneRegex = /(0|91)?[6-9][0-9]{9}/;

        $('#sendOtpBtn').on('click',function(e){
            e.preventDefault();

            if($('#name').val().length == 0){
                toastr.error('Name is required');
            }else if(!nameRegex.test($('#name').val())){
                toastr.error('Name should contain letters only.');
            }else if($('#signupEmail').val().length == 0){
                toastr.error('Email is required');
            }else if(!emailRegex.test($('#signupEmail').val())){
                toastr.error('Email is invalid');
            }else if($('#phone').val().length < 10){
                toastr.error('Phone number is required. Enter valid phone number');
            }else if(!phoneRegex.test($('#phone').val())){
                toastr.error('Phone number should start with 6 or 7 or 8 or 9 and 10 chars long. ( e.g 7896845214)');
            }else{
                


                if(no_of_otp_sent < 2){
                    no_of_otp_sent += 1;
                    var prefix=@json($prefix);
                     if(prefix=="teacher"){
                        var url="{{route('teacher.signup')}}";
                     }else{
                        var url="{{route('website.auth.signup')}}";
                     }
                    $.ajax({
                        url:url,
                        type:'POST',
                        data:{
                            '_token': '{{ csrf_token() }}',
                            'name' : $('#name').val(),
                            'email' : $('#signupEmail').val(),
                            'phone' : $('#phone').val()
                        },
                        success:function(data){
                           
                            if(data.status == 1){
                                $('#sendOtpBtn').attr('disabled',true); 
                                $('#sendOtpBtn').css('background-image','linear-gradient(to left, #7d9fc9, #79adbd)'); 
                                $('#sendOtpBtn').text('OTP Sent');
                                $('.verify-otp-div').css('display','block');
                               
                                interval = setInterval(updateTimer, 2000);
                                toastr.success(data.message);
                            }else{
                                toastr.error(data.message);
                            }
                        },
                        error:function(xhr, status, error){
                            if(xhr.status == 500 || xhr.status == 422){
                                toastr.error('Whoops! Something went wrong while sending OTP');
                            }
                        }
                    });
                }else{
                    $('#sendOtpBtn').attr('disabled',true); 
                    toastr.info('You have reached maximum attempts for sending otp. Please wait for 1 hour to resume the service. ');
                }
            }
            
            
        });

       
        // $('#verifyOtpBtn').on('click',function(e){
        //     e.preventDefault();
        //     let otpRegex = /^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;

        //     if($('#enterOtp').val().length > 6){
        //         toastr.error('Not a valid OTP');
        //     }else if(!otpRegex.test($('#enterOtp').val())){
        //         toastr.error('Enter numbers only');
        //     }else{
        //         var prefix=@json($prefix);
        //              if(prefix=="teacher"){
        //                 var url="{{route('teacher.verifyOtp')}}";
        //              }else{
        //                 var url="{{route('website.auth.verify.otp')}}";
        //              }
        //         $.ajax({
        //             url:url,
        //             type:'POST',
        //             data:{
        //                 '_token': '{{ csrf_token() }}',
        //                 'email' : $('#signupEmail').val(),
        //                 'phone' : $('#phone').val(),
        //                 'otp' :  $('#enterOtp').val(),
        //             },
        //             success:function(data){
        //                 if(data.status == 1){
        //                     toastr.success(data.message);
        //                     $('#phone').prop('readonly',true);
        //                     $('#enterOtp').prop('readonly',true);
        //                     $('#sendOtpBtn').attr('disabled',true);
        //                     $('#verifyOtpBtn').attr('disabled',true);
        //                     $('#verifyOtpBtn').css('background-image','linear-gradient(to left, #7d9fc9, #79adbd)');
        //                     $('#pwd').css('display','block');
        //                     $('#confPwd').css('display','block');

        //                 }else{
        //                     toastr.error(data.message);
        //                 }
        //             },
        //             error:function(xhr, status, error){
        //                 if(xhr.status == 500 || xhr.status == 422){
        //                     toastr.error('Whoops! Something went wrong while sending OTP');
        //                 }
        //             }
        //         });
        //     }
            
        // });      
</script> --}}


<script>
    $(document).ready(function () {
        $("#applyForm").validate({
            rules: {
                   name: {
                        required: true,
                        maxlength: 20,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true
                    },
                   
                    gender: {
                        required: true,
                    },
                    dob: {
                        required: true,
                        date: true
                    },
                    total_experience_year: {
                        required: true,
                    },
                    education: {
                        required: true,
                        maxlength: 40,
                    },
                    board: {
                        required: true,
                    },
                    class: {
                        required: true,
                    },
                    subject: {
                        required: true,
                    },
                    hslc_percentage: {
                        required: true,
                    },
                    hs_percentage:{
                        required:true,
                    },
                    resume:{
                        required:true,
                    },
                    teacherdemovideo:{
                        required:true,
                    }
                },
                messages: {
                    name: {
                        required: "First name is required",
                        maxlength: "First name cannot be more than 20 characters",
                    },
                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                        maxlength: "Email cannot be more than 50 characters",
                    },
                    phone: {
                        required: "Phone number is required",
                        minlength: "Phone number must be of 10 digits",
                    },
                    gender: {
                        required:  "Please select the gender",
                    },
                    dateOfBirth: {
                        required: "Date of birth is required",
                        date: "Date of birth should be a valid date",
                    },
                    total_experience_year: {
                        required: "Total Experience is required",
                    },
                    education: {
                        required: "Maximum qualification is required",
                    },
                    board: {
                        required: "Board is required",
                    },
                    class: {
                        required: "Class is required",
                    },
                    subject: {
                        required: "Subject is required",
                    },
                    hslc_percentage: {
                        required: "Percentage is required",
                    },
                    hs_percentage: {
                        required: "Percentage is required",
                    },
                    resume:{
                        required:"Please upload your resume",
                    },
                    teacherdemovideo:{
                        required:"Please upload demo video",
                    }
                },
            //     submitHandler: function(form) {
            //     $.ajaxSetup({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         }
            //     });
            //     $.ajax({
            //         url: '{{route('teacher.store')}}' ,
            //         type: "POST",
            //         data: $('#applyForm').serialize(),
            //         success: function( response ) {
            //            console.log(response);
            //         }
            //     });
            //  });
    });
});
</script>
@endsection