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
                <div class="">
                    <table class="table table-bordered table-responsive" id="moratoire-table">
                        <thead>
                        <tr>
                            <th>Nom et Prénom</th>
                            <th>Specialité</th>
                            <th>Année académique</th>
                            <th>Scolarité</th>
                            <th>Scolarité attendue</th>
                            <th>Montant versé</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($contrats as $contrat)
                            <tr>
                                @if(!$contrat->apprenant)
                                    {{ dd($contrat) }}
                                @else
                                    <td>{!! $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom !!}</td>
                                    <td>
                                        {!! $contrat->specialite->slug. ' ' .$contrat->cycle->niveau !!}
                                    </td>
                                    <td>{!! $contrat->academic_year->debut. '/' .$contrat->academic_year->fin !!}</td>
                                    <td>{!! $contrat->cycle->echeanciers->where('academic_year_id', $contrat->academic_year_id)->sum('montant') !!}</td>
                                    <td>{!! ($contrat->moratoire) ? $contrat->moratoires->where('date', '<=', Carbon\Carbon::today())->sum('montant') : $echeanciers->where('cycle_id', $contrat->cycle_id)->sum('montant') !!}</td>
                                    <td>{!! $contrat->versements->sum('montant') !!}</td>
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