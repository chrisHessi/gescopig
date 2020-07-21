@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Contrat D'enseignant
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div>
                    <table class="table table-bordered table-striped" id="apprenants-table">
                        <thead>
                        <tr>
                            <th>Nom et prenom</th>
                            {{--                            <th>Decision</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($enseignants as $enseignant)
                            <tr>
                                <td>{!! $enseignant->name !!}</td>
                                {{--                                <td>{!! (!empty($apprenant->contrats->last()->resultatNominatifs)) ? $apprenant->contrats->last()->resultatNominatifs : '' !!}</td>--}}
                                <td>
                                    <a href="{{ route('contratEnseignants.save', [$enseignant->id]) }}" class="btn btn-primary">
                                        Autoriser
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box-footer text-right">
                <a href="{!! route('contratEnseignants.index') !!}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(function(){
            var table = $('#apprenants-table').DataTable({
                responsive: true,
                dom:'Blfrtip',
                buttons:[
                    'copy', 'excel', 'pdf'
                ],
                "columnDefs":[
                    {"orderable":false, "targets":1}
                ]
            });

        })
    </script>
@endsection

@section('css')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.css"/>

@endsection