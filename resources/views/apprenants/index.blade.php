@extends('layouts.app')

{{--@section('css')--}}
    {{--<link rel="stylesheet" href="//cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">--}}
    {{--<style>--}}
        {{--.panel-table .panel-body{--}}
            {{--padding:0;--}}
        {{--}--}}

        {{--.panel-table .panel-body .table-bordered{--}}
            {{--border-style: none;--}}
            {{--margin:0;--}}
        {{--}--}}

        {{--.panel-table .panel-body .table-bordered > thead > tr > th {--}}
            {{--text-align:center;--}}
            {{--/*width: 100px;*/--}}
        {{--}--}}

        {{--.panel-table .panel-body .table-bordered > thead > tr > th:last-of-type,--}}
        {{--.panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {--}}
            {{--border-right: 0px;--}}
        {{--}--}}

        {{--.panel-table .panel-body .table-bordered > tbody > tr > td{--}}
            {{--text-align: center;--}}
        {{--}--}}

        {{--.glyphicon{--}}
            {{--font-size:75%;--}}
        {{--}--}}

        {{--.panel-table .panel-body .table-bordered > thead > tr > th:first-of-type,--}}
        {{--.panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {--}}
            {{--border-left: 0px;--}}
        {{--}--}}

        {{--.panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td{--}}
            {{--border-bottom: 0px;--}}
        {{--}--}}

        {{--.panel-table .panel-body .table-bordered > thead > tr:first-of-type > th{--}}
            {{--border-top: 0px;--}}
        {{--}--}}

        {{--.panel-table .panel-footer .pagination{--}}
            {{--margin:0;--}}
        {{--}--}}
        {{--/*--}}
        {{--used to vertically center elements, may need modification if you're not using default sizes.--}}
        {{--*/--}}
        {{--.panel-table .panel-footer .col{--}}
            {{--line-height: 34px;--}}
            {{--height: 34px;--}}
        {{--}--}}

        {{--.panel-table .panel-heading .col h3{--}}
            {{--line-height: 30px;--}}
            {{--height: 30px;--}}
        {{--}--}}

        {{--.panel-table .panel-body .table-bordered > tbody > tr > td{--}}
            {{--line-height: 34px;--}}
        {{--}--}}


    {{--</style>--}}

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Apprenants</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('apprenants.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group pull-right">

                </div>
                @include('apprenants.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="clearfix"></div>--}}
                {{--@include('flash::message')--}}
            {{--<div class="clearfix"></div>--}}
            {{--<div class="col-md-11 ">--}}
                {{--<div class="panel panel-default panel-table">--}}
                    {{--<div class="panel-heading">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col col-xs-6">--}}
                                {{--<h1 class="pull-left">Apprenants</h1>--}}
                            {{--</div>--}}
                            {{--<div class="col col-xs-6 text-right">--}}
                                {{--<h1 class="pull-right">--}}
                                {{--<a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('apprenants.create') !!}">Add New</a>--}}
                                {{--</h1>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

            {{--@include('apprenants.table')--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection



