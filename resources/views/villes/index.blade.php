@extends('layouts.app')

@section('content')

<div class="content">
    <div class="col-lg-10 col-lg-offset-1">
        @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <h1><i class="fa fa-users"></i> Gestion des Villes
            <a href="{{ route('villes.create') }}" class="btn btn-success">Ajouter une Ville</a>
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
                                <th>Ville</th>
                                <th>Code</th>
                                <th>Créée le</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $VillesCount = 1; @endphp
                            @foreach ($villes as $ville)
                            <tr>
                                <td>{{ $VillesCount++ }}</td>
                                <td>{{ $ville->nom }}</td>
                                <td>{{ $ville->code }}</td>
                                <td>{{ $ville->created_at->format('F d, Y h:ia') }}</td>
                                <td>
                                    <a href="{{ route('villes.edit', $ville->id) }}" class="btn btn-warning">Modifier</a>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['villes.destroy', $ville->id] ]) !!}
                                    {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
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