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
{{--                        @if($apprenant->academic_year_id == $academicYear->id)--}}
{{--                            <tr>--}}
{{--                                <label for="contrat_id" class=" radio radio-inline">--}}
{{--                                    <td>{{ Form::radio('contrat_id', $apprenant->contrats->last()->id) }}</td>--}}
{{--                                    <td>{!! $apprenant->contrats->last()->academic_year->debut.'/'.$apprenant->contrats->last()->academic_year->fin !!}</td>--}}
{{--                                    <td>{!! $apprenant->contrats->last()->cycle->echeanciers->where('academic_year_id', $apprenant->contrats->last()->academic_year_id)->sum('montant') !!}</td>--}}
{{--                                    <td>{!! $apprenant->contrats->last()->specialite->slug. ' ' .$apprenant->contrats->last()->cycle->niveau !!}</td>--}}
{{--                                    <td>{!! $apprenant->contrats->last()->versements->sum('montant') !!}</td>--}}
{{--                                    <td></td>--}}
{{--                                    <td>{!! $apprenant->contrats->last()->cycle->echeanciers->where('academic_year_id', $apprenant->contrats->last()->academic_year_id)->sum('montant') - $apprenant->contrats->last()->versements->sum('montant') !!}</td>--}}
{{--                                </label>--}}
{{--                            </tr>--}}

{{--                        @else--}}
{{--                            @if($reinscription)--}}
{{--                                <tr>--}}
{{--                                    @if($apprenant->contrats->last()->resultatNominatif)--}}
{{--                                    <td>{{ Form::radio('apprenant_id', $apprenant->id) }}</td>--}}{{-- le champ reinscription s'il est envoyé sera enregistré comme apprenant --}}
{{--                                    <td>{{ $academicYear->debut. '/' .$academicYear->fin }}</td>--}}
{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                            ($apprenant->contrats->last()->resultatNominatif->next_cycle_id != 0) ?--}}
{{--                                                $apprenant->contrats->last()->resultatNominatif->cycle->echeanciers->where('academic_year_id', $apprenant->contrats->last()->academic_year_id)->sum('montant') :--}}
{{--                                                ''--}}
{{--                                        }}--}}
{{--                                    </td>--}}
{{--                                    <td>{{ $apprenant->contrats->last()->resultatNominatif->decision }}</td>--}}
{{--                                    <td></td>--}}
{{--                                    <td></td>--}}
{{--                                    <td></td>--}}
{{--                                    @else--}}
{{--                                        <td></td>--}}
{{--                                        <td>{{ $academicYear->debut. '/' .$academicYear->fin }}</td>--}}
{{--                                        <td colspan="5"><strong>Veuillez renseigner les resultats nominatifs</strong></td>--}}
{{--                                    @endif--}}
{{--                                </tr>--}}
{{--                            @endif--}}

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

{{--                        @endif--}}

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