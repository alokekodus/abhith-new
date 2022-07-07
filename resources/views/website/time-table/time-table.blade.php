@extends('layout.website.website')

@section('title', 'Time Table')

@section('head')
<style>
    /* @import url("https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"); */
    table{
        border: 1px solid #f3f3f3;
        border-radius: 10px;
        box-shadow: 0px 5px 5px #efecec;
    }
    th{
        border-top:0px !important;
    }
</style>

@endsection

@section('content')

    <section class="time-table">
        <div class="container-fluid">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="time_table_website" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> Course Name </th>
                                        <th> Chapter Name </th>
                                        <th> Date </th>
                                        <th> Time</th>
                                        <th> Link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @forelse ($time_data as $key => $item)
                                            @foreach ($item as $key2 => $item2)
                                                <tr>
                                                    <td>@php echo $i; @endphp</td>
                                                    <td>{{$item2['course']['name']}}</td>
                                                    <td>{{$item2['chapter']['name']}}</td>
                                                    <td>{{$item2['date']}}</td>
                                                    <td>{{$item2['time']}}</td>
                                                    <td>
                                                        @if ($item2['zoom_link'] == null)
                                                            <p>Link not given</p>
                                                        @else
                                                            <a href="{{$item2['zoom_link']}}" style="color:green" target="_blank">Join Class</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php $i++; @endphp
                                            @endforeach
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="6">
                                                    @auth
                                                        <strong>Oops! No Time-Table Found.</strong>                                                
                                                    @endauth
                                                    @guest
                                                        <strong>Login to check time-table.</strong>  
                                                    @endguest
                                                </td>
                                            </tr>
                                            
                                        @endforelse
                                        
                                </tbody>
                            </table>
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
    <script>
        $(document).ready( function () {
            $('#time_table_website').DataTable({
                "processing": true,
                "searching":true,
            });
        });
    </script>
@endsection
