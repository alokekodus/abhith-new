@extends('layout.admin.layout.admin')

@section('title','Applied Teacher')

@section('head')
<style>
    @import url("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");

    table {
        border: 1px solid #f3f3f3;
        border-radius: 10px;
        box-shadow: 0px 5px 5px #efecec;
    }

    th {
        border-top: 0px !important;
    }

    #enrolled_students_table_filter {
        margin-top: -30px;
    }
</style>

@endsection

@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-format-list-bulleted"></i>
        </span>All Teacher Applications
    </h3>
</div>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive" style="overflow-x: auto;">
                <table id="all_applied_teacher" class="table table-bordered">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Email </th>
                            <th> Phone </th>
                            <th>Apply For </th>
                            <th>Total Exprience </th>
                            <th>10th %</th>
                            <th>12th %</th>
                            <th>Applyed Date</th>
                            <th>Action</th>
                            {{-- <th>Details</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $key => $item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->phone}}</td>
                            <td>{{$item->assign_board_id}}{{$item->assign_class_id}}{{$item->assign_subject_id}}</td>
                            <td> {{$item->total_experience_month}} {{$item->total_experience_month}}</td>
                            <td>{{$item->hslc_percentage}} %</td>
                            <td>{{$item->hs_percentage}} %</td>
                            <td>{{$item->updated_at->format('d-M-Y')}}</td>
                            {{-- <td><a href="#">view</a></td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <div style="float:right;margin-top:10px;">
                {{ $details->links() }}
            </div> --}}
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