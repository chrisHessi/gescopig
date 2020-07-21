@extends('layouts.app')
@section('content')

<div class="container-fluid">

    <div class="header row fixed-top bg-info">
        <div class="col-sm-3 pull-left">
            <div class="row"><img src="{{ url('images/logo_pigier.jpg') }}" class="logo" alt="Accueil"></div>
            <div class="row">
                <p><small>BP: 1931 Douala-Cameroun</small></p>
                <p><small>Tél: +237 233 40 53 41</small></p>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-6 text-center mt-5 pt-3">
                    <p>REPUBLIQUE DU CAMEROUN</p>
                    <p><small>Paix - Travail - Patrie</small></p>
                    <p>MINISTERE DE L'ENSEIGNEMENT SUPERIEUR</p>
                    <p>UNIVERSITÉ DE DOUALA</p>
                </div>
                <div class="col-sm-6 text-center">
                    <p>REPUBLIQUE DU CAMEROUN</p>
                    <p><small>Paix - Travail - Patrie</small></p>
                    <p>MINISTERE DE L'ENSEIGNEMENT SUPERIEUR</p>
                    <p>UNIVERSITÉ DE DOUALA</p>
                </div>
            </div>
            <div class="text-center">
                <h4><strong>Relevé de notes et résultats / Transcript</strong></h4>
            </div>
        </div>
        <div class="col-sm-3 pull-right">
            <div class="row"><img src="{{ url('images/logo_pigier.jpg') }}" class="logo pull-right" alt="Accueil"></div>
            <div class="row pull-right text-right">
                <p><small><strong>BP:</strong> 1931 Douala-Cameroun</small></p>
                <p><small><strong>Tél:</strong> +237 233 40 53 41</small></p>
                <p><small><strong>Email:</strong> pigierdouala@pigiercam.com /<br> pigierdouala@yahoo.fr</small></p>
            </div>
        </div>
        <div>
            <div class="col-sm-8 infos">
                <table>
                    <tr>
                        <th>Identifiant-matricule/ Registration Number: </th>
                        <td>2018ddddddddddddddddddddddddddddddd</td>
                    </tr>
                    <tr>
                        <th>Nom et Prenom / Name and Surname : </th>
                        <td>DONGMO DIKONGUE Franck Olivier Merlin</td>
                    </tr>
                    <tr>
                        <th>Parcours / Cycle Degree: </th>
                        <td>2018</td>
                    </tr>
                    <tr>
                        <th>Specialité et niveau/ Speciality Level: </th>
                        <td>2018</td>
                    </tr>
                    <tr>
                        <th>Semestre/ Semester</th>
                        <td>2018</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-4 p-0">
                <table class="pull-right">
                    <tr>
                        <th>Ref. du contrat / Contrat Reference : </th>
                        <td>2018-2222 </td>
                    </tr>
                    <tr>
                        <th>Année d'inscription : </th>
                        <td>2018</td>
                    </tr>
                    <tr>
                        <th>Ref. du relevé / Transcript Ref</th>
                        <td>2018</td>
                    </tr>
                    <tr>
                        <th>Année academique</th>
                        <td>2018</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th>Code</th>
                    <th colspan="2">Unité d'Enseigement(UE)/Element constitutifs de l'UE (ECUE)</th>
                    <th>Valeur CECT</th>
                    <th>*CECT Aquis</th>
                    <th>Note Ecue</th>
                    <th>Crédit ECUE</th>
                    <th>Note pondérée</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="8">UE de Specialité</td>
                </tr>
                <tr>
                    <td rowspan="5">ODG4125</td>
                    <td colspan="2">Outils De Gestion</td>
                    <td>4</td>
                    <td>4</td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="4">Logiciel de gestion comptable</td>
                    <td>10</td>
                    <td>2</td>
                    <td>20</td>
                </tr>
                <tr>
                    <td colspan="4">Logiciel de gestion comptable</td>
                    <td>10</td>
                    <td>2</td>
                    <td>20</td>
                </tr>
                <tr>
                    <td class="text-right">Resultat UE</td>
                    <td>Validée</td>
                    <td colspan="2" class="text-right">Moyenne UE</td>
                    <td>10</td>
                    <td></td>
                    <td>40.2</td>
                </tr>
                <tr>
                    <td colspan="8">UE de Specialité</td>
                </tr>
                <tr>
                    <td rowspan="5">ODG4125</td>
                    <td colspan="2">Outils De Gestion</td>
                    <td>4</td>
                    <td>4</td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="4">Logiciel de gestion comptable</td>
                    <td>10</td>
                    <td>2</td>
                    <td>20</td>
                </tr>
                <tr>
                    <td colspan="4">Logiciel de gestion comptable</td>
                    <td>10</td>
                    <td>2</td>
                    <td>20</td>
                </tr>
                <tr>
                    <td class="text-right">Resultat UE</td>
                    <td>Validée</td>
                    <td colspan="2" class="text-right">Moyenne UE</td>
                    <td>10</td>
                    <td></td>
                    <td>40.2</td>
                </tr>
                <tr>
                    <td colspan="8">UE de Specialité</td>
                </tr>
                <tr>
                    <td rowspan="5">ODG4125</td>
                    <td colspan="2">Outils De Gestion</td>
                    <td>4</td>
                    <td>4</td>
                    <td colspan="4"></td>
                </tr>
                <tr>
                    <td colspan="4">Logiciel de gestion comptable</td>
                    <td>10</td>
                    <td>2</td>
                    <td>20</td>
                </tr>
                <tr>
                    <td colspan="4">Logiciel de gestion comptable</td>
                    <td>10</td>
                    <td>2</td>
                    <td>20</td>
                </tr>
                <tr>
                    <td class="text-right">Resultat UE</td>
                    <td>Validée</td>
                    <td colspan="2" class="text-right">Moyenne UE</td>
                    <td>10</td>
                    <td></td>
                    <td>40.2</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <p class="fixed-top pull-left">Décision-/ </p><br><br><br>
            <p class="pull-left">Observations:</p><br><br><br>
            <p class="pull-left">Fait à Douala le : </p>
        </div>

        <div class="col-sm-6 text-left">
            <table class="table">
                <tr>
                    <th class="text-right">Nombre d'UE Validées: </th>
                    <td>6/6</td>
                </tr>
                <tr>
                    <th class="text-right">Total CECT Acquis: </th>
                    <td>30/30</td>
                </tr>
                <tr>
                    <th class="text-right">Total notes Obtenues: </th>
                    <td>300.14/600</td>
                </tr>
                <tr>
                    <th class="text-right">Moyenne Semestrielle: </th>
                    <td>10.00/20</td>
                </tr>

            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <p class="pull-left">Le Directeur de L'ESSEC/ The Director of ESSEC</p><br><br><br><br>
            <p class="pull-left"><strong>Pr Georges Bertrand TAMOKWE PIAPTIE</strong></p>
        </div>
        <div class="col-sm-6">
            <p class="text-right">Le Directeur des Etudes / Dean of Study:</p><br><br>
            <p class="text-right"><strong>Pr Raphael NKAKLEU</strong></p>
        </div>
    </div>

    <div class="row">
        <p class="text-left">*CECT : Crédit d'Evaluation Capitalisable et Transferable</p>
        <h5 class="text-center"><strong>Pigier Douala, Première Ecole Centre Agréée d'Examens Microsoft Office au Cameroun</strong></h5>
    </div>

</div>
<div class="container-fluid">
    <div class="footer bg-primary">
        <p class="text-center">UNE ECOLE DU GROUPE EDUSERVICES - FRANCE</p>
    </div>
</div>

@endsection

@section('css')

    <style type="text/css">
        .header p{
            font-size: 80%;
        }

        div .logo{
            width: 40%;
            height: 50%;
        }
        header .infos{
            padding: 0px 0px;
        }
    </style>

@endsection