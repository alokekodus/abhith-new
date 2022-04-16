@extends('layout.admin.layoout.admin')
@section('title', 'Course Management - Board')


@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-bulletin-board"></i>
            </span> All Exam Boards
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="#" class="btn btn-gradient-primary btn-fw" data-toggle="modal" data-target="#addExamBoardModal" data-backdrop="static" data-keyboard="false">Add Exam Board</a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="exam_board_table" class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th> # </th>
                                <th> Exam Board </th>
                                <th>Created At</th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($board as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$item->exam_board}}</td></td>
                                <td>{{$item->created_at->diffForHumans()}}</td>
                                <td>
                                    @if ($item->is_activate == 1)
                                        <label class="switch">
                                            <input type="checkbox" id="testingUpdate" data-id="{{ $item->id }}" checked>
                                            <span class="slider round"></span>
                                        </label>
                                    @else
                                        <label class="switch">
                                            <input type="checkbox" id="testingUpdate" data-id="{{ $item->id }}">
                                            <span class="slider round"></span>
                                        </label>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="addExamBoardModal">
        <div class="modal-dialog">
          <div class="modal-content" style="padding:1.5rem;background-color:#fff;">
            <div class="modal-body">
                <form id="addBoardForm">
                    @csrf
                    <div class="form-group">
                        <label for="">Add Exam Board</label>
                        <input type="text" name="examBoard" class="form-control" placeholder="e.g SEBA, ICSC, CBSE" required>
                    </div>
                    <div style="float: right;">
                        <button type="button" class="btn btn-md btn-default" id="addBoardCancelBtn">Cancel</button>
                        <button type="submit" class="btn btn-md btn-success" id="addBoardSubmitBtn">Submit</button>
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
            $('#exam_board_table').DataTable({
                "processing": true,
                "searching" : false,
                "ordering" : false
            });
        });

        //For modal cancel button
        $('#addBoardCancelBtn').on('click', function(){
            $('#addExamBoardModal').modal('hide');
            $('#addBoardForm')[0].reset();
        });

        //For adding a board
        $('#addBoardForm').on('submit', function(e){
            e.preventDefault();

            $('#addBoardSubmitBtn').attr('disabled', true);
            $('#addBoardSubmitBtn').text('Please wait...');
            $('#addBoardCancelBtn').attr('disabled', true);

            let formData = new FormData(this);
             $.ajax({
                url:"{{route('admin.course.management.add.board')}}",
                type:"POST",
                processData:false,
                contentType:false,
                data:formData,
                success:function(data){

                    if(data.error != null){
                        $.each(data.error, function(key ,val){
                            toastr.error(val[0]);
                        });
                        $('#addBoardSubmitBtn').attr('disabled', false);
                        $('#addBoardSubmitBtn').text('Submit');
                        $('#addBoardCancelBtn').attr('disabled', false);
                    }

                    if(data.status == 1){
                        toastr.success(data.message);
                        $('#addExamBoardModal').modal('hide');
                        location.reload(true);
                    }else{
                        toastr.error(data.message);
                        $('#addBoardSubmitBtn').attr('disabled', false);
                        $('#addBoardSubmitBtn').text('Submit');
                        $('#addBoardCancelBtn').attr('disabled', false);
                    }
                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Whoops! Something went wrong.');
                    }
                    $('#addBoardSubmitBtn').attr('disabled', false);
                    $('#addBoardSubmitBtn').text('Submit');
                    $('#addBoardCancelBtn').attr('disabled', false);
                }

             });
        })
    </script>
@endsection