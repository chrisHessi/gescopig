@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Contrats</h1>
{{--        <h1 class="pull-right">--}}
{{--            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('contrats.create') !!}">Add New</a>--}}
{{--        </h1>--}}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                {{--                <div class="form-group pull-right">--}}
                {{--                    <input type="text" class="search form-control" placeholder="Search here..."/>--}}
                {{--                </div>--}}
                <table class="table table-responsive table-bordered results" id="contrats-table">
                    <thead>
                    <tr>
                        <th>Matricule</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>D de naissance</th>
                        <th>L. de Naissance</th>
                        <th>Nationalité</th>
                        <th>Région d'origine</th>
                        <th>Sexe</th>
                        <th>Civilité</th>
                        <th>Situation Professionnelle</th>
                        <th>Année de 1ère inscription</th>
                        <th>Diplôme d'entrée</th>
                        <th>Spécialite</th>
                        <th>Téléphone</th>
                        <th>Année Académique</th>
                        <th>Noms des Parents</th>
                        <th>Profession parents</th>
                        <th>Adresse parents</th>
                        <th>Telephones parents</th>
                        <th>Relation avec l'apprenant</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrats as $contrat)
                        <tr>
                            <td>{!! $contrat->apprenant->matricule !!}</td>
                            <td>{{ $contrat->apprenant->nom }}</td>
                            <td>{{ $contrat->apprenant->prenom }}</td>
                            <td>{{ $contrat->apprenant->dateNaissance->format('d/m/Y') }}</td>
                            <td>{{ $contrat->apprenant->lieuNaissance }}</td>
                            <td>{{ $contrat->apprenant->nationalite }}</td>
                            <td>{{ $contrat->apprenant->region }}</td>
                            <td>{{ $contrat->apprenant->sexe }}</td>
                            <td>{{ $contrat->apprenant->civilite }}</td>
                            <td>{{ $contrat->apprenant->situation_professionnelle }}</td>
                            <td>{{ $contrat->apprenant->academic_year->debut. '/' .$contrat->apprenant->academic_year->fin }}</td>
                            <th>{{ $contrat->apprenant->diplome }}</th>
                            <td>{{ $contrat->specialite->slug. ' ' .$contrat->cycle->niveau }}</td>
                            <td>{{ $contrat->apprenant->tel }}</td>
                            <td>{{ $contrat->academic_year->debut. '/' .$contrat->academic_year->fin }}</td>
                            <td>
                                @foreach($contrat->apprenant->tutors as $tutor)
                                    <ul>
                                        <li>
                                            {{ $tutor->name }}
                                        </li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>
                                @foreach($contrat->apprenant->tutors as $tutor)
                                    <ul>
                                        <li>
                                            {{ $tutor->profession }}
                                        </li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>
                                @foreach($contrat->apprenant->tutors as $tutor)
                                    <ul>
                                        <li>
                                            {{ $tutor->addresse }}
                                        </li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>
                                @foreach($contrat->apprenant->tutors as $tutor)
                                    <ul>
                                        <li>
                                            {{ $tutor->tel_mobile }}
                                        </li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>
                                @foreach($contrat->apprenant->tutors as $tutor)
                                    <ul>
                                        <li>
                                            {{ $tutor->type }}
                                        </li>
                                    </ul>
                                @endforeach
                            </td>

                        </tr>
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
            // $('#contrats-table').tablesorter();
            // $(".search").keyup(function () {
            //     var searchTerm = $(".search").val();
            //     var listItem = $('.results tbody').children('tr');
            //     var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
            //
            //     $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
            //         return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            //     }
            //     });
            //
            //     $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
            //         $(this).attr('visible','false');
            //     });
            //
            //     $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
            //         $(this).attr('visible','true');
            //     });
            //
            //     var jobCount = $('.results tbody tr[visible="true"]').length;
            //     $('.counter').text(jobCount + ' item');
            //
            //     if(jobCount == '0') {$('.no-result').show();}
            //     else {$('.no-result').hide();}
            // });

            var table = $('#contrats-table').DataTable({
                responsive: true,
                dom:'Blfrtip',
                buttons:[
                    'copy', 'excel', 'pdf'
                ],
            });

            table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container() ))
        });
    </script>

@endsection

@section('css')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.css"/>

@endsection