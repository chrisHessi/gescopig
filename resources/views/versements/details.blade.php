@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>

    @include('adminlte-templates::common.errors')

    <div class="clearfix"></div>

    <section class="content-header">
        <h1>
            Versements des scolarites {{ $apprenant->nom. ' ' .$apprenant->prenom }}
        </h1>
    </section>
    <div class="content">
        {{ Form::open(['route' => ['versements.store', $apprenant->id]]) }}
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group col-sm-4">
                    {!! Form::label('montant', 'Montant:') !!}
                    {!! Form::number('montant', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('motif', 'Motif:') !!}
                    {!! Form::text('motif', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table bordered">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Annee Academique</th>
                        <th>Montant scolarite</th>
                        <th>Frais supp.</th>
                        <th>Bourse/Reduction</th>
                        <th>Admis en</th>
                        <th>Montant Versé</th>
                        <th>Solde</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($apprenant->contrats as $contrat)
                            <tr>
                                <label for="">
                                    <td>{{ Form::radio('contrat_id', $contrat->id) }}</td>
                                    <td>{{ $contrat->academic_year->debut. '/' .$contrat->academic_year->fin }}</td>
                                    <td>{{ ($contrat->cycle->echeanciers->where('academic_year_id', $contrat->academic_year_id)) ? $contrat->cycle->echeanciers->where('academic_year_id', $contrat->academic_year_id)->sum('montant') : 'Echeanciers non renseignés' }}</td>
                                    <td>{{ ($contrat->corkages->first()) ? $contrat->corkages->where('reduction', false)->sum('montant') : 0 }}</td>
                                    <td>{{ ($contrat->corkages->first()) ? -$contrat->corkages->where('reduction', true)->sum('montant') : 0 }}</td>
                                    <td>{{ $contrat->specialite->slug. ' ' .$contrat->cycle->niveau }}</td>
                                    <td>{{ ($contrat->versements) ? $contrat->versements->sum('montant') : 0 }}</td>
                                    <td>{!! $contrat->cycle->echeanciers->where('academic_year_id', $contrat->academic_year_id)->sum('montant') 
                                            - $contrat->versements->sum('montant') + ($contrat->corkages->first() ? $contrat->corkages->sum('montant') : 0) !!}</td>
                                    <td>
                                        <div class='btn-group'>
                                            <a href="{!! route('versements.show', [$contrat->id]) !!}" class='btn btn-default btn-xs'>Details<i class="glyphicon glyphicon-eye-open"></i></a>
                                        </div>
                                    </td>
                                </label>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('versements.listeApprenants') !!}" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('css/build.css') }}">
@endsection