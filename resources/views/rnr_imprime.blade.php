<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Releve de Notes</title>

        <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
        <style>
            div .logo{
                width: 40%;
                height: 45%;
            }

            @media print{
                .footer{
                    page-break-after: always;
                    position: absolute;
                    bottom: 0;
                    width: 100%;
                }
                .table-bordered> tbody>tr>td,
                .table-bordered> thead>tr>th,
                .table-bordered>tbody>tr>th{
                    border: 1px solid #000000;!important;
                }
            }
            #logo_pigier{
                width: 50%;
            }
            .header p{
                font-size: 80%;
                margin-bottom: 3px;
            }

            .infos tr{
                font-size: 12px;
            }
            .notes-table tr{
                font-size: 90%;
                border: 1px solid #000000;!important;
            }

            .table-bordered> tbody>tr>td,
            .table-bordered> thead>tr>th,
            .table-bordered>tbody>tr>th{
                border: 1px solid #000000;!important;
            }
            /*.resultats{*/
                /*background-color: #a6a28c;*/
            /*}*/

            .infos{
                border-: 2px 0px;

            }
        </style>
    </head>

    <body class="skin-blue sidebar-mini fixed">

        <div class="wrapper col-xs-10">
            <div class="content-wrapper">
                <section class="content container-fluid .page-break" id="rnr">
                    <div class="container-fluid">

                        <div class="header row fixed-top bg-info">
                            <div class="col-xs-3 pull-left">
                                <div class="row"><img src="{{ url('images/essec.jpg') }}" class="logo" alt="Accueil"></div>
                                <div class="row">
                                    <p><small>BP: 1931 Douala-Cameroun</small></p>
                                    <p><small>Tél: +237 233 40 53 41</small></p>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="row">
                                    <div class="col-xs-6 text-center mt-5 pt-3">
                                        <p>REPUBLIQUE DU CAMEROUN</p>
                                        <p><small>Paix - Travail - Patrie</small></p>
                                        <p>MINISTERE DE L'ENSEIGNEMENT SUPERIEUR</p>
                                        <p>UNIVERSITÉ DE DOUALA</p>
                                    </div>
                                    <div class="col-xs-6 text-center">
                                        <p>REPUBLIC OF CAMEROON</p>
                                        <p><small>Peace - Work - Fatherland</small></p>
                                        <p>MINISTRY OF HIGHER EDUCATION</p>
                                        <p>THE UNIVERSITY OF DOUALA</p>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h4><strong>Relevé de notes et résultats / Transcript</strong></h4>
                                </div>
                            </div>
                            <div class="col-xs-3 pull-right">
                                <div class="row"><img src="{{ url('images/logo_pigier.jpg') }}" class=" pull-right" alt="Pigier logo" id="logo_pigier"></div>
                                <div class="row pull-right text-right">
                                    <p><small><strong>BP:</strong> 1931 Douala-Cameroun</small></p>
                                    <p><small><strong>Tél:</strong> +237 243 85 83 46</small></p>
                                    <p><small><strong>Email:</strong> pigierdouala@pigiercam.com /<br> pigiercameroun@pigiercam.com</small></p>
                                </div>
                            </div>
                            <div class="" id="student-infos">
                                <div class="col-xs-7 infos">
                                    <table>
                                        <tr>
                                            <th>Identifiant-matricule/ Id-Registration Number: </th>
                                            <td>{{ $contrat->apprenant->matricule }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nom(s) et Prenom(s) / Name(s) and Surname(s) : </th>
                                            <td>{{ $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom }}</td>
                                        </tr>
                                        <tr>
                                            <th>Parcours / Cycle Degree: </th>
                                            <td>{{ $enseignements->first()->ecue->semestre->cycle->label }} Professionnelle</td>
                                        </tr>
                                        <tr>
                                            <th>Specialité et niveau/ Speciality Level: </th>
                                            <td>{{ $contrat->specialite->title. ' ' .$enseignements->first()->ecue->semestre->cycle->niveau }}</td>
                                        </tr>
                                        <tr>
                                            <th>Semestre/ Semester</th>
                                            <td>{{ $enseignements->first()->ecue->semestre->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Session/ Session</th>
                                            <td>{{ substr_replace($session, ' ', strlen($session)-1,0) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-xs-5 infos">
                                    <table class="pull-right">
                                        <tr>
                                            <th class="text-right">Réf. du contrat / Contract Reference : </th>
                                            <td class="text-left">{{ $academicYear->fin. '-' .$contrat->id }} </td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Année d'inscription / Registration year : </th>
                                            <td class="text-left">{{ $contrat->apprenant->academic_year->debut. ' ' .$contrat->apprenant->academic_year->fin }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Ref. du relevé / Transcript Ref : </th>
                                            <td class="text-left">{{ $academicYear->fin }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Année academique / Academique Year:</th>
                                            <td class="text-left">{{ $academicYear->debut. ' ' .$academicYear->fin }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row notes-table">
                            <table class="table table-bordered">
                                <thead>
                                <tr style="border: 1px solid #000000">
                                    <th>Code</th>
                                    <th colspan="2">Unité d'Enseigement (UE) /Element constitutifs de l'UE (ECUE)</th>
                                    <th>Valeur CECT</th>
                                    <th>*CECT Aquis</th>
                                    <th>Note Ecue</th>
                                    <th>Crédit ECUE</th>
                                    <th>Note pondérée</th>

                                </tr>
                                <tr></tr>
                                </thead>
                                <tbody>

                                    @foreach($ues as $ue)
                                        <tr class="bg-default">
                                            {{--Nombre de lignes dependent du nombre d'ecues de l'ue + 2--}}
                                            <td rowspan="{{ $enseignements->where('ue_id', $ue->id)->count()+2 }}"><strong>{{ $ue->code. $specialityCode. $semestre->id }}</strong></td>
                                            <td colspan="2"><strong>{{ $ue->title }}</strong></td>
                                            <td><strong>{{ $enseignements->where('ue_id', $ue->id)->sum('credits') }}</strong></td>
                                            <td><strong>{{ $contrat->ue_infos->where('ue_id', $ue->id)->first()->creditObt }}</strong></td>
                                            <td colspan="4"></td>
                                        </tr>
                                        @foreach($enseignements as $enseignement)
                                            @if($enseignement->ue_id == $ue->id)
                                                <tr>
                                                    <td colspan="4">{{ $enseignement->ecue->title }}</td>
                                                    <td>
                                                        @if($session == 'session1')
                                                            {!! number_format($contrat->notes->where('enseignement_id', $enseignement->id)->first()->del1, 2, ',', ' ') !!}
                                                        @elseif($session == 'session2')
                                                            {!! number_format($contrat->notes->where('enseignement_id', $enseignement->id)->first()->del2, 2, ',', ' ') !!}
                                                        @endif
                                                    </td>
                                                    <td>{{ $enseignement->credits }}</td>
                                                    <td>
                                                        @if($session == 'session1')
                                                            {!! number_format($contrat->notes->where('enseignement_id', $enseignement->id)->first()->del1 * $enseignement->credits, 2, ',', ' ') !!}
                                                        @elseif($session == 'session2')
                                                            {!! number_format($contrat->notes->where('enseignement_id', $enseignement->id)->first()->del1 * $enseignement->credits, 2, ',', ' ') !!}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr class="resultats">
                                            <td class="text-right">Resultat UE</td>
                                            <td><strong>{{ $contrat->ue_infos->where('ue_id', $ue->id)->first()->mention }}</strong></td>
                                            <td colspan="2" class="text-right">Moyenne UE</td>
                                            <td>{{ number_format($contrat->ue_infos->where('ue_id', $ue->id)->first()->moyenne, 2, ',', ' ') }}</td>
                                            <td></td>
                                            <td>{{ number_format($contrat->ue_infos->where('ue_id', $ue->id)->first()->totalNotes, 2, ',', ' ') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="col-xs-6">
                                <p class="fixed-top pull-left">Décision- :
                                    <strong>
                                        {{ $contrat->semestre_infos->where('semestre_id', $semestre->id)->first()->mention }}
                                    </strong>
                                </p><br><br><br>
                                <p class="pull-left">Observations:</p><br><br><br>
                                <p class="pull-left">Fait à Douala le : </p>
                            </div>

                            <div class="col-xs-6 text-left">
                                <table class="table table-bordered">

                                        <tr>
                                            <th class="text-right">Nombre d'UE Validées: </th>
                                            <td>{{ $contrat->semestre_infos->where('semestre_id', $semestre->id)->first()->nbUeValid }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-right">Total CECT Acquis: </th>
                                            <td>{{ $contrat->semestre_infos->where('semestre_id', $semestre->id)->first()->creditObt }} / 30</td>
                                        </tr>

                                        <th class="text-right">Total notes Obtenues: </th>
                                        <td>{{ number_format($contrat->semestre_infos->where('semestre_id', $semestre->id)->first()->totalNotes, 2, ',',' ') }}/600</td>
                                    </tr>
                                    <tr>
                                        <th class="text-right">Moyenne Semestrielle: </th>
                                        <td>{{ number_format($contrat->semestre_infos->where('semestre_id', $semestre->id)->first()->moyenne, 2, ',',' ') }}/20</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <p class="pull-left"><strong><u>Le Directeur de L'ESSEC/ The Director of ESSEC</u></strong></p><br><br><br>
                                <p class="pull-left"><strong>Pr Georges Bertrand TAMOKWE PIAPTIE</strong></p>
                            </div>
                            <div class="col-xs-6">
                                <p class="text-right"><strong><u>Le Directeur Académique en charge de la Recherche et du Developpement:</u></strong></p><br><br>
                                <p class="text-right"><strong>Pr Raphaël NKAKLEU</strong></p>
                            </div>
                        </div>

                    </div>
                    <div class="container-fluid footer fixed-bottom">

                        <div class="row">
                            <p class="text-left">*CECT : Crédit d'Evaluation Capitalisable et Transférable</p>
                            <p class="text-left"><small>Il n'est délivré qu'un seul relevé de notes qui ne tient lieu en aucun cas d'attestation de diplôme. Aucun duplicata ne sera fourni.</small></p>

                            <div class="col-xs-6"><h5 class="text-center"><strong>Pigier Cameroun, Première Ecole Centre Agréée d'Examens Microsoft Office au Cameroun</strong></h5></div>
                            <div class="col-xs-3"><img src="{{ url('images/office-specialist.jpg') }}" alt="logo microsoft" class="logo"></div>
                        </div>

                        <div class="bg-primary">
                            <p class="text-center">UNE ECOLE DU GROUPE EDUSERVICES - FRANCE</p>
                        </div>
                    </div>
                </section>
            </div>
            <div class="row">
                <button class="btn btn-primary" onclick="imprimer('rnr')">Imprimer</button>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <script>
            function imprimer(rnr){
                var printContents = document.getElementById(rnr).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
    </body>

</html>