@extends('layouts.app')

@section('content')

<div class="content">
    <div class="col-md-10 col-md-offset-1">
        @include('adminlte-templates::common.errors')
        <h1><i class='fa fa-key'></i> Créer une nouvelle Ville</h1>
        <br>

        <div class="box box-primary">
            {!! Form::open(['route' => 'villes.store']) !!}
            <div class="box-body">
                @include('villes.fields')
            </div>

            <div class="box-footer">
                {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                <a href="{!! route('villes.index') !!}" class="btn btn-default">Cancel</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection