<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Proces verbal de deliberation</title>

    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
    <style>


        @media print{
            div #logo-pigier{
                width: 60%;
            }

            .footer{
                position: absolute;
                bottom: 0;
                width: 100%;
                margin-bottom: 150px;
            }
            .content-wrapper{
                -webkit-print-color-adjust: exact;
            }
            #ref{
                padding-right: 25px;
            }

        }
        .header {
            /*font-size: 80%;*/
            margin-bottom: 30px;
        }

        body{
            margin-top: 10px;
            margin-right: 20px;
        }

        th.vertical{
            white-space: nowrap;
            height: 250px;
        }
        th.vertical>div{
            transform:
                /*translate(25px, 51px)*/
                rotate(270deg);
            margin-bottom: 20px;
            width: 40px;
        }

        table{
            text-align: center;
            margin-top: 40px;
        }
        th.ref{
            /*width: 80px !important;*/
        }

        .table thead tr{
            font-size: 14px;
        }

        .table tr{
            font-size: 16px;
            padding: 5px 0px;
        }

        div.header{
            width: 2400px;
            margin-bottom: 10px;
        }

        body{
            padding-left: 20px;
        }

        .pv{
            display: flex;
            justify-content: space-between;
        }
        .pv>*{
            margin: auto 0px;
        }

    </style>
</head>

<body class="skin-blue sidebar-mini fixed">

<div class="wrapper container-fluid">
    <div class="content-wrapper">

        <div class="header fixed-top row">
            <div class="col-xs-3" >
                <div ><img src="{{ url('images/logo_pigier.jpg') }}" alt="" id="logo-pigier"></div>
            </div>
            <div class="col-xs-6">
                <h1 class="text-center">PROCES VERBAL DE DELIBERATION</h1>
                <h1 class="text-center">Résultat des Examens {{ $semestre->title. ' ' .$session }}</h1>
                <h1 class="text-center">Domaine : {{ ($contrats->first()->specialite->slug == "MAFIDA") ? "Sciences Juridiques, Politiques et Administratives" : "Sciences Economiques et de Gestion" }}</h1>
                <h1 class="text-center">Mention : {{ ($contrats->first()->specialite->slug == "MAFIDA") ? "Sciences Juridiques" : "Sciences de Gestion" }}</h1>
                <h1 class="text-center">Spécialité : {{ $contrats->first()->specialite->slug. " (" .$contrats->first()->specialite->title. ")" }}</h1>
                <h1 class="text-center">Niveau : {{$semestre->cycle->label. ' ' .$semestre->cycle->niveau}}</h1>
                <h1 class="text-center">Année Académique : {{ $academicYear->debut. '-' .$academicYear->fin }}</h1>
            </div>
            <div class="col-xs-3" id="ref">
                <div class="pull-right">
                    <h3 class="mr-5">Réf: PIG/RFD/F/048</h3>
                    <h3>Version: 1.1</h3>
                    <h3>Du {{ \Carbon\Carbon::now()->format('d/m/Y') }}</h3>
                    <h3>{{ (env('APP_URL') == 'https://www.gescopayaounde.com') ? 'Ydé' : 'Dla' }}</h3>
                </div>
            </div>
        </div>
        <div class="row pv">
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th rowspan="5" class="vertical"><div><span>effectif</span></div></th>
                        <th rowspan="5" class="vertical ref"><div><span>ref. contrat</span></div></th>
                        <th rowspan="5" class=""><h4><span>Nom(s) et Prenom(s)</span></h4></th>
                    </tr>
                    <tr > {{-- Affichage des entete d'unite d'enseignement --}}
                        @foreach($ues as $ue)
                            <th class="text-center" colspan="{{ 2*$enseignements->where('ue_id', $ue->id)->count() +2 }}">{{ $ue->code .$specialityCode .$semestre->id. ': ' .$ue->title }}</th>
                        @endforeach
                        <th>{{ sizeof($ues) }}</th>
                        <th rowspan="4" class="vertical bg-info"><div><span>Moyenne Semestrielle</span></div></th>
                        <th colspan="2">Resultat Semestre</th>
                    </tr>
                    <tr class="info">
                        @foreach($ues as $ue)
                            @foreach($enseignements as $enseignement)
                                @if($enseignement->ue_id == $ue->id)
                                    <th>Ecue</th>
                                    <th>Credit</th>
                                @endif
                            @endforeach
                            <th>Total</th>
                            <th rowspan="3" class="vertical"><div><span>Validation UE</span></div></th>
                        @endforeach
                        <th rowspan="3" class="vertical"><div><span>UE Validée(s) | UE à Valider</span></div></th>
                        <th rowspan="3" class="vertical"><div><span>Validé</span></div></th>
                        {{--<th rowspan="3" class="vertical"><div><span>Validé par Compensation</span></div></th>--}}
                        <th rowspan="3" class="vertical"><div><span>Non Validé</span></div></th>
                    </tr>
                    <tr class="bg-warning">
                        @foreach($ues as $ue)
                            @foreach($enseignements as $enseignement)
                                @if($enseignement->ue_id == $ue->id)
                                    <th class="vertical"><div><p>{!! wordwrap($enseignement->ecue->title, 26, '<br />', true) !!}</p></div></th>
                                    <th>{{ $enseignement->credits }}</th>
                                @endif
                            @endforeach
                            <th>{{ $enseignements->where('ue_id', $ue->id)->sum('credits') }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($ues as $ue)
                            @foreach($enseignements as $enseignement)
                                @if($enseignement->ue_id == $ue->id)
                                    <th>Note</th>
                                    <th>Pond</th>
                                @endif
                            @endforeach
                            <th>Moy</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                @foreach($contrats as $contrat)
                @if($contrat->notes->first())
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $academicYear->fin. '-' .$contrat->id }}</td>
                        <td class="text-left">{{ $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom }}</td>
                        @foreach($ues as $ue)
                            @foreach($enseignements as $enseignement)
                                @if($enseignement->ue_id == $ue->id)
                                    @if($session == 'session1')
                                        <td>
                                            {!! $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del1 !!}
                                        </td>
                                        <td>
                                            {!! $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del1 * $enseignement->credits !!}
                                        </td>
                                    @elseif($session == 'session2')
                                        <td>
                                            {!! ($contrat->notes->where('enseignement_id', $enseignement->id)->first()->del2 != null) ? $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del2 : $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del1 !!}
                                        </td>
                                        <td>
                                            {!! (($contrat->notes->where('enseignement_id', $enseignement->id)->first()->del2 != null) ? $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del2 : $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del1) * $enseignement->credits !!}
                                        </td>
                                    @elseif($session == 'enjambement')
                                        <td>
                                            {!! $contrat->notes->where('enseignement_id', $enseignement->id)->first()->enjambement !!}
                                        </td>
                                        <td>
                                            {!! $contrat->notes->where('enseignement_id', $enseignement->id)->first()->enjambement * $enseignement->credits !!}
                                        </td>
                                    @endif
                                @endif
                            @endforeach
                            <td>
                                {{ $contrat->ue_infos->where('ue_id', $ue->id)->first()->moyenne }}
                            </td>

                                @if($contrat->ue_infos->where('ue_id', $ue->id)->first()->mention == 'Validé')
                                    <td class="bg-success">
                                        V
                                    </td>
                                @else
                                    <td class="bg-danger">
                                        NV
                                    </td>
                                @endif
                        @endforeach
                        <td>{{ $contrat->semestre_infos->where('semestre_id', $semestre->id)->first()->nbUeValid }}</td>
                        <td>{{ $contrat->semestre_infos->where('semestre_id', $semestre->id)->first()->moyenne }}</td>
                        <td>
                            @if($contrat->semestre_infos->where('semestre_id', $semestre->id)->first()->mention == 'Validé')
                                X
                            @endif
                        </td>
                        {{--<td>--}}
                            {{--@if($contrat->semestre_infos->where('semestre_id', $semestre->id)->first()->mention == 'Validé par Compensation')--}}
                                {{--X--}}
                            {{--@endif--}}
                        {{--</td>--}}
                        <td>
                            @if($contrat->semestre_infos->where('semestre_id', $semestre->id)->first()->mention == 'Non Validé')
                                X
                            @endif
                        </td>
                    </tr>
                @endif
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="">
            <div class="row">
                <h4 class="text">Fait à {{ (env('APP_URL') == 'https://www.gescopayaounde.com' ? 'Yaounde' : 'Douala') }}, le ...... / ...... /.......</h4>
            </div>
            <div class="row">
                <div class="col-xs-3 pull-left">
                    <h4 class="text-center"><strong>Le President du Jury</strong></h4>
                </div>
                <div class="col-xs-3 ">
                    <h4 class="text-center"><strong>Le Coordonnateur</strong></h4>
                </div>
                <div class="col-xs-3">
                    <h4 class="text-center"><strong>Le Rapporteur</strong></h4>
                </div>
                <div class="col-xs-3 pull-right">
                    <h4 class="text-center "><strong>Les Membres</strong></h4>
                </div>
            </div>
        </div>
        <div class=" fixed-bottom">
            <br><br><br><br><br><br><br><br><br><br><br>
            <h4 class="pull-right"><strong>{{ 'PIG/'.(request()->getHost() == 'www.gescopig.com' ? 'DLA' : 'YDE') }}</strong></h4>
        </div>

    </div>
{{--    <div class="row">--}}
{{--        <button class="btn btn-primary" onclick="imprimer('rnr')">Imprimer</button>--}}
{{--    </div>--}}
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
        console.log({{ request()->getHost() }})
    }
</script>
</body>

</html>