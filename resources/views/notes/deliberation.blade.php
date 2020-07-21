@extends('layouts.app')

@section('content')

    <div class="content">
        <h1>
            {!! $specialite->slug. ''. $semestre->cycle->niveau. ' - '. $semestre->title !!} : Deliberation
        </h1>

        <div class="clear-fix"></div>
        @include('flash::message')
        <div class="clear-fix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <table id="notes-table" class="table table-bordered table-stripped">
                    <thead>
                    <tr>
                        <th>Apprenant</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrats as $contrat)
                        @if(isset($contrat))
                            <tr>
                                <td>{{ $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom }}</td>
                                <td>
                                    <div class="pull-right">
                                        <a href="{{ route('notes.noteDeliberation', ['session1', $contrat->id, $semestre->id]) }}" class="btn btn-info btn-sm">1ere Session</a>
                                        <a href="{{ route('notes.noteDeliberation', ['session2',$contrat->id, $semestre->id]) }}" class="btn btn-warning btn-sm">2e Session</a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
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
            var table = $('#notes-table').DataTable({
                responsive: true,
                dom:'Blfrtip',
                // buttons:[
                //     'copy', 'excel', 'pdf'
                // ],
                // "columnDefs":[
                //     // {"orderable":false, "targets":2}
                // ]
            });
        });
    </script>

@endsection

@section('css')
    {{--    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">--}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.css"/>
@endsection