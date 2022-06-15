@extends('layout.admin.layout.admin')
@section('title', 'Student Management')

@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> All Students
    </h3>

</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"></h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Name </th>
                                        <th> Package Type</th>
                                        <th> Payment Date </th>
                                        <th> Price </th>
                                        <th> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($assign_orders as $key=>$assign_order)
                                    <tr>
                                        <td>
                                            <img src="assets/images/faces/face1.jpg" class="me-2" alt="">
                                            {{$assign_order->order->user->getFullName()}}
                                        </td>
                                        <td>@if($assign_order->order->is_full_course_selected==1)<label
                                                class="badge badge-gradient-success">Full Package</label> @else <label
                                                class="badge badge-gradient-warning"> Customized Package </label> @endif
                                        </td>

                                        <td>{{dateFormat($assign_order->order->created_at,"F j, Y, g:i a")}}
                                        </td>
                                        <td> Rs. {{number_format((float)$assign_order->amount, 2, '.', '') }} </td>
                                        <td><label class="badge badge-gradient-info">  PROGRESS DETAILS <i class="mdi mdi-eye"></i> </label> </td>
                                    </tr>
                                    
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')

@endsection