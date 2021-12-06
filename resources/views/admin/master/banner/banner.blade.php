@extends('layout.admin.layoout.admin')

@section('title', 'Banner')

@section('content')

    <style>
        table {
            width: 100%;
        }

        .ten {
            width: 10%
        }

        .twenty {
            width: 20%;
        }

    </style>

    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-book"></i>
            </span> Banner
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('admin.create.banner') }}" class="btn btn-gradient-primary btn-fw">Add Banner</a>
                    {{-- <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i> --}}
                </li>
            </ul>
        </nav>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Banner List</h4>
                </p>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Banner name </th>
                                <th> Banner </th>
                                <th> Status </th>
                                <th> Description </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $key => $item)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {!! Illuminate\Support\Str::limit(strip_tags($item->name), $limit = 50, $end = '...') !!} </td>
                                    <td>
                                        <img src="{{ asset($item->banner_image) }}" alt="" srcset="">
                                    </td>
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
                                    <td>
                                        {{-- {!! $item->description !!} --}}
                                        {{-- {!! Illuminate\Support\Str::limit($item->description, 100, ' ...')!!} --}}
                                        {!! Illuminate\Support\Str::limit(strip_tags($item->description), $limit = 50, $end = '...') !!}
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.edit.banner', ['id' => \Crypt::encrypt($item->id)]) }}"
                                            class="btn btn-gradient-primary btn-rounded btn-icon anchor_rounded" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="mdi mdi-pencil-outline"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
    
                        </tbody>
                    </table>
                </div>
                <div style="float:right;margin-top:10px;">
                    {{$banners->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document.body).on('change', '#testingUpdate', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var user_id = $(this).data('id');
            // console.log(status);
            var formDat = {
                catId: user_id,
                active: status
            }
            // console.log(formDat);
            $.ajax({
                type: "post",

                url: "{{ route('admin.active.banner') }}",
                data: formDat,

                success: function(data) {
                    console.log(data)
                }
            });
        });
    </script>


@endsection
