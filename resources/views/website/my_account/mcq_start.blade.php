@extends('layout.website.website')

@section('title', 'My Account')

@section('head')
<link href="{{asset('asset_website/css/my_account.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    main {
        margin: 0;
    }
</style>
@endsection

@section('content')

<div class="mcq-head  d-flex">
    <div class="mcq-head-text d-flex">
        <div class="mcq-head-icon mr-3">
            <img src="{{asset('asset_website/img/mcq.png')}}" alt="">
        </div>
        <div class="mcq-header-text">
            <h3>Multiple Choice Questions For Class {{$set->assignClass->class}} {{$set->subject_name}}
                <span>{{$set->board->exam_board}} Board</span>
            </h3>
            <p><span class="mcq_question_number"></span></p>
        </div>
    </div>
    <div class="mcq-cross-icon">
        <a href="{{route('website.subject.mcqresult')}}" type="button" class="btn">Submit Test</a>
    </div>
</div>
<div class="container-fluid" id="mcq-question">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="mcq-question">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
@section('scripts')
<script>
 $(document).ready(function() {
        var page=1;
        var set_id=@json($set['id']);
        var last=@json($total_question);
        getQuestion(page,set_id,last)
});

function nextQuestion(current_page) {
    var current_page=current_page;
    var ele = document.getElementsByName('question_option');
    var page=current_page+1;
    var set_id=@json($set['id']);  
    var last=@json($total_question);
    getQuestion(page,set_id,last);
}

function getQuestion(page,set_id,last){
    
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });
       

        $.ajax({
                url: "{{ route('website.subject.mcqgetquestion') }}" ,
                type: "POST",
                data: {
                    "page": page,
                    "set_id":set_id,
                    
                    },
                 success: function( response ) {
                        var code=response.result.code;
                        var result=response.result.result;
                                      
                if(code==200){
                            var question_option=result.mcq_question.options;
                            var mcq_question=``;
                            var mcq_button=``;

            mcq_question = `<h4>Question ${result.page}: ${result.mcq_question.question}</h4>
                            <form action="" class="mcq-options d-flex">
                                <div class="mcq-option-text">
                                    <h5>Option:</h5>
                                </div>
                                <div class="mcq-option-div">
                                    <div class="options">
                                        <input type="radio" id="html" name="question_option" value="${question_option[0]}" required>
                                    <label for="html">${question_option[0]}</label>
                                    </div>
                                    <div class="options">
                                        <input type="radio" id="css" name="question_option" value="${question_option[1]}" required>
                                        <label for="css">${question_option[1]}</label>
                                    </div>
                                    <div class="options">
                                        <input type="radio" id="javascript" name="question_option" value="${question_option[2]}" required>
                                        <label for="javascript">${question_option[2]}</label>
                                    </div>
                                    <div class="options">
                                        <input type="radio" id="jQuery" name="question_option" value="${question_option[3]}" required>
                                        <label for="jQuery">${question_option[3]}</label>
                                    </div>
                                </div>
                            </form>
                            <div class="mcq-button"></div>
                           `;
            
            
                            $('.mcq-question').html(mcq_question);
            if(page==last){
                mcq_button=` <div class="mcq-submit-btn d-flex">
                                <div class="mcq-submit">
                                    <button type="button" class="btn btn-outline-success mcq-btn-width mr-2">Skip</button>
                                </div>
                            </div>`;
                            $('.mcq-button').html(mcq_button);
            }else{
                mcq_button=` <div class="mcq-submit-btn d-flex">
                                <div class="mcq-submit">
                                    <button type="button" class="btn btn-outline-success mcq-btn-width mr-2">Skip</button>
                                </div>
                                <div class="mcq-next">
                                    <button type="button" class="btn btn-primary mcq-btn-width" onclick="nextQuestion(${result.page})">Next</button>
                                </div>
                            </div>`;
                            $('.mcq-button').html(mcq_button);
                





            }
            

                            }
                                       
                         }
            });  
          
}
</script>
@endsection