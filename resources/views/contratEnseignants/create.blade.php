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
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#printModal" data-id="{{ $enseignant->id }}"
                                            id="autoriser" title="Contrat de charge d'enseignement">
                                        Autoriser
                                    </button>
                                    
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

    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {{Form::open(['route' => 'contratEnseignants.store'])}}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="justificationModalLabel">Infos</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-xs-6 doc">
                                {!! Form::label('mh_licence', 'Montant Horaire Licence:') !!}
                                {!! Form::text('mh_licence', null, ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form-group col-xs-6 semestre doc">
                                {!! Form::label('mh_master', 'Montant horaire Master:') !!}
                                {!! Form::text('mh_master', null, ['class' => 'form-control']) !!}
                            </div>
                            <div id="enseignant-id"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                        <button class="btn btn-primary" id="send">Save</button>
                    </div>
                {{Form::close()}}
            </div>
        </div>
    </div>

@endsection

@section('scripts')


    

    <script type="text/javascript">
        $(function(){
            $('#printModal').on('show.bs.modal', function(e){
                var button = $(e.relatedTarget);
                var id = button.data('id');
                var input = '<input name="enseignant_id" type="hidden" value="'+ id +'"/>';
                $('#enseignant-id').html(input);
            })
        })
    </script>
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