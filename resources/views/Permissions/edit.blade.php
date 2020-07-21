@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="col-md 10 col-md-offset-1">
            @include('adminlte-templates::common.errors')
            <h1><i class="fa fa-key">Update Permission</i></h1>
            <br>

            <div class="box box-primary">
                <div class="box-body">
                    {!! Form::model($permission, ['route' => ['permissions.update', $permission->id], 'method' => 'patch']) !!}

                        @include('permissions.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection