@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Liste des Apprenants
        </h1>
    </section>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="">
                    <table class="table table-bordered table-responsive" id="corkage-table">
                        <thead>
                        <tr>
                            <th>Nom et Prenom</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($apprenants as $apprenant)
                            <tr>
                                <td>{!! $apprenant->nom. ' ' .$apprenant->prenom !!}</td>
                                <td>
                                    @can('create corkages')
                                        <a href="{{ route('corkages.create', $apprenant->id) }}" class="btn btn-primary" title="ajouter"><i class="fa fa-plus"></i></a>
{{--                                        @if($apprenant->corkages)--}}
                                            <a href="{{ route('corkages.show',[$apprenant->id]) }}" class="btn btn-warning" title="Details"><i class="fa fa-eye"></i></a>
{{--                                        @endif--}}
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
            var table = $('#corkage-table').DataTable({
                responsive: true,
                dom:'Blfrtip',
                buttons:[
                    'copy', 'excel', 'pdf'
                ],
                "columnDefs":[
                    {"orderable":false, "targets":1}
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