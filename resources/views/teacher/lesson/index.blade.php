@extends('layout.admin.layout.admin')
@section('title', 'Course Management - Subjects')

@section('content')

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> All Lesson
    </h3>
</div>
<div class="card">
   
    @foreach($all_lessons as $key=>$lesson)
    
    @include('common.lesson.index')
    @endforeach

</div>

@endsection

@section('scripts')

@endsection