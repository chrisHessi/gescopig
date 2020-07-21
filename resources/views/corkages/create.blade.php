@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>

    @include('adminlte-templates::common.errors')

    <div class="clearfix"></div>

    <section class="content-header">
        <h1>
            Autres frais {{ $apprenant->nom. ' ' .$apprenant->prenom }}
        </h1>
    </section>
    <div class="content">
        {{ Form::open(['route' => ['corkages.store']]) }}
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group col-sm-4">
                    {!! Form::label('title', 'Libellé:') !!}
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('montant', 'Montant:') !!}
                    {!! Form::number('montant', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('reduction', 'Reduction?:') !!}
                    {!! Form::select('reduction', [1 => 'OUI', 0 => 'NON'], null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Annee Academique</th>
                        <th>Specialité</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($apprenant->contrats as $contrat)
                        <tr>
                            <label for="">
                                <td>{{ Form::radio('contrat_id', $contrat->id) }}</td>
                                <td>{{ $contrat->academic_year->debut. '/' .$contrat->academic_year->fin }}</td>
                                <td>{{ $contrat->specialite->slug. ' ' .$contrat->cycle->niveau }}</td>
                            </label>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('corkages.index') !!}" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('css/build.css') }}">
@endsection