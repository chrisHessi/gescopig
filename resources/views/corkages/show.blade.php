@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>

    @include('adminlte-templates::common.errors')

    <div class="clearfix"></div>

    <section class="content-header">
        <h1>
            Autres frais de {{ $apprenant->nom. ' ' .$apprenant->prenom }}
        </h1>
    </section>
    <div class="content">
        @foreach($apprenant->contrats as $contrat)
            <div class="box box-primary">
                <div class="box-header">
                    <h3>{{ $contrat->academic_year->debut. '/' .$contrat->academic_year->fin }}</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Intitulé</th>
                            <th>Montant</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($contrat->corkages as $corkage)
                                <tr>
                                    <td>{{ $corkage->title }}</td>
                                    <td>{{ $corkage->reduction ? -$corkage->montant : $corkage->montant }}</td>
                                    {!! Form::open(['route' => ['corkages.destroy', $corkage->id], 'method' => 'delete']) !!}
                                    <td>
                                        <a href="{!! route('corkages.edit', [$corkage->id]) !!}" class="btn btn-default">modifier <i class="glyphicon glyphicon-edit"></i></a>
                                        @can('delete corkages')
                                            {!! Form::button('Effacer <i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger ', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                        @endcan
                                    </td>
                                    {!! Form::close() !!}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    <div class="form-group col-sm-12">
                        <a href="{!! route('corkages.index') !!}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('css/build.css') }}">
@endsection