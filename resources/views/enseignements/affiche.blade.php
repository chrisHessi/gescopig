@extends('layouts.app')
@section('content')

    <div class="content">
        <h1>
        {!! isset($enseignements->first()->id) ? $enseignements->first()->specialite->slug. ' ' .$enseignements->first()->ecue->semestre->cycle->niveau .' - '. $enseignements->first()->ecue->semestre->title : $specialite->slug. ' ' .$semestre->cycle->niveau !!}

        </h1>
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive results tablesorter" id="enseignements-table">
                    <thead>
                    <tr>
                        <th>Ecue</th>
                        <th>Masse Horaire Totale</th>
                        <th>Masse horaire effectuée</th>
                        <th>Masse Horaire Restante</th>
                        <th></th>
                        <th colspan="3">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($enseignements as $enseignement)
                        @if(isset($enseignement))
                        <tr>
                            <td>{!! $enseignement->ecue->title !!}</td>
                            <td>{!! $enseignement->mhTotal !!}</td>
                            <td>{!! $enseignement->mhEff !!}</td>
                            <td>{!! (int)($enseignement->mhTotal - $enseignement->mhEff) !!}</td>
                            {{--<td>{!! $apprenant->absences->where('justify',0)->count() !!}</td>--}}
                            <td></td>
                            <td>
                                    <div class='btn-group pull-right'>
                                        <a href="{!! route('enseignements.editMh', [$enseignement->id]) !!}" class='btn btn-primary btn-sm '>Modifier <i class="glyphicon glyphicon-edit"></i></a>
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
    <script src="http://localhost/pigier/public/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>

    <script>
        $(document).ready(function() {

            var table = $('#enseignements-table').DataTable({
                responsive: true,
                dom:'Blfrtip',
                buttons:[
                    'copy', 'excel', 'pdf'
                ],
                "columnDefs":[
                    {"orderable":false, "targets":4}
                ]
            });

            table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container() ))
        });
    </script>

@endsection

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.css"/>

    <style>
        .results tr[visible='false'], .no-result{
            display: none;
        }
        .results tr[visible='true']{
            display: table-row;
        }
        .counter{
            padding: 8px;
            color: #acacac;
        }
    </style>
@endsection