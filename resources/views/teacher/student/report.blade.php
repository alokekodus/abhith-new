@extends('layout.admin.layout.admin')
@section('title', 'Student Management')
@section('head')
<style>
    <style>.panel-default>.panel-heading {
        color: #333;
        background-color: #fff;
        border-color: #e4e5e7;
        padding: 0;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .panel-default>.panel-heading a {
        display: block;
        padding: 10px 15px;
    }

    .panel-default>.panel-heading a:after {
        content: "";
        position: relative;
        top: 1px;
        font-weight: 400;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        float: right;
        transition: transform .25s linear;
        -webkit-transition: -webkit-transform .25s linear;
    }

    .panel-default>.panel-heading a[aria-expanded="true"] {
        background-color: #eee;
    }

    .panel-default>.panel-heading a[aria-expanded="true"]:after {
        content: "\2212";
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .panel-default>.panel-heading a[aria-expanded="false"]:after {
        content: "\002b";
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .panel-default>.topic-panel-heading {
        position: relative;
        color: #333;
        background-color: #fff;
        border-color: #e4e5e7;
        left: 40px;
        width: 95%;
        padding: 0;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .panel-default>.topic-panel-heading a {
        display: block;
        padding: 10px 15px;
    }

    .panel-default>.topic-panel-heading a:after {
        content: "";
        position: relative;
        top: 1px;
        font-weight: 400;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        float: right;
        transition: transform .25s linear;
        -webkit-transition: -webkit-transform .25s linear;
    }



    .panel-default>.topic-panel-heading a[aria-expanded="true"]:after {
        content: "\2212";
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .panel-default>.topic-panel-heading a[aria-expanded="false"]:after {
        content: "\002b";
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    /* //subtopic */
    .panel-default>.subtopic-panel-heading {
        position: relative;
        color: #333;
        background-color: #fff;
        border-color: #e4e5e7;
        left: 55px;
        width: 93%;
        padding: 0;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .panel-default>.subtopic-panel-heading a {
        display: block;
        padding: 10px 15px;
    }

    .panel-default>.subtopic-panel-heading a:after {
        content: "";
        position: relative;
        top: 1px;
        font-weight: 400;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        float: right;
        transition: transform .25s linear;
        -webkit-transition: -webkit-transform .25s linear;
    }



    .panel-default>.subtopic-panel-heading a[aria-expanded="true"]:after {
        content: "\2212";
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .panel-default>.subtopic-panel-heading a[aria-expanded="false"]:after {
        content: "\002b";
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .subject-dropdown {
        position: absolute;
        top: -38px;
        right: 0px;
    }
</style>
@endsection
@section('content')
<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-bulletin-board"></i>
        </span> Student Report
    </h3>

</div>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <blockquote class="blockquote blockquote-primary">

                            <h4 class="card-title"> SUBJECT : {{$assign_orders[0]->subject->subject_name}} <span
                                    style="float: right">STUDENT NAME: {{strtoupper($student->getFullName())}}</span>
                            </h4>
                            <hr>
                            <h4 class="card-title text-primary">All Content</h4>
                            @include('common.lesson.content')


                        </blockquote>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')

@endsection