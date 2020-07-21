@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Liste des Contrats des années anterieures
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
                            <th>Nom et Prénom</th>
                            <th>Specialité</th>
                            <th>Scolarité</th>
                            <th>Année Academique</th>
                            <th>Scolarité versée</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($contrats as $contrat)
                            <tr>
                                <td>{!! $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom !!}</td>
                                <td>
                                    {!! $contrat->specialite->slug. ' ' .$contrat->cycle->niveau !!}
                                </td>
                                <td>{!! $contrat->cycle->echeanciers->where('academic_year_id', $contrat->academic_year_id)->sum('montant') !!}</td>
                                <td>{!! $contrat->academic_year->debut. '/' .$contrat->academic_year->fin !!}</td>
                                <td>{!! $contrat->versements->sum('montant') !!}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#printModal" data-id="{{ $contrat->id }}"
                                            id="certificat" title="Certificat de Scolarite">
                                        CS
                                    </button>
{{--                                    <button type="button" class="btn btn-primary" data-toggle="modal"--}}
{{--                                            data-target="#printModal" data-id="{{ $contrat->id }}"--}}
{{--                                            id="autorisation" title="Attestation d'autorisation d'inscription">--}}
{{--                                        AAI--}}
{{--                                    </button>--}}
{{--                                    <button type="button" class="btn btn-primary" data-toggle="modal"--}}
{{--                                            data-target="#printModal" data-id="{{ $contrat->id }}"--}}
{{--                                            id="preinscription" title="Attestation de Préinscription">--}}
{{--                                        API--}}
{{--                                    </button>--}}
{{--                                    <button type="button" class="btn btn-primary" data-toggle="modal"--}}
{{--                                            data-target="#printModal" data-id="{{ $contrat->id }}"--}}
{{--                                            id="inscription" title="Attestation d'inscription">--}}
{{--                                        AI--}}
{{--                                    </button>--}}
{{--                                    <a href="#" onclick="window.open('{!! route('scolarites.contrat', [$contrat->id]) !!}','_blank', 'menubar=no, toolbar=no, width=1000px, height=600px')" class="btn btn-primary" title="Contrat d'inscription">CI <i class="fa fa-print"></i></a>--}}
{{--                                    <button type="button" class="btn btn-primary" data-toggle="modal"--}}
{{--                                            data-target="#printModal" data-id="{{ $contrat->id }}"--}}
{{--                                            id="attestation" title="Attestation de Scolarite">--}}
{{--                                        AS--}}
{{--                                    </button>--}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="justificationModalLabel">Infos</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-xs-4">
                            {!! Form::label('circuit', 'Circuit de validation:') !!}
                            {!! Form::text('circuit', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-xs-4">
                            {!! Form::label('titre', 'titre signataire:') !!}
                            {!! Form::text('titre', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-xs-4">
                            {!! Form::label('signataire', 'Nom Signataire:') !!}
                            {!! Form::text('signataire', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-xs-4 semestre">
                            {!! Form::label('semestre', 'Semestre:') !!}
                            {!! Form::text('semestre', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                    <button class="btn btn-primary" id="send">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(function(){
            $('#printModal').on('show.bs.modal', function(e){
                var button = $(e.relatedTarget);
                var type = button.attr('id');
                var modal = $(this);
                if(type == 'autorisation'){
                    $('input#circuit').hide()
                }
                else {
                    $('input#circuit').show()
                }
                if (type != 'attestation') {
                    $('.semestre').hide()
                }
                else {
                    $('.semestre').show()
                }

                console.log(type)
                $('#send').click(function(e){
                    e.preventDefault();
                    var circuit = $('#circuit').val();
                    var titre = $('#titre').val()
                    var signataire = $('#signataire').val()
                    var semestre = $('#semestre').val()
                    var contrat = parseInt(button.data('id'));

                    console.log(type)
                    if(button.attr('id') !== 'autorisation'){
                        // var url = 'http://'+ window.location.host + '/scolarites/certificat/'+contrat+'/'+type+'?circuit='+circuit+'&titre='+titre+'&signataire='+signataire
                        var url = 'http://'+ window.location.host + '/scolarites/certificat/'+contrat+'/'+type+'?circuit='+circuit+'&titre='+titre+'&signataire='+signataire+'&semestre='+semestre;

                    }
                    else{
                        // var url = 'http://'+ window.location.host + '/scolarites/contrats/'+contrat+'?type='+type+'&titre='+titre+'&signataire='+signataire
                        var url = 'http://'+ window.location.host + '/scolarites/contrats/'+contrat+'?type='+type+'&titre='+titre+'&signataire='+signataire
                    }

                    window.open(url,'_blank', 'menubar=no, toolbar=no, width=1000px, height=600px')
                    window.location.reload();
                });
            });
        })
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>
    <script>
        $(function() {
            var table = $('#moratoire-table').DataTable({
                responsive: true,
                dom:'Blfrtip',
                // buttons:[
                //     'copy', 'excel', 'pdf'
                // ],
                "columnDefs":[
                    {"orderable":false, "targets":2}
                ]
            });
        });
    </script>

@endsection

@section('css')
    {{--    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">--}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.css"/>
@endsection