@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Liste des versements de {{ $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom }}
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
                            <th>Date</th>
                            <th>Motif</th>
                            <th>Montant</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($contrat->versements as $versement)
                            <tr>
                                <td>{!! $versement->created_at->format('d/m/Y') !!}</td>
                                <td>{!! $versement->motif !!}</td>
                                <td>
                                    {!! $versement->montant !!}
                                </td>
                                <td>
                                    {!! Form::open(['route' => ['versements.destroy', $versement->id], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        @can('edit versements')
                                            <a href="{!! route('versements.edit', [$versement->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                        @endcan
                                        @can('delete versements')
                                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                        @endcan
                                    </div>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"><strong>Total</strong></td>
                                <td>{!! $contrat->versements->sum('montant') !!}</td>
                                <td></td>
                            </tr>
                        </tfoot>

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
                    {"orderable":false, "targets":2}
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