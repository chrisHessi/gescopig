@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Contrat D'inscripition
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
                        @foreach($apprenants as $apprenant)
                            <tr>
                                <td>{!! $apprenant->nom. ' ' .$apprenant->prenom !!}</td>
{{--                                <td>{!! (!empty($apprenant->contrats->last()->resultatNominatifs)) ? $apprenant->contrats->last()->resultatNominatifs : '' !!}</td>--}}
                                <td>
                                    <button type="button" class="btn btn-primary"
                                            data-toggle="modal" data-target="#inscriptionModal" data-action="voir"
                                            data-id="{{ $apprenant->id }}" id="Inscrire">
                                        Inscrire
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box-footer text-right">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{!! route('contrats.index') !!}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </div>

    <div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="inscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="inscriptionModalLabel">Enregistrer le montant versé</h4>
                </div>
                {!! Form::open(['route' => 'contrats.store', 'id'=> 'inscription-form']) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            {!! Form::label('specialite_id', 'Specialite :') !!}
                            {!! Form::select('specialite_id', $specialites, null, ['class' => 'form-control', 'placeholder' => '--choisissez la specialite--']) !!}
                        </div>
                        <div class="form-group col-md-4">
                            {!! Form::label('cycle_id', 'Cycle :') !!}
                            {!! Form::select('cycle_id', $cycles, null, ['class' => 'form-control', 'placeholder' => '--choisissez le niveau--']) !!}
                        </div>
                        <div id="apprenant_id"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                    <Button type="submit" class="btn btn-primary" id="save">Save changes</Button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
        $(function(){
            $('#inscriptionModal').on('show.bs.modal', function(e){
                console.log('in')
                var button = $(e.relatedTarget);
                console.log(button)
                var id = button.data('id');
                var input = '<input name="apprenant_id" type="hidden" value="'+ id +'"/>';
                $('#apprenant_id').html(input)
                $('#save').click(function (e) {
                    $('#inscription-form').submit();
                })
            })

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