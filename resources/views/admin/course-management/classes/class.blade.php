@extends('layout.admin.layoout.admin')
@section('title', 'Course Management - Class')

@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-bulletin-board"></i>
            </span> All Classes
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#" class="btn btn-gradient-primary btn-fw" data-toggle="modal" data-target="#assignClassModal" data-backdrop="static" data-keyboard="false">Assign Class</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                   <table id="boardsTable" class="table table-bordered"> 
                        <thead class="thead-light">
                            <tr>
                                <td>#</td>
                                <td>Class</td>
                                <td>Assigned Exam Board</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assignedClass as $key => $item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->class}}</td>
                                    <td>{{$item['boards']['exam_board']}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal" id="assignClassModal">
        <div class="modal-dialog">
          <div class="modal-content" style="padding:1.5rem;background-color:#fff;">
            <div class="modal-body">
                <form id="assignClassForm">
                    @csrf
                    <div class="form-group">
                        <label for="">Select Class</label>
                        <select name="assignedClass" id="assignedClass" class="form-control">
                            <option value="">-- Select -- </option>
                            @for ($i = 1; $i < 13; $i++)
                                <option value="{{$i}}">Class {{$i}}</option>  
                            @endfor
                        </select>
                    </div>
                    <div class="form-group assignedBoardDiv" style="display:none;">
                        <label for="">Assigned to Board</label>
                        <select name="board" id="board" class="form-control">
                            <option value="">-- Select -- </option>
                            @forelse ($boards as $item)
                                <option value="{{$item->id}}">{{$item->exam_board}}</option>
                            @empty
                                <option  disabled>No boards to show</option>
                            @endforelse
                        </select>
                    </div>
                    <div style="float: right;">
                        <button type="button" class="btn btn-md btn-default" id="assignClassCancelBtn">Cancel</button>
                        <button type="submit" class="btn btn-md btn-success" id="assignClassSubmitBtn">Submit</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // For datatable
        $(document).ready( function () {
            $('#boardsTable').DataTable({
                "processing": true,
                "searching" : true,
                "ordering" : false
            });
        });

        //For hiding modal 
        $('#assignClassCancelBtn').on('click', function(){
            $('#assignClassModal').modal('hide');
            $('#assignClassForm')[0].reset();
            $('.assignedBoardDiv').css('display', 'none');
        });


        
        $('#assignedClass').on('change', function(){
            if($(this).val() > 0){
                $('.assignedBoardDiv').css('display', 'block');
            }
        });



        $('#assignClassForm').on('submit', function(e){
            e.preventDefault();

            $('#assignClassSubmitBtn').attr('disabled', true);
            $('#assignClassSubmitBtn').text('Please wait...');
            $('#assignClassCancelBtn').attr('disabled', true);


            let formData = new FormData(this);

            $.ajax({
                url:"{{route('admin.course.management.class.assign')}}",
                type:"POST",
                processData:false,
                contentType:false,
                data:formData,
                success:function(data){

                    if(data.error != null){
                        $.each(data.error, function(key, val){
                            toastr.error(val[0]);
                        });
                        $('#assignClassSubmitBtn').attr('disabled', false);
                        $('#assignClassSubmitBtn').text('Submit');
                        $('#assignClassCancelBtn').attr('disabled', false);
                    }
                    if(data.status == 1){
                        toastr.success(data.message);
                        location.reload(true);
                    }else{
                        toastr.error(data.message);
                        $('#assignClassSubmitBtn').attr('disabled', false);
                        $('#assignClassSubmitBtn').text('Submit');
                        $('#assignClassCancelBtn').attr('disabled', false);
                    }
                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Whoops! Something went wrong failed to assign class');
                    }

                    $('#assignClassSubmitBtn').attr('disabled', false);
                    $('#assignClassSubmitBtn').text('Submit');
                    $('#assignClassCancelBtn').attr('disabled', false);
                }
            });
        });
        
    </script>
@endsection