@extends('layouts.app')

@section('content')

    <div class="content col-md-10">
        <h1>{{ __('Modifier Categorie UE') }}</h1>

        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>

        <div class="box box-primary">
            {{ Form::open(['route' => ['catUes.update', $catUe], 'method' => 'patch']) }}
            <div class="box-body">

                <div class="form-group col-sm-8">
                    {!! Form::label('title', 'Titre :') !!}
                    {!! Form::text('title', $catUe->title, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('catUes.index') !!}" class="btn btn-default">Cancel</a>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection