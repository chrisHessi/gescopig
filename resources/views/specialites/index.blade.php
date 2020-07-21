@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Specialites</h1>
        <h1 class="pull-right">
            @can('create specialites')
                <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('specialites.create') !!}">Ajouter spéciaites</a>
            @endcan
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                    @include('specialites.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/angular/specialite.js')}}"></script>
@endsection

