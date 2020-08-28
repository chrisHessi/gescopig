@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Contrats Enseignants</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('contratEnseignants.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                {{--                <div class="form-group pull-right">--}}
                {{--                    <input type="text" class="search form-control" placeholder="Search here..."/>--}}
                {{--                </div>--}}
                <table class="table table-responsive results" id="contrats-table">
                    <thead>
                    <tr>
                        <th>Nom Enseigant</th>
                        <th>Enseignement</th>
                        <th>Annee Academique</th>
                        <th>Tarif licence</th>
                        <th>Tarif Master</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrats as $contrat)
                        @if(isset($contrat->enseignant))
                        <tr>
                            <td>{{ $contrat->enseignant->name }}</td>
                            <td>
                                <ul>
                                @foreach($contrat->enseignements as $enseignement)
                                    <li>{{ $enseignement->ecue->title }}</li>
                                @endforeach
                                </ul>
                            </td>
                            <td>{{ $contrat->academic_year->debut. '/' .$contrat->academic_year->fin }}</td>
                            <td>{{ $contrat->mh_licence }}</td>
                            <td>{{ $contrat->mh_master }}</td>
                            <td>
                                <a href="{!! route('contratEnseignants.versements', [$contrat->id]) !!}" class='btn btn-success btn-xs' title="enregistrer un paiement"><i class="glyphicon glyphicon-usd"></i></a>
                                <a href="{!! route('contratEnseignants.edit', [$contrat->id]) !!}" class='btn btn-default btn-xs' title="editer le contrat de l'enseignant"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('contratEnseignants.rapport', [$contrat->id]) !!}" class='btn btn-info btn-xs' title="voir les versements de l'enseignant"><i class="glyphicon glyphicon-eye-open"></i></a>
                                <div class='btn-group'>
                                    
                                    {!! Form::open(['route' => ['contratEnseignants.destroy', $contrat->id], 'method' => 'delete']) !!}
                                        @can('delete contrats')
                                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                        @endcan
                                    {!! Form::close() !!}
                                <a href="{!! route('contratEnseignants.contrat', [$contrat->id]) !!}" class='btn btn-warning btn-xs' title="Imprimer le contrat"><i class="glyphicon glyphicon-print"></i></a>
                                </div>
                                
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>



    <script>

        $(document).ready(function() {
            var table = $('#contrats-table').DataTable({
                responsive: true,
                dom:'Blfrtip',
                buttons:[
                    'copy', 'excel', 'pdf'
                ],
                "columnDefs":[
                    {"orderable":false, "targets":3}
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