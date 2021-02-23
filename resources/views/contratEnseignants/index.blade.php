@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Contrats Enseignants</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('contratEnseignants.create') !!}">Add New</a>
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
                        <th>Nom Enseigant</th>
                        <th>Annee Academique</th>
                        <th>Tarif licence</th>
                        <th>Tarif Master</th>
                        <th>Montant total</th>
                        <th>Montant à payé</th>
                        <th>Montant versé</th>
                        <th>Montant restant</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrats as $contrat)
                        @if(isset($contrat->enseignant))
                        <tr>
                            <td>{{ $contrat->enseignant->name }}</td>
                            <td>{{ $contrat->academic_year->debut. '/' .$contrat->academic_year->fin }}</td>
                            <td>{{ $contrat->mh_licence }}</td>
                            <td>{{ $contrat->mh_master }}</td>
                            <td id="{{ 'total-'. $contrat->id }}"></td>
                            <td id="{{ 'du-'. $contrat->id }}"></td>
                            <td id="{{ 'verse-'. $contrat->id }}"></td>
                            <td id="{{ 'rest-'. $contrat->id }}"></td>
                            <td>
                                @can('edit teachers contract')
                                    <a href="{!! route('contratEnseignants.edit', [$contrat->id]) !!}" class='btn btn-default btn-xs' title="editer le contrat de l'enseignant"><i class="glyphicon glyphicon-edit"></i></a>
                                @endcan
                                @can('read teachers contract')
                                    <a href="{!! route('contratEnseignants.rapport', [$contrat->id]) !!}" class='btn btn-info btn-xs' title="voir les versements de l'enseignant"><i class="glyphicon glyphicon-eye-open"></i></a>
                                @endcan
                                @can('delete teachers contract')
                                    <div class='btn-group'>
                                        {!! Form::open(['route' => ['contratEnseignants.destroy', $contrat->id], 'method' => 'delete']) !!}
                                            @can('delete contrats')
                                                {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                            @endcan
                                        {!! Form::close() !!}
                                    </div>
                                @endcan
                                @can('print teachers contract')
                                    <a type="button" class="btn btn-warning btn-xs" data-toggle="modal"
                                            data-target="#printModal" data-id="{{ $contrat->id }}"
                                            id="imprimer" title="Contrat de charge d'enseignement">
                                        <i class="glyphicon glyphicon-print"></i>
                                    </a>
{{--                                    <a href="{!! route('contratEnseignants.contrat', [$contrat->id]) !!}" class='btn btn-warning btn-xs' title="Imprimer le contrat"><i class="glyphicon glyphicon-print"></i></a>--}}
                                @endcan
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><h4>Total</h4></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong id="total"></strong></td>
                            <td><strong id="nap"></strong></td>
                            <td><strong id="mt_verse"></strong></td>
                            <td><strong id="solde"></strong></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="justificationModalLabel">Imprimer contrat</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-xs-6 doc">
                                {!! Form::label('signataire', 'Signataires:') !!}
                                {!! Form::text('signataire', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close">Close</button>
                        <button class="btn btn-primary" id="send">Imprimer</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function () {
            $('#printModal').on('show.bs.modal', function(e){
                var button = $(e.relatedTarget);
                var type = button.attr('id');
                var contrat = button.data('id')
                var modal = $(this);

                console.log(contrat)

                $('#send').click(function(e){
                    e.preventDefault();
                    console.log(3)
                    var signataire = $('#signataire').val()

                    var url = 'http://'+ ((window.location.host == 'pigier.test:81') ? window.location.host+'/public' : window.location.host) + '/contratEnseignants/contrats/'+contrat+'?signataire='+signataire;

                    window.open(url,'_blank', 'menubar=no, toolbar=no, width=1000px, height=600px')
                    window.location.reload();
                });
                console.log(window.location.host)
            });
        })
    </script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    {{--<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/b-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.22/api/sum().js"></script>
    <script>

            $(function() {

                @foreach($contrats as $contrat)
                    var total = 0

                    @foreach($enseignements[$contrat->id] as $enseignement)
                        var mh = {{ ($enseignement->mhTotal < $enseignement->mhEff) ? $enseignement->mhTotal : $enseignement->mhEff }}
                        total += parseInt('{{ (int)(($enseignement->ecue->semestre->cycle->label == 'Licence') ? $contrat->mh_licence : $contrat->mh_master) }}') * mh
                    @endforeach
                    var du = total * (1 - 0.05)
                    var verse = parseInt('{{ (!empty($contrat->payments)) ? $contrat->payments->sum('montant') : 0 }}')
                    var rest = du - verse

                    $('#'+'{{ 'total-'.$contrat->id }}').html(total)
                    $('#'+'{{ 'du-'.$contrat->id }}').html(du)
                    $('#'+'{{ 'verse-'.$contrat->id }}').html(verse)
                    $('#'+'{{ 'rest-'.$contrat->id }}').html(rest)

                    total = 0
                    du = 0
                    verse =0
                    rest = 0
                @endforeach

                var table = $('#contrats-table').DataTable({
                    responsive: true,
                    dom:'Blfrtip',
                    // buttons:[
                    //     'copy', 'excel', 'pdf'
                    // ],
                    "columnDefs":[
                        {"orderable":false, "targets":8}
                    ]
                });

                var total = table.column(4).data().sum();
                var nap = table.column(5).data().sum();
                var mt_verse = table.column(6).data().sum();
                var solde = table.column(7).data().sum();

                $('#total').html(total)
                $('#nap').html(nap)
                $('#mt_verse').html(mt_verse)
                $('#solde').html(solde)
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