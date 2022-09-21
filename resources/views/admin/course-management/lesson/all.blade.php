<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">

        <div class="card-header">
            All Lesson
            
        </div>
        {{-- <a href="" style="float:right" class="btn btn-gradient-primary btn-fw">All
            Subject</a> --}}
        <div class="card-body">
            <div style="overflow-x:auto;">
                <table class="table table-striped" id="lessonTable">
                    <thead>
                        <tr>
                            <th>#No</th>
                            <th> Lesson Name </th>
                            <th> Total Recources</th>
                            <th> Total Videos </th>
                            <th> Total Documents </th>
                            <th> Total Articles </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subject->lesson as $key=>$lesson)
                        <tr>
                            <td>{{++$key}}</td>
                            <td style="text-align: center">{{$lesson->name}} </td>
                            <td><span class="badge rounded-pill bg-danger">
                                    {{$lesson->topics->count()}}
                                </span><a
                                    href="{{route('admin.course.management.lesson.topic.create',Crypt::encrypt($lesson->id))}}">
                                    Add Recources
                                </a>
                            </td>
                            <td style="text-align: center"> {{$lesson->topics->where('type',2)->count()}} </td>
                            <td style="text-align: center">{{$lesson->topics->where('type',1)->count()}} </td>
                            <td style="text-align: center">{{$lesson->topics->where('type',3)->count()}}</td>
                            <td style="text-align: center"><a  href="{{route('admin.course.management.lesson.edit',Crypt::encrypt($lesson->id))}}" title="Edit Lesson"><i
                                        class="mdi mdi-grease-pencil"></i></a>
                                <a href="{{route('admin.course.management.lesson.topic.display',Crypt::encrypt($lesson->id))}}"
                                    title="View Details"><i class="mdi mdi-eye"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>