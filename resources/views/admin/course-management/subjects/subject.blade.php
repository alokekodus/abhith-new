@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Subjects')

@section('content')
@section('head')
<style>
    .pagination {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        padding-left: 853px;
        list-style: none;
        border-radius: 0.25rem;
    }
</style>
@endsection
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> @if(auth()->user()->hasRole('Teacher')) All Assigned Subject @else All Subjects @endif
    </h3>
    @if(!auth()->user()->hasRole('Teacher'))
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{route('admin.course.management.subject.create')}}" class="btn btn-gradient-primary btn-fw"
                    data-backdrop="static" data-keyboard="false">Add Subject</a>
            </li>
        </ul>
    </nav>
    @endif
</div>

@include('common.course.index')
@endsection

@section('scripts')
<script>
    $('#assignSubjectCancelBtn').on('click', function(){
            $('#assignSubjectModal').modal('hide');
            $('#assignSubjectForm')[0].reset();
            $('.assignedClassdDiv').css('display', 'none');
            pond.removeFiles();
        });


        
        $('#subjectName').on('change', function(){
            if($(this).val().length > 0){
                $('.assignedClassdDiv').css('display', 'block');
            }
        });



       
        $('#assignSubjectForm').on('submit', function(e){
            e.preventDefault();

            $('#assignSubjectSubmitBtn').attr('disabled', true);
            $('#assignSubjectSubmitBtn').text('Please wait...');
            $('#assignSubjectCancelBtn').attr('disabled', true);


            let formData = new FormData(this);
            pondFiles = pond.getFiles();
            for (var i = 0; i < pondFiles.length; i++) {
                // append the blob file
                formData.append('subjectCoverPic', pondFiles[i].file);
            }

            $.ajax({
                url:"{{route('admin.course.management.subject.assign')}}",
                type:"POST",
                processData:false,
                contentType:false,
                data:formData,
                success:function(data){
                    console.log(data);
                    if(data.error != null){
                        $.each(data.error, function(key, val){
                            toastr.error(val[0]);
                        });
                        $('#assignSubjectSubmitBtn').attr('disabled', false);
                        $('#assignSubjectSubmitBtn').text('Submit');
                        $('#assignSubjectCancelBtn').attr('disabled', false);
                    }
                    if(data.status == 1){
                        toastr.success(data.message);
                        location.reload(true);
                    }else{
                        toastr.error(data.message);
                        $('#assignSubjectSubmitBtn').attr('disabled', false);
                        $('#assignSubjectSubmitBtn').text('Submit');
                        $('#assignSubjectCancelBtn').attr('disabled', false);
                    }
                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Whoops! Something went wrong failed to assign class');
                    }

                    $('#assignSubjectSubmitBtn').attr('disabled', false);
                    $('#assignSubjectSubmitBtn').text('Submit');
                    $('#assignSubjectCancelBtn').attr('disabled', false);
                }
            });
        });
        $(document.body).on('change', '#isPublish', function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var subject_id = $(this).data('id');
        // console.log(status);
        var formDat = {
            subjectId: subject_id,
            active: status
        }
        // console.log(formDat);
        $.ajax({
            type: "post",

            url: "{{ route('admin.active.subject') }}",
            data: formDat,

            success: function(data) {
                toastr.success(data.message);
            }
        });
    });
</script>
@endsection