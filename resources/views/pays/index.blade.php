@extends('layouts.app')

@section('content')

<div class="content">
    <div class="col-lg-10 col-lg-offset-1">
        @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <h1><i class="fa fa-pays"></i> Gérer les pays
            <a href="{{ route('pays.create') }}" class="btn btn-success">Ajouter un pays</a>
        </h1>
        <br>
        <hr>

        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom du pays</th>
                                <th>Code</th>
                                <th>Date d'ajout</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $countryCount = 1; @endphp
                            @foreach ($pays as $payi)
                            <tr>
                                <td>{{ $countryCount++ }}</td>
                                <td>{{ $payi->nom }}</td>
                                <td>{{ $payi->code }}</td>
                                <td>{{ $payi->created_at->format('F d, Y h:ia') }}</td>
                                <td>
                                    <a href="{{ route('pays.edit', $payi->id) }}" class="btn btn-warning">Edit</a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['pays.destroy', $payi->id] ]) !!}
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