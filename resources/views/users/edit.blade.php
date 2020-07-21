@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="col-md-10 col-md-offset-1">
            @include('adminlte-templates::common.errors')
            <h1><i class='fa fa-key'></i> Update User</h1>
            <br>

            <div class="box box-primary">
                {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}
                <div class="box-body">
                    @include('users.fields')
                </div>

                <div class="box-footer">
                    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section('css')
    <style type="text/css">
        .checkbox{
            width: 20px;
            height: 20px;

        }
    </style>
@endsection