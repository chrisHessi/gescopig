@extends('layouts.app')

@section('content')

    <section class="content-header">

    </section>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive table-bordered" id="resultat-table">
                    <thead>
                    <tr>
                        <th rowspan="3">Nom et prenom</th>
                        <th colspan="4" class="text-center">Semestres</th>
                        <th rowspan="3" class="text-center">Decision</th>
                    </tr>
                    <tr>
                        <th colspan="2" class="text-center">{{ $contrats->first()->cycle->semestres->first()->title }}</th>
                        <th colspan="2" class="text-center">{{ $contrats->first()->cycle->semestres->last()->title }}</th>
                    </tr>
                    <tr>
                        <th>Credit</th>
                        <th>Validation</th>
                        <th>Credit</th>
                        <th>Validation</th>
                    </tr>

                    </thead>

                    <tbody>
                    {{ Form::open(['route' => ['resultatNominatifs.store']]) }}
                    @foreach($contrats as $contrat)
                        <tr>
                            <td>{!! $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom !!}</td>
                            @foreach($contrat->semestre_infos as $semestreInfo)
                                <td>{!! $semestreInfo->creditObt !!}</td>
                                <td>{!! ($semestreInfo->mention != 'Non Validé') ? 'V' : 'NV' !!}</td>
                            @endforeach
                            @if(!$contrat->semestre_infos->first())
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            @endif
                            <td>
                                {!! Form::select($contrat->id, [0 => 'Redouble', 1 => 'Admis(e)', 2 => 'Admis(e) par Enjambement' ], null, ['class' => 'form-control']) !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary pull-right']) !!}
                    <a href="{!! route('resultatNominatifs.search', 1) !!}" class="btn btn-default pull-right">Cancel</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>

@endsection