@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Liste des scolarités
        </h1>
    </section>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                {!! Form::open(['route' => 'scolarites.filter' ]) !!}
                    <div class="form-group col-sm-4">
                        {{ Form::label('year', 'Année académique') }}
                        {!! Form::select('year',$filterYears,null,['class' => 'form-control', 'placeholder' => 'Année académique', 'id'=>'year']) !!}
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('specialite', 'Spécialité') }}
                        {!! Form::select('specialite',$filterSpecialites,null,['class' => 'form-control', 'placeholder' => 'Specialite', 'id'=>'specialite']) !!}
                    </div>
                    <div class="form-group col-sm-4">
                        {{ Form::label('cycle', 'Cycle') }}
                        {!! Form::select('cycle',$filterCycles,null,['class' => 'form-control', 'placeholder' => 'Cycle', 'id'=>'cycle']) !!}
                    </div>
                    <div class="form-group col-sm-12">
                        {!! Form::submit('filtrer', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('scolarites.inscrits') !!}" class="btn btn-default">Cancel</a>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="">
                    <table class="table table-bordered table-responsive" id="moratoire-table">
                        <thead>
                        <tr>
                            <th>Matricule</th>
                            <th>Nom et Prénom</th>
                            <th>Specialité</th>
                            <th>Année académique</th>
                            <th>Scolarité</th>
                            <th>Frais supp.</th>
                            <th>Bourse/Reduction</th>
                            <th>Scolarité attendue</th>
                            <th>Montant versé</th>
                            <th>Solde</th>
                            <th>Statut</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($contrats as $contrat)
                            <tr>
                                @if(!$contrat->apprenant)
                                    <td>Apprenant au contrat N°{{ $contrat->id }} a été supprimé de la BD</td>
                                @else
                                    <td>{!! $contrat->apprenant->matricule !!}</td>
                                    <td>{!! $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom !!}</td>
                                    <td>
                                        {!! $contrat->specialite->slug. ' ' .$contrat->cycle->niveau !!}
                                    </td>
                                    <td>{!! $contrat->academic_year->debut. '/' .$contrat->academic_year->fin !!}</td>
                                    <td>{!! $contrat->cycle->echeanciers->where('academic_year_id', $contrat->academic_year_id)->sum('montant') + ($contrat->corkages->first() ? $contrat->corkages->where('reduction', 1)->sum('montant') : 0) !!}</td>
                                    <td>{{ ($contrat->corkages->first()) ? $contrat->corkages->where('reduction', false)->sum('montant') : 0 }}</td>
                                    <td>{{ ($contrat->corkages->first()) ? -$contrat->corkages->where('reduction', true)->sum('montant') : 0 }}</td>
                                    <td>{!! ($contrat->moratoire) ? $contrat->moratoires->where('date', '<=', Carbon\Carbon::today())->sum('montant') : $echeanciers->where('cycle_id', $contrat->cycle_id)->sum('montant') !!}</td>
                                    <td>{!! $contrat->versements->sum('montant') !!}</td>
                                    <td>
                                        {!! $contrat->cycle->echeanciers->where('academic_year_id', $contrat->academic_year_id)->sum('montant') 
                                            - $contrat->versements->sum('montant') + ($contrat->corkages->first() ? $contrat->corkages->sum('montant') : 0) 
                                        !!}
                                    </td>
                                    <td>{!! $contrat->state !!}</td>
                                    
                                @endif
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>

    <script>
        $(function() {
            var table = $('#moratoire-table').DataTable({
                responsive: true,
                dom:'Blfrtip',
                buttons:[
                    'copy', 'excel', 'pdf'
                ],
                "columnDefs":[
                    // {"orderable":false, "targets":2}
                ]
            });
            table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container() ))
        });
    </script>

@endsection

@section('css')
    {{--    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">--}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.css"/>
@endsection