
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">All Lesson</h4>
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
                        <td>{{$lesson->name}} </td>
                        <td>{{$lesson->topics->count()}}<a
                                href="{{route('admin.course.management.lesson.topic.create',Crypt::encrypt($lesson->id))}}">
                                Add Recources
                            </a>
                        </td>
                        <td> {{$lesson->topics->where('type',2)->count()}} </td>
                        <td>{{$lesson->topics->where('type',1)->count()}} </td>
                        <td>{{$lesson->topics->where('type',3)->count()}}</td>
                        <td><a href="" title="Edit Lesson"><i class="mdi mdi-grease-pencil"></i></a>
                            <a href="{{route('admin.course.management.lesson.topic.display',Crypt::encrypt($lesson->id))}}" title="View Details"><i class="mdi mdi-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
