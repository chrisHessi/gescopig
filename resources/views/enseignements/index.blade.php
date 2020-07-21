@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Enseignements</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('enseignements.search',[1]) !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                {{--<div class="form-group pull-right">--}}
                    {{--<input type="text" class="search form-control" placeholder="Search here..."/>--}}
                {{--</div>--}}
                @include('enseignements.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

