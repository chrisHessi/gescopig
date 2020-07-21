@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="col-md 10 col-md-offset-1">
            <div class="clearfix"></div>

            @include('flash::message')

            <div class="clearfix"></div>
            <h1><i class="fa fa-key">Update Role</i></h1>
            <br>

            <div class="box box-primary">
                <div class="box-body">
                    {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}

                        @include('roles.fields')


                </div>
                <div class="box-footer">
                    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                    <a href="{!! route('roles.index') !!}" class="btn btn-default">Cancel</a>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection