<div class="container-fluid" id="detailsPage">
    <div>
        <div class="topic-content-heading">
            <h2>Subject:{{$subject->subject_name}}</h2>
        </div>
        <div class="topic-content-body">


            <div class="container lessonContent" id="articles">
                <div class="topic-content-sub-heading mt-4">
                    <h3>Lessons</h3>
                </div>
                <div class="row">
                    @php
                    $test = 12;
                    @endphp
                     @foreach($subject->lesson as $key=>$lesson)
                     <div class="article-div d-flex">
                         <div class="article-img">
                             <img src="{{asset('asset_website/img/docs.png')}}" alt="">
                         </div>
                         <div class="article-content">
                             <h5> {{$lesson->name}}</h5>
                             <p>Document:|Video:{{lessonTotalVideo($lesson->id)}}|Article:{{lessonTotalArticle($lesson->id)}}|Practice Test| Teacher</p>
                         </div>
                     </div>
                     @endforeach
            </div>
        </div>


    </div>
</div>