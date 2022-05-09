<li>
    <div class="cart-course-image1"><img src="" style="height:50px;width:70px;"></div>
    <div class="cart-course-desc">
        <h6 data-brackets-id="12020">Course Type: @if($item->is_full_course_selected==1)Full Course @else Custom Package @endif</h6>
        <h6 data-brackets-id="12020">Board: {{$item->board->exam_board??''}}</h6>
        <p>Class: {{$item->assignClass->class??''}}</p>
        {{-- <div class="dropdown course-tooltip">
            <button class="dropbtn">Course Item Details<span><i class="fa fa-info-circle ml5" aria-hidden="true"></i></span></button>
            <div class="dropdown-content box arrow-top">
                <div class="scrollbar" id="style-1">
                    <div class="force-overflow">
                        <h6>Lessons</h6>
                        <ul class="list-inline tooltip-course-list">
                            <li>
                                <span class="star"><i class="fa fa-star" aria-hidden="true"></i></span>{{$item->chapter->name}}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
        <span class="course-price2" id="itemPrice"><i class="fa fa-inr" aria-hidden="true"></i> {{number_format($item->assignClass->subjects->sum('subject_amount')??'00',2,'.','')}}</span>
        <div class="mt10"><a href="#" class="remove removeCartItem" data-id="{{$item->chapter_id??''}}">Remove</a></div>
    </div>
</li>