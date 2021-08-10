@extends('layouts.app')

@section('content')

<div class="content">
    <div class="col-md-10 col-md-offset-1">
        @include('adminlte-templates::common.errors')
        <h1><i class='fa fa-key'></i> Update Country</h1>
        <br>

        <div class="box box-primary">
            {!! Form::model($pays, ['route' => ['pays.update', $pays->id], 'method' => 'PUT']) !!}
            <div class="box-body">
                @include('pays.fields')
            </div>

            <div class="box-footer">
                {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                <a href="{!! route('pays.index') !!}" class="btn btn-default">Cancel</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection