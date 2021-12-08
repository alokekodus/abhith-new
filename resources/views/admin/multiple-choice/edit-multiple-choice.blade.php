@extends('layout.admin.layoout.admin')

@section('title', 'Add Multiple Choice')

@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Multiple Choice Questions For - <q><cite> {{$details[0]['set']['set_name']}} </cite></q>. &nbsp;
                    @if ($details[0]['set']['is_activate'] == 1)
                       <span style="color:green">ACTIVE</span> 
                    @else
                        <span style="color:red">DEACTIVE</span> 
                    @endif
                </h4>
                <hr>
                <form action="#"  method="POST">
                    @csrf
                    @foreach ($details as $key => $item)
                        <ol style="list-style-type: none;">
                            <li>
                                <span style="font-weight:bold;font-size:15px;">{{$key + 1}}.</span> <span style="font-size:.9375rem;"> Question:</span>
                                <p style="margin-left:10px;margin-bottom:5px;font-weight:bold;">-> {{$item->question}}</p>
                                <p style="margin-left:10px;margin-bottom:5px;color:grey;">Options:</p>
                                <div class="sub-view-option">
                                    <p> i) {{$item->option_1}} </p>
                                    <p> ii) {{$item->option_2}} </p>
                                    <p> iii) {{$item->option_3}} </p>
                                    <p> iv) {{$item->option_4}} </p>
                                </div>
                                <p style="margin-left:20px;margin-bottom:5px;">Correct Answer -> {{$item->correct_answer}}</p>
                            </li>
                        </ol>
                        {{-- <div class="after-add-more">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputName1"> <span style="font-weight:bold;">{{$key + 1}}.</span> Question</label>
                                        <input type="text" class="form-control" name="question[]" value="{{$item->question}}" placeholder="e.g what is the unit of temperature ?" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Option 1</label>
                                        <input type="text" class="form-control" name="option1[]" value="{{$item->option_1}}" placeholder="e.g Celcius" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Option 2</label>
                                        <input type="text" class="form-control" name="option2[]" value="{{$item->option_2}}" placeholder="e.g Hertz" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Option 3</label>
                                        <input type="text" class="form-control" name="option3[]" value="{{$item->option_3}}" placeholder="e.g Pascal" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Option 4</label>
                                        <input type="text" class="form-control" name="option4[]" value="{{$item->option_4}}" placeholder="e.g Kelvin" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Correct Answer</label>
                                        <input type="text" class="form-control" name="correct_answer[]" value="{{$item->correct_answer}}" placeholder="e.g what is the unit of temperature ?" required>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    @endforeach
                    {{-- <div class="col-md-12">
                        <button class="btn btn-success"  id="addMoreMultipleChoice">Add More</button>
                        <button class="btn btn-primary">Submit</button>
                    </div> --}}
                </form>


                {{-- <div class="copy" style="display: none;">
                    <div class="control-group">
                        <hr>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label for="exampleInputName1">Question</label>
                                    <input type="text" class="form-control" name="question[]" placeholder="e.g what is the unit of temperature ?">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger" style="margin-top:23px;float:right;" id="removeMultipleChoice">remove</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Option 1</label>
                                    <input type="text" class="form-control" name="option1[]" placeholder="e.g Celcius">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Option 2</label>
                                    <input type="text" class="form-control" name="option2[]" placeholder="e.g Hertz">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Option 3</label>
                                    <input type="text" class="form-control" name="option3[]" placeholder="e.g Pascal">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="exampleInputName1">Option 4</label>
                                    <input type="text" class="form-control" name="option4[]" placeholder="e.g Kelvin">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputName1">Correct Answer</label>
                                    <input type="text" class="form-control" name="correct_answer[]" placeholder="e.g what is the unit of temperature ?" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function(){
            $('#addMoreMultipleChoice').click(function(e){
                e.preventDefault();
                let html = $(".copy").html();
                $(".after-add-more").last().append(html);
            });

            $("body").on("click","#removeMultipleChoice",function(){ 
                $(this).parents(".control-group").remove();
            });
        });
        
    </script>

    @if ( session('success'))
        <script>
            toastr.success("{!! session('success') !!}");
        </script>
    @endif

@endsection