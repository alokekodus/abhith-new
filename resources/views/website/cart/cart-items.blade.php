<li>
    <div class="col-lg-3 col-md-3 leftBlock">
        @if($item->is_full_course_selected==1)
        <img src="{{asset('asset_website/img/fullcourse.png')}}" alt="" class="course-type"
            style="height:68px;width:73px;" />
        @else
        <img src="{{asset('asset_website/img/custompackage.png')}}" alt="" class="course-type"
            style="height:68px;width:73px;" />
        @endif
        {{-- <div class="cart-course-image1"><img src="" style="height:50px;width:70px;"></div> --}}
    </div>
    <div class="col-lg-5 col-md-5 centerBlock">
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
    {{-- <div class="col-lg-2 col-md-2">
        
    </div> --}}
    <div class="col-lg-4 col-md-4 rightBlock">
        <div class="mt10">
            <a href="#" class="remove removeCartItem" data-id="{{$item->id??''}}">Remove</a>
        </div>
        <span class="course-price2" id="itemPrice"><i class="fa fa-inr" aria-hidden="true"></i>
            {{number_format($item->assignSubject->sum('amount')??'00',2,'.','')}}
        </span>
    </div>
</li>