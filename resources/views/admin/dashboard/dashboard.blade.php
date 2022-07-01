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
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Become a teacher</h4>
            <form class="forms-sample" id="applyForm" enctype="multipart/form-data" method="post"
                action="{{route('teacher.store')}}">
                @csrf
                <p class="card-description"> Personal Details </p>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" placeholder="Name" name="name"
                            value="{{auth()->user()->name}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                            value="{{auth()->user()->email}}">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone">Contact Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phone" placeholder="Contact number" name="phone"
                            value="{{auth()->user()->phone}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="gender">Gender <span class="text-danger">*</span></label>
                        <select class="form-control" id="gender" name="gender">
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dob"> Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" name="dob" id="dob" class="form-control" placeholder="Date of Birth"
                            name="dob">
                    </div>
                </div>

                <h4 class="card-title">Professional Details</h4>

                <div class="form-row">

                    <div class="form-group col-md-3">
                        <label for="inputCity">Total Experience Year </label>
                        <input type="text" class="form-control" id="total_experience_year" name="total_experience_year">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputCity">Total Experience Month</label>
                        <input type="text" class="form-control" id="total_experience_month"
                            name="total_experience_month">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleTextarea1">Highest Qualification<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="education" placeholder="Highest Qualification"
                            name="education">
                    </div>
                </div>



                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCity">Course applying for Board <span class="text-danger">*</span></label>
                        <select name="board_id" id="assignedBoard" class="form-control" onchange="changeBoard()">
                            <option value="">-- Select -- </option>
                            @forelse ($boards as $item)
                            <option value="{{$item->id}}" @isset($lesson)@if($lesson->board_id==$item->id) selected
                                @endif
                                @endisset>{{$item->exam_board}}</option>
                            @empty
                            <option>No boards to show</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">Class <span class="text-danger">*</span></label>
                        <select name="assign_class_id" id="board-class-dd" class="form-control">
                            <option value="">-- Select -- </option>

                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip">Subject <span class="text-danger">*</span></label>
                        <select name="assign_subject_id" id="board-subject-dd" class="form-control">
                            <option value="">-- Select -- </option>

                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="exampleTextarea1">10th Percentage <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="exampleInputCity1" placeholder="10th percentage"
                            name="hslc_percentage">
                    </div>
                    <div class="form-group col-6">
                        <label for="exampleTextarea1">12th Percentage <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="exampleInputCity1" placeholder="12th percentage"
                            name="hs_percentage">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="currentOrganization">Current organization </label>
                        <input type="text" class="form-control" id="currentOrganization"
                            placeholder="Current Organinzation" name="current_organization">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ciurrentDesignation">Current Designation </label>
                        <input type="text" class="form-control" id="currentDesignation"
                            placeholder="Current Designation" name="current_designation">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="currentCTC">Current CTC </label>
                        <input type="text" class="form-control" id="currentCTC" placeholder="Current CTC"
                            name="current_ctc">
                    </div>
                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label>Upload resume <span class="text-danger">*</span></label>
                            <input type="file" name="resume" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image" name="resume">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-gradient-primary"
                                        type="button">Upload</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleTextarea1">Upload any Demo video() <span class="text-danger">*</span></label>
                    <input type="file" name="teacherdemovideo" class="file-upload-default">
                    <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled
                            placeholder="Upload Demo Video" name="teacherdemovideo">
                        <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
        </div>
    </div>
</div>
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
                <h4 class="font-weight-normal mb-3">Weekly Sales <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">$ 15,0000</h2>
                <h6 class="card-text">Increased by 60%</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('asset_admin/images/dashboard/circle.svg') }}" class="card-img-absolute"
                    alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Weekly Orders <i
                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">45,6334</h2>
                <h6 class="card-text">Decreased by 10%</h6>
            </div>
        </div>
    </div>
    <div class="col-md-4 stretch-card grid-margin">
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
    </div>
</div>
@endif
@endsection
@section('scripts')
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
                }
            });
    });
</script>
@endsection