@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Rapport versement indemnités : {{ $contrat->enseignant->name }}</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('contratEnseignants.versements', [$contrat->id]) !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive results" id="contrats-table">
                    <thead>
                    <tr>
                        <th>Enseignement</th>
                        <th>Specialites</th>
                        <th>Semestre</th>
                        <th>Tranche</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Numero de piece</th>
                        <th>Observation</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            @if(!empty($payment->enseignements))
                                <tr>
                                    <td>
                                        {{ $payment->enseignements->first()->ecue->title }}
                                    </td>
                                    <td>
                                        @foreach($payment->enseignements as $enseignement)
                                            {{ $enseignement->specialite->slug .' '. $enseignement->ecue->semestre->cycle->niveau .' ' }}
                                        @endforeach
                                    </td>
                                    <td>{{ $payment->enseignements->first()->ecue->semestre->title }}</td>
                                    <td>{{ $payment->tranche }}</td>
                                    <td>{{ $payment->montant }}</td>
                                    <td>{{ $payment->date->format('d/m/Y') }}</td>
                                    <td>{{ $payment->numero_piece }}</td>
                                    <td>{{ $payment->observation }}</td>
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