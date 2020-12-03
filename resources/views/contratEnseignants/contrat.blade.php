<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Certificat de scolarite</title>

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
            border-bottom: solid 5px #9e9e9e;
        }
        #annee{
            color: #002d72;
            font-size: 22px;
        }
        #acad{
            font-size: 10px;
        }
        #specialite span{
            padding-left: 80px;
        }
        div .infos{
            margin: 5px auto;
            font-size: 12px;
        }
        div .echeanciers{
            margin: 5px 10px;
            font-size: 10px;
        }
        .borderless > tbody > tr > td,
        .borderless > tbody > tr > th,
        .borderless > tfoot > tr > td,
        .borderless > tfoot > tr > th,
        .borderless > thead > tr > td,
        .borderless > thead > tr > th {
            border: none;
            font-size: 11px;
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

        ol li {
            color: #000;
        }

        .footer p{
            color: #ffffff;
        }
        p{
            margin-bottom: 3px;
            color: #000000;
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
        .sign{
            margin-top: 10px;
        }
        .apprenant{
            border-bottom: solid 1px ;
        }
    </style>
</head>

<body class="skin-blue sidebar-mini fixed" id="certificat">

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content container-fluid .page-break" >
            <div class="container-fluid">
                <div class="logo-container">
                    <div class="row">
                        <div class="col-xs-2">
                            <img src="{{ url('images/logo_pigier.jpg') }}" alt="logo pigier" class="logo">
                        </div>
                    </div>      
                    <div class="row">
                        <h3 class="text-center">CONTRAT DE CHARGE D’ENSEIGNEMENT ASSOCIE</h3>
                    </div>
                </div>
                
                <div class="row text-center">
                    <h4 id="annee"><i>ANNEE ACADEMIQUE {{ $contrat->academic_year->debut.'-'.$contrat->academic_year->fin .'/PIG/'.(request()->getHost() == 'www.gescopigyaounde.com' ? 'YDE' : 'DLA').'/' .str_pad($contrat->rang,3,0,STR_PAD_LEFT).'/'. substr($contrat->academic_year->debut, -2).'-'.substr($contrat->academic_year->fin, -2).'/'.$signataire }}</i></h4>
                </div>
                <div id="contenu" style="text-align: justify">
                    <p><strong>ENTRE LES SOUSSIGNES</strong></p>
                    <p><strong>L’ECOLE SUPERIEURE DE COMMERCE ET DE MANAGEMENT PIGIER CAMEROUN</strong> B.P 1133, représentée par son Promoteur Directeur Général et Franchisé <strong>Docteur TAFOU TCHOUATO Henri,</strong></p>
                    <p>D’une part</p>
                    <p>Et</p>
                    <p>
                        {!! '<strong>'.$contrat->enseignant->titre .' ' .$contrat->enseignant->name.'</strong> ; né(e) le <strong>'. (($contrat->enseignant->date_naissance != null) ? $contrat->enseignant->date_naissance->format('d/m/Y') : ''). ' à '. $contrat->enseignant->lieu_naissance .'</strong>; deumerant à <strong>'. $contrat->enseignant->domicile .';</strong> nationalité : <strong>Camerounaise</strong>, ci après désigné(e) <strong>l\'enseignant</strong> '!!}
                    </p>
                    <p>
                        De profession : <strong>{{ ($contrat->enseignant->profession) ? $contrat->enseignant->profession : 'Non rensenseigné' }}</strong> ; Tél : <strong>{{ $contrat->enseignant->tel }}</strong>  ; e-mail : <strong>{{ $contrat->enseignant->mail }}</strong>;
                    </p><br>
                    {{--<p>--}}
                        {{--ECUE(s) enseigné(s):--}}
                        {{--@foreach($ecues as $ecue)--}}
                            {{--<span><strong>{{ $ecue->title }};</strong></span>--}}
                        {{--@endforeach--}}
                    {{--</p><br>--}}
                    <p>D’autre part,</p>
                    <p>Il a été convenu ce qui suit :</p>
                    <ol>
                        <li>
                            L’enseignant s’engage à assurer en qualité de chargé d’enseignement associé des cours à l’ESCM PIGIER Cameroun en fonction de l’emploi de temps établi par la Direction des Etudes et ce pour les ECUEs arrêtés de commun accord (Voir annexe au contrat);
                        </li>
                        <li>
                            Il s’engage également à respecter le règlement intérieur des enseignants en vigueur dans l’Etablissement ;
                        </li>
                        <li>
                            La rémunération brute horaire est de <strong>F CFA {{ $contrat->mh_licence }}</strong>  Licence, Pour master <strong>F CFA {{ $contrat->mh_master }}</strong>
                        </li>
                        <li>
                            La rémunération n’est due que pour les heures de cours effectivement assurées en présence des apprenants après dépôt auprès de la Direction des Etudes dans les délais arrêtés des documents ci-après :
                            <ul>
                                <li>Fiche de progression</li> 
                                <li>Note de cours</li>
                                <li>Notes de contrôle continu</li>
                                <li>Deux sujets d’examen de fin de semestre avec corrigés types</li>
                                <li>Liste de trois ouvrages pour la bibliothèque ;</li>
                                <li>Note d'honoraires</li>
                            </ul>

                        </li>
                        <li>
                            <strong>
                                Les paiements s’effectueront 30 jours fin de mois fin de module après correction et remise de toutes les copies d’examen et toutes les notes des premières sessions d'examens ;
                            </strong>
                        </li>
                        <li>
                            <strong>
                                L’enseignant s’engage à encadrer les apprenants pour la rédaction de leur mémoire, et à ce titre, il percevra FCFA 10 000 par apprenant pour la Licence et FCFA 15 000 par apprenant pour le Master en conformité avec les conditions d’encadrement consignées dans la note d’information N° 001/14/NI/DE-CP/SD DU 06 Mai 2014 ;
                            </strong>
                        </li>
                        <li>
                            L’enseignant s’engage à ne divulguer ou utiliser pour son compte ni pour le compte des tiers les informations ou documents concernant l’ESCM PIGIER Cameroun aussi bien pendant la durée de ses fonctions de chargé d’enseignement associé qu’après leur cessation ;
                        </li>
                        <li>
                            En cas de non-respect des prescriptions ci-dessus indiquées, l’ESCM PIGIER Cameroun peut mettre de plein droit fin à ce contrat par simple lettre de notification ;

                        </li>
                        <li>
                            Le présent contrat n’est valable que pour l’année académique {{ $contrat->academic_year->debut.'-'.$contrat->academic_year->fin }} ;
                        </li>
                        <li>
                            Le présent contrat n’est pas un contrat de travail au sens du code de travail et donc n’emporte aucune obligation entre les parties au-delà de la période indiquée au point 10 ;
                        </li>
                        <li>
                            Tous les litiges nés de l’application ou de l’interprétation des présentes seront préalablement soumis à l’arbitrage, notamment par devant le centre d’arbitrage du CADEV à Douala.
                        </li>
                    </ol>

                </div>

                <div id="pied">
                    <div class="row">
                        <p class="text-left">Fait en double exemplaire à douala, le ____________________</p>
                        <p class="text-right">PJ : 1 copie du reglement interieur</p>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 pull-left">
                            <p><strong>Pour l'ESCM PIGIER</strong></p>
                            <p><strong>Le Promoteur Directeur Général et Franchisé (PDGF)</strong></p>
                            @if(request()->getHost() == 'www.gescopigyaounde.com')
                                <p>P/O :<strong> Le Directeur Délégué</strong></p>
                            @endif
                        </div> 
                        <div class="col-xs-4 pull-right">
                            <p><strong>L'enseignant(e)</strong></p>
                            <p>Lu et approuvé</p>
                        </div>

                    </div>

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