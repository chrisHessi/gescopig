@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Liste des Echeanciers
        </h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('echeanciers.create') !!}">Ajouter</a>
        </h1>
    </section>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="">
                    <table class="table table-bordered table-responsive" id="echeancier-table">
                        <thead>
                            <tr>
                                <th>Niveau</th>
                                <th>Tranche</th>
                                <th>Montant</th>
                                <th>date d'echeance</th>
                                <th>Année Academique</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($echeanciers as $echeancier)
                                <tr>
                                    {!! Form::open(['route' => ['echeanciers.destroy', $echeancier->id], 'method' => 'delete']) !!}
                                        <td>{!! $echeancier->cycle->label.' '.$echeancier->cycle->niveau !!}</td>
                                        <td>{!! $echeancier->tranche !!}</td>
                                        <td>{!! $echeancier->montant !!}</td>
                                        <td>{!! $echeancier->date->format('d-m-y') !!}</td>
                                        <td>{!! $echeancier->academic_year->debut.'/'.$echeancier->academic_year->fin !!}</td>
                                        <td>
                                            @can('edit echeanciers')
                                            <a href="{!! route('echeanciers.edit', [$echeancier->id]) !!}" class='btn btn-primary btn-xs'>Modifier<i class="glyphicon glyphicon-edit"></i></a>
                                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                            @endcan
                                        </td>
                                    {!! Form::close() !!}
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
            var table = $('#echeancier-table').DataTable({
                responsive: true,
                dom:'Blfrtip',
                buttons:[
                    'copy', 'excel', 'pdf'
                ],
                "columnDefs":[
                    {"orderable":false, "targets":5}
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