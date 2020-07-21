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
        div .logo{
            width: 250px;
        }

        @media print{
            .footer{
                page-break-after: always;
                position: absolute;
                bottom: 0;
                width: 95%;
                margin-right: 10px;
            }
            div .logo{
                width: 350px;
            }
            .btn{
                display: none;
            }
            p{
                font-size: 18px;!important;
                line-height: 40px;
            }
        }
        section{
            margin-top: 250px;
        }

        .footer p{
            font-size: 10px;
            line-height: normal;
        }


        p{
            font-size: 18px;
            line-height: 40px;
        }
        h3{
            margin: 35px auto;
        }
        div .observation{
            margin-top: 10px;
        }
    </style>
</head>

<body class="skin-blue sidebar-mini fixed" id="certificat">

<div class="wrapper">
    <div class="content-wrapper">
        <section class="content container-fluid .page-break" >
            <div class="container-fluid">
                <div class="" id="separation"></div>
                <div class="container-fluid">
                    <h3 class="text-center"><strong><u>ATTESTATION D'AUTORISATION D'INSCRIPTION N°{{ str_pad($document->rang,3,0,STR_PAD_LEFT) }}</u></strong></h3>
{{--                    <h3 class="text-center"><strong><u>{{ ($contrat->cycle->label=='MBA') ? 'MBway' : 'PIG' }}/006/{{ substr($contrat->academic_year->fin, 2) }}/DA/CF/AA/ADE</u></strong></h3>--}}
                    <div class="text-justify">
                        <p>
                            {{ (($contrat->apprenant->sexe == 'Homme')? 'M. ' : 'Mme/Mlle ') .$contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom  }} né(e)
                            le {{ $contrat->apprenant->dateNaissance->format('d/m/Y'). ' à ' .$contrat->apprenant->lieuNaissance }} est autorisé(e) à s'inscrire à PIGIER-CAMEROUN en {{ $contrat->cycle->label. ' ' .$contrat->cycle->niveau. ', spécialité ' .$contrat->specialite->title }}
                            sur le compte de <strong>ESCM PIGIER CAMEROUN N° 00251211001-35</strong> ouvert à <strong><i>CCA-BANK (Crédit Communautaire d'Afrique).</i></strong>
                        </p>
                    </div>
                    <div class="text-center observation">
                        <h4 class=""><strong><u>Observations</u></strong></h4>
                        <div class="">
                            <p>..........................................................................................................................................................................</p>
                            <p>..........................................................................................................................................................................</p>
                            <p>..........................................................................................................................................................................</p>
                            <p>..........................................................................................................................................................................</p>
                            <p>..........................................................................................................................................................................</p>
                            <p>..........................................................................................................................................................................</p>
                        </div>
                    </div>
                    <div class="">
                        <p>Fait à Douala le </p>
{{--                        <p>Fait à Yaounde le </p>--}}
                        <br>
                        <p>Le Responsable Académique : Pr Germain NDJIEUNDE</p>
                        <p>P/o : {{ ($titre) ? $titre : 'Le Directeur des Etudes' }}</p>
                        <br><br><br>
                        <p><strong>{{ ($titre)? $signataire : 'Pr. NKAKLEU Raphaël' }}</strong></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    {{--    <div class="row">--}}
    {{--        <button class="btn btn-primary" onclick="imprimer('certificat')">Imprimer</button>--}}
    {{--    </div>--}}
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script>
    window.onload = window.print()
    function imprimer(certificat){
//        $('.btn').hide();
        var printContents = document.getElementById(certificat).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

</script>
</body>

</html>