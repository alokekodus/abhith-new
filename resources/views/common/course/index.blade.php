<div class="card">
    @foreach ($subjects as $key => $item)

    <blockquote class="blockquote blockquote-primary">


        <span style="float: right">
            <a href="" class="btn btn-gradient-primary p-2" title="Edit Subject"><i class="mdi mdi-pencil"></i></a>
            <a href="{{route('teacher.course.view',Crypt::encrypt($item->id))}}" class="btn btn-gradient-primary p-2"
                title="View Lesson Details"><i class="mdi mdi-eye"></i></a>
        </span>


        <div class="card-body">
            <div class="row">
                <div class="col-8">

                    <h5>SUBJECT:{{$item->subject_name}} &nbsp;&nbsp; ASSIGN CLASS: Class -
                        {{$item->assignClass->class}} -- {{$item->boards->exam_board}} Board </h5>

                    <h4 class="card-title text-info">AMOUNT: {{number_format($item->subject_amount,2,'.','')}} </h4>
                </div>
                <div class="col-4">
                    <h4 class="card-title text-info">TOTAL LESSON:{{$item->lesson()->count()}}</h4>
                    <h4><a href="{{route('teacher.subject.student',Crypt::encrypt($item->id))}}"><mark
                                class="bg-success text-white">
                                TOTAL STUDENTS: {{$item->assignOrder->count()}}</mark></a></h4>
                </div>
            </div>
        </div>

    </blockquote>

    @endforeach

</div>
<div class="card">
    <div style="text-align: center;">{{$subjects->links() }}</div>
</div>