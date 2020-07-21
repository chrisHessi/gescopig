@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="col-lg 10 col-lg-offset-1">
            @include('adminlte-templates::common.errors')
            <h1><i class="fa fa-key"></i>
                Roles Management
                <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Users</a>
                <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a>
                <a href="{{ URL::to('roles/create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add Role</a>
            </h1>
            <hr>

            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
                                    <td>
                                        <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-warning pull-left">Edit</a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection