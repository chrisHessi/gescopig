<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Avis de suspension</title>

    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
    <style>
        .logo_pigier{
            width: 60%;
            height: 80%;
        }
        .small-text{
            font-size: 10px;
            margin: auto 0px;
            padding: 0px;
        }
        .big-text p{
            font-size: 16px;
            line-height: 14px;
        }
        .logo-container{
            margin: 20px auto;
            border-bottom: solid 5px;
        }
        #acad{
            font-size: 10px;
        }
        #specialite span{
            padding-left: 80px;
        }
        div .infos{
            margin: 5px auto;
            font-size: 14px;
        }
        .borderless > tbody > tr > td,
        .borderless > tbody > tr > th,
        .borderless > tfoot > tr > td,
        .borderless > tfoot > tr > th,
        .borderless > thead > tr > td,
        .borderless > thead > tr > th {
            border: none;
            font-size: 14px;
        }
        .tuteur > thead > tr {
            background-color: grey;
        }
        .echeancier{
            margin-bottom: 5px;
        }
        .footer{
            background-color: #0b58a2;
            position: fixed;
            bottom: 10px;
            width:90%;
            margin-left: 30px;
        }
        .footer p{
            color: #ffffff;
        }
        p{
            margin-bottom: 3px;
        }
        .signatures{
            /*background-color: #7DA0B1;*/
            height: 60px;
        }
        @media print{
            .signatures td,
            .signatures th,
            .signatures tr{
                /*background-color: #7DA0B1 !important;*/
            }

            .tuteur th{
                background-color: grey !important;
            }
            .echeancier th{
                background-color: grey !important;
            }
            div .infos{
                margin: 5px auto;
                font-size: 12px;
            }
            div .echeanciers{
                margin: 5px 10px;
                font-size: 10px;
            }
            .conditions p{
                font-size: 11px;
            }
            .logo_pigier{
                width: 60%;
                height: 200px;
            }
        }
        .apprenant{
            border-bottom: solid 1px ;
        }

        .message p{
            font-size: 18px;
            line-height: 30px;
        }
        div .message{
            margin-top: 30px
        }
    </style>
</head>

<body class="skin-blue sidebar-mini fixed" id="certificat">

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content container-fluid .page-break" >
            <div class="container-fluid">
                <div class="logo-container row">
                    <div class="col-xs-2"><img src="{{ ($contrat->cycle->label == 'MBA') ? url('images/mbway.jpg') : url('images/logo_pigier.jpg') }}" alt="logo pigier" class="logo {{($contrat->cycle->label != 'MBA' ? 'pigier_logo' : 'logo')}}"></div>
                    <div class="col-xs-2 text-right small-text"><p>ECOLE SUPERIEURE DE COMMERCE ET DE MANAGEMENT <br>BP: 1133 Douala</p></div>
                    <div class="col-xs-5 text-center big-text">
                        <h4><strong>AVIS DE SUSPENSION</strong></h4>
                    </div>
                    <div class="col-xs-3 pull-left col-offset-1">
                        <p class="text-right"><i>Année Académique</i></p>
                        <p class="text-right"><i> {{ $academicYear->debut. '-' .$academicYear->fin }} </i></p>
                    </div>
                </div>
            
                <div class="row infos apprenant">
                    <div class="col-xs-5">
                        <table class="table borderless">
                            <tr>
                                <th>Avis de suspension du :</th>
                                <td>{{ Carbon\Carbon::today()->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <th>Réf. contrat :</th>
                                <td>{{ $academicYear->fin. '-' .$contrat->id }}</td>
                            </tr>
                            <tr>
                                <th>Matricule</th>
                                <td>{{ $contrat->apprenant->matricule }}</td>
                            </tr>
                            <tr>
                                <th>Spécialité-Niveau</th>
                                <td>{{ $contrat->specialite->slug. ' '. $contrat->cycle->niveau }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-xs-6 col-offset-1 text-right pull-right">
                        <table class="table borderless">
                            <tr>
                                <th>Total de la scolarité:</th>
                                <td>{{ $contrat->cycle->echeanciers->where('academic_year_id', $contrat->academic_year_id)->sum('montant') }}</td>
                            </tr>
                            <tr>
                                <th>Bourse/Réduction:</th>
                                <td>{{ $reduction }}</td>
                            </tr>
                            <tr>
                                <th>Total payé:</th>
                                <td>
                                    {{ $contrat->versements->sum('montant') }}
                                </td>
                            </tr>
                            <tr>
                                <th>Solde en cours:</th>
                                <td>{{ $contrat->cycle->echeanciers->where('academic_year_id', $contrat->academic_year_id)->sum('montant') - $contrat->versements->sum('montant') - $reduction}}</td>
                            </tr>
                            <tr>
                                <th>Montant portant avis:</th>
                                <td>{{ (($contrat->moratoire) ? $contrat->moratoires->where('date', '<=', Carbon\Carbon::today())->sum('montant') : $contrat->cycle->echeanciers->where('academic_year_id', $contrat->academic_year_id)->where('date', '<=', Carbon\Carbon::today())->sum('montant'))- $contrat->versements->sum('montant')- $reduction }}</td>
                            </tr>
                            <tr>
                                <th>Date portant échéance:</th>
                                <td>{{ ($contrat->moratoires->first()) ? $contrat->moratoires->where('date', '<=', Carbon\Carbon::today())->last()->date->format('d/m/Y') : $contrat->cycle->echeanciers->where('academic_year_id', $contrat->academic_year_id)->where('date', '<=', Carbon\Carbon::today())->last()->date->format('d/m/Y') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="text-justify message">
                    <p>
                        <strong>{{ (($contrat->apprenant->sexe == 'Homme') ? 'M. ' : 'Mme '). $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom }}</strong><br/>
                        La Direction de l'école PIGIER CAMEROUN eu égard à l'article 1 du contrat préalablement conclu, vous rappelle que le non respect de l'échéance sus-mentionnée, nous met dans la triste obligation de vous suspendre temporairement des cours à partir du {{ Carbon\Carbon::parse($date_susp)->format('d/m/Y') }}. <br/>

                        Nous comptons donc sur votre sens aigu de responsbilité pour que diligence soit faite.<br/>
                        Merci de votre comprehension.<br/><br/>
                    </p>

                    <p><strong>{{ (env('APP_URL') == 'https://www.gescopayaounde.com') ? 'Le Directeur Délégué' : 'La Directrice Administrative'}}</strong></p>
                    @if($titre)
                        <p>{{ $titre }}</p>
                    @endif
                    <br><br>

                    <p><strong>{{ ($titre) ? $signataire : ((env('APP_URL') == 'https://www.gescopayaounde.com') ? 'MINKALA ABEGA RAPHAEL' : "Kristie TAFOU") }}</strong></p>
                </div> 
            </div> 
        </section>
    </div>           
    {{--<div class="row">--}}
        {{--<button class="btn btn-primary" onclick="imprimer('certificat')">Imprimer</button>--}}
    {{--</div>--}}
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script>
    // function imprimer(certificat){
    //     $('.row .btn').hide();
    //     var printContents = document.getElementById(certificat).innerHTML;
    //     var originalContents = document.body.innerHTML;
    //     document.body.innerHTML = printContents;
    //     window.print();
    //     document.body.innerHTML = originalContents;
    // }

    window.onload = window.print();
</script>
</body>

</html>