<div class="row">
    <div class="col-4">
        <h6>Board: {{$item->board->exam_board??''}} Class: {{$item->assignClass->class??''}}</h6>
        <h6> Course Type:
            @if($item->is_full_course_selected==1)Full Course
            @else Custom Package
            @endif
            <span data-toggle="tooltip" data-html="true" title="<ol>
                     @foreach($item->assignSubject as $key=>$subject)
                        <li>{{$subject->subject->subject_name??''}} (RS:  {{number_format($subject->amount,2,'.','')}} )</li>
                             @endforeach </ol>">
                <i class="fa fa-info-circle" aria-hidden="true" style="color:#076fef"></i>
            </span>
        </h6>
    </div>
    <div class="col-4">
        <i class="fa fa-inr" aria-hidden="true"></i>
        {{number_format($item->assignSubject->sum('amount')??'00',2,'.','')}}
    </div>
    <div class="col-4">
        <a href="#" class="remove removeCartItem" data-id="{{$item->id??''}}">Remove</a>
    </div>
</div>
{{-- <div class="col-lg-4">
    <h6> Course Type:
        @if($item->is_full_course_selected==1)Full Course
        @else Custom Package
        @endif
        <span data-toggle="tooltip" data-html="true" title="<ol>
                 @foreach($item->assignSubject as $key=>$subject)
                    <li>{{$subject->subject->subject_name??''}} (RS:  {{number_format($subject->amount,2,'.','')}} )</li>
                         @endforeach </ol>">
            <i class="fa fa-info-circle" aria-hidden="true" style="color:#076fef"></i>
        </span>
    </h6>
    <h6>Board: {{$item->board->exam_board??''}}Class: {{$item->assignClass->class??''}}</h6>
</div>

<div class="col-lg-3 course-price2" id="itemPrice"><i class="fa fa-inr" aria-hidden="true"></i>
    {{number_format($item->assignSubject->sum('amount')??'00',2,'.','')}}
</div>
<div class="col-lg-3">
    <a href="#" class="remove removeCartItem" data-id="{{$item->id??''}}">Remove</a>
</div>
{{-- <div class="col-lg-2 col-md-2">

</div> --}}
<div class="col-lg-4 col-md-4 rightBlock">

</div> 