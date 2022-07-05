@extends('layout.admin.layout.admin')

@section('title','Applied Teacher')

@section('head')
<style>
    @import url("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
</style>

@endsection

@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span>Teacher Details
    </h3>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="d-flex align-items-center me-4 text-muted font-weight-light">
                        <i class="mdi mdi-video icon-sm me-2"></i>
                        <span>Promo Video</span>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div id="videoAttach" class="tabcontent">
                            <video id="teacher-promo-video" class="video-js" controls preload="auto" width="900"
                                height="400" data-setup="{}">
                                <source src="{{asset($user_details->teacherdemovideo_url)}}" type="video/mp4" />
                            </video>
                        </div>
                    </div>

                </div>

            </div>
            <div class="card-footer">
                <a href="{{asset($user_details->resume_url)}}" class="btn btn-primary">View Resume</a>
                <a herf ="{{route('approved.teacher',Crypt::encrypt($user_details->id))}}" class="btn btn-primay" style="float: right">Approved For Become a Teacher</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <address class="text-primary">
                            <p class="font-weight-bold">Name: <span>{{$user_details->name}} </span></p>

                            <p class="font-weight-bold"> E-mail : {{$user_details->email}}</p>

                            <p class="font-weight-bold"> Phone :{{$user_details->phone}} </p>

                            <p class="font-weight-bold"> Gender : {{$user_details->gender}}</p>

                            <p class="font-weight-bold"> DOB : {{$user_details->dob}} </p>

                        </address>
                    </div>
                    <div class="col-md-4">
                        <address class="text-primary">
                            <p class="font-weight-bold"> Apply For :
                                {{$user_details->board->exam_board}}--Class{{$user_details->assignClass->class}}--{{$user_details->assignSubject}}
                            </p>
                            <p class="font-weight-bold"> </p>
                            <p> www.Purple.com </p>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <address>
                            <p class="font-weight-bold">Purple imc</p>
                            <p> 695 lsom Ave, </p>
                            <p> Suite 00 </p>
                            <p> San Francisco, CA 94107 </p>
                        </address>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection

@section('scripts')
<script>
    $(document).ready( function () {
            $('#all_applied_teacher').DataTable({
                "processing": true,
                dom: 'Bfrtip',
                buttons: [ 
                    'excel', 'pdf', 'print'
                ]
            });
        });
</script>
@endsection