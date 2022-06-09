<div class="card">
    @foreach ($subjects as $key => $item)
    <div class="card-body">
        <blockquote class="blockquote blockquote-primary">
            <p>
               <span style="float: right"><td> <a href="" class="btn btn-gradient-primary p-2" title="Edit Subject"><i class="mdi mdi-pencil"></i></a> <a href="{{route('teacher.course.view',Crypt::encrypt($item->id))}}" class="btn btn-gradient-primary p-2" title="View Lesson Details"><i class="mdi mdi-eye"></i></a></span>
            <p>
            <h4 class="card-title text-info">SUBJECT:{{$item->subject_name}} &nbsp;&nbsp; ASSIGN CLASS: Class -
                {{$item->assignClass->class}} -- {{$item->boards->exam_board}} Board </h4><span style="float:right;">
                <h4 class="card-title text-info">TOTAL LESSON:{{$item->lesson()->count()}}</h4>
            </span></p>
            <p>
            <h4 class="card-title text-info">AMOUNT: {{number_format($item->subject_amount,2,'.','')}} </h4>
            </p>
            <footer class="blockquote-footer">TEACHER NAME : <mark class="bg-info text-white">
                    {{$item->assignTeacher->getFullName()}}</mark></footer>

        </blockquote>
    </div>
    @endforeach

</div>
