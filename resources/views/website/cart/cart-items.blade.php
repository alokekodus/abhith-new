<li>
    <div class="col-3">
        @if($item->is_full_course_selected==1)
        <img src="https://image.freepik.com/free-vector/group-friends-giving-high-five_23-2148363170.jpg" alt=""
            class="course-type" style="height:50px;width:70px;" />
        @else
        <img src="https://image.freepik.com/free-vector/people-putting-puzzle-pieces-together_52683-28610.jpg" alt=""
            class="course-type" style="height:50px;width:70px;" />
        @endif
        {{-- <div class="cart-course-image1"><img src="" style="height:50px;width:70px;"></div> --}}
    </div>
    <div class="col-5">
        <h6 data-brackets-id="12020">Course Type: @if($item->is_full_course_selected==1)Full Course @else Custom Package
            @endif</h6>
        <h6 data-brackets-id="12020">Board: {{$item->board->exam_board??''}}</h6>
        <p>Class: {{$item->assignClass->class??''}}</p>
    </div>
    <div class="col-2">
        <div class="mt10"><a href="#" class="remove removeCartItem" data-id="{{$item->chapter_id??''}}">Remove</a></div>
    </div>
    <div class="col-2">
        <span class="course-price2" id="itemPrice"><i class="fa fa-inr" aria-hidden="true"></i>
            {{number_format($item->assignSubject->sum('amount')??'00',2,'.','')}}</span>
    </div>
</li>