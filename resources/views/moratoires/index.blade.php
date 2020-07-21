@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Liste des Moratoires {{ $contrats->first()->academic_year->debut. '/' .$contrats->first()->academic_year->fin }}
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
                            <th>Nom et Prenom</th>
                            <th>Spécialité</th>
                            <th>Details Moratoire</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($contrats as $contrat)
                            <tr>
                                <td>{!! $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom !!}</td>
                                <td>{!! $contrat->specialite->slug. ' ' .$contrat->cycle->niveau !!}</td>
                                <td>
                                    <ul>
                                        @foreach($contrat->moratoires as $moratoire)
                                            <li><strong>{{ $moratoire->date->format('d/m/Y'). ' : ' .$moratoire->montant }}</strong></li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    @can('create moratoires')
                                    <a href="{{ route('moratoires.create', $contrat->id) }}" class="btn btn-primary" title="ajouter"><i class="fa fa-plus"></i></a>
                                    @if($contrat->moratoire)
                                        <a href="{{ route('moratoires.edit',[$contrat->id]) }}" class="btn btn-warning" title="modifier"><i class="fa fa-pencil"></i></a>
                                    @endif
                                    @endcan
                                </td>
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
        $(document).ready(function() {
            var table = $('#moratoire-table').DataTable({
                responsive: true,
                dom:'Blfrtip',
                buttons:[
                    'copy', 'excel', 'pdf'
                ],
                "columnDefs":[
                    {"orderable":false, "targets":2}
                ]
            });

            table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container() ))

        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.css"/>
@endsection