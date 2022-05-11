@extends('layout.admin.layout.admin')

@section('title','Enquiry')

@section('head')
<style>
    @import url("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
    table{
        border: 1px solid #f3f3f3;
        border-radius: 10px;
        box-shadow: 0px 5px 5px #efecec;
    }
    th{
        border-top:0px !important;
    }
    #enrolled_students_table_filter{
        margin-top:-30px;
    }
</style>

@endsection

@section('content')

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-format-list-bulleted"></i>
            </span>Enquiry Details
        </h3>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive" style="overflow-x: auto;">
                    <table id="enquiry_table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Phone Number </th>
                                <th> Email </th>
                                <th> Message </th>
                                <th> Date of Enquiry </th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($details as $key => $item)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->message}}</td>
                                <td>{{$item->date_of_enquiry}}</td>
                                <td>
                                    @if ($item->marked_as_contacted == 0)
                                        <button class="btn btn-sm btn-success" id="markContact" data-id="{{$item->id}}" data-status="1">Mark as Reached</button>
                                    @else
                                       <h6 class="text-success">Reached</h6>
                                    @endif
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div style="float:right;margin-top:10px;">
                    {{  $details->links() }}
              </div> --}}
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
    <script>
         $(document).ready( function () {
            $('#enquiry_table').DataTable({
                "processing": true,
                dom: 'Bfrtip',
                buttons: [ 
                    'excel', 'pdf', 'print'
                ]
            });
        });


        $('#markContact').on('click',function(e){
            e.preventDefault();
            let enquiry_id = $('#markContact').data('id');
            let enquiry_status = $('#markContact').data('status');

            $('#markContact').text('Please wait...');
            $('#markContact').attr('disabled',true);
            $.ajax({
                url:"{{route('admin.mark.enquiry')}}",
                type:'POST',
                data:{
                    'enquiry_id':enquiry_id,
                    'enquiry_status':enquiry_status
                },
                success:function(data){
                    location.reload(true);
                },
                error:function(xhr, status, error){
                    if(xhr.status == 500 || xhr.status == 422){
                        toastr.error('Oops! Something went wrong.');
                        $('#markContact').text('Mark as Reached');
                        $('#markContact').attr('disabled',false);
                    }
                }
            });
        });
    </script>


@endsection
