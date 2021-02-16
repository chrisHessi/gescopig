@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Détails paiements perçus par M. {{ (((int)$type) ? $teachable->enseignements->first() : $teachable)->contratEnseignant->enseignant->name }}</h1>
        {{--<h1 class="pull-right">--}}
            {{--<a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('contratEnseignants.create') !!}">Add New</a>--}}
        {{--</h1>--}}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box-header text-blue"><h4>{{ (((int)$type) ? $teachable->enseignements->first() : $teachable)->ecue->title }}</h4></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive results" id="contrats-table">
                    <thead>
                    <tr>
                        <th>Date paiement</th>
                        <th>Montant</th>
                        <th>Numero Pièce</th>
                        <th>Observation</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($teachable->payments as $payment)
                        <tr>
                            <td>{{ $payment->date->format('d/m/Y') }}</td>
                            <td>{{ $payment->montant }}</td>
                            <td>{{ $payment->numero_piece }}</td>
                            <td>{{ $payment->observation }}</td>
                            <td>
                                <a href="{!! route('contratEnseignants.edit_payment', [$payment->id]) !!}" class='btn btn-default btn-xs' title="modifier le paiement"><i class="glyphicon glyphicon-edit"></i></a>
                                <div class='btn-group'>
                                    {!! Form::open(['route' => ['contratEnseignants.delete_payment', $payment->id], 'method' => 'delete']) !!}
                                    @can('delete contrats')
                                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    @endcan
                                    {!! Form::close() !!}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">

    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    {{--<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/b-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js"></script>

    <script>

        $(function() {
            var table = $('#contrats-table').DataTable({
                responsive: true,
                dom:'Blfrtip',
                // buttons:[
                //     'copy', 'excel', 'pdf'
                // ],
                "columnDefs":[
                    {"orderable":false, "targets":5}
                ]
            });
        });

        // table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container() ))
    </script>

@endsection

@section('css')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/dt-1.10.22/b-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css"/>

    {{--<script type="text/javascript" src="https://cdn.datatables.net/v/ju/dt-1.10.22/b-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js"></script>--}}

@endsection