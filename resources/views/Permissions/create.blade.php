@extends('layouts.app')

@section('content')
    <div class="content">
        <div class='col-md-10 col-md-offset-1'>
            @include('adminlte-templates::common.errors')
            <h1><i class='fa fa-key'></i> Create New Permission</h1>
            <br>

            <div class="box box-primary">
                <div class="box-body">
                    {!! Form::open(['route' => 'permissions.store']) !!}

                        @include('permissions.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection