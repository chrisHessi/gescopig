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
        }
        section{
            margin-top: 250px;
        }

        .footer p{
            font-size: 10px;
            line-height: normal;
        }


        p{
            font-size: 16px;
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
                    @if($type == 'inscription')
                        <h3 class="text-center"><strong><u>ATTESTATION D'INSCRIPTION</u></strong></h3>
                    @elseif($type == 'preinscription')
                        <h3 class="text-center"><strong><u>ATTESTATION DE PREINSCRIPTION</u></strong></h3>
                    @endif
                    <h3 class="text-center"><strong><u>{{ (($contrat->cycle->label=='MBA') ? 'MBway' : 'PIG/').str_pad($document->rang,3,0,STR_PAD_LEFT).'/'.substr($contrat->academic_year->fin, 2).'/'.$circuit }}</u></strong></h3>

                        <div class="text-justify">
                        <p>
                            Nous soussignés, Monsieur Henri TAFOU,  {{ ($contrat->cycle->label == 'MBA')? 'Directeur MBA' : ' Promoteur Directeur Général et Franchisé de l\'Ecole Supérieure de Commerce et de Management PIGIER' }} CAMEROUN,
                            attestons que l'apprenant(e) <strong>{{ $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom }}</strong> matricule {{ $contrat->apprenant->matricule }} a rempli toutes les formalités {!! ($type == 'inscription') ? 'd\'inscription' : 'de préinscription' !!} en <strong>{{ $contrat->cycle->label. ' ' .$contrat->cycle->niveau }}, </strong>
                            spécialite <strong>{{ $contrat->specialite->title }}</strong> dans notre établissement pour le compte de l'année académique <strong>{{ $contrat->academic_year->debut. '-' .$contrat->academic_year->fin }}</strong>.
                        </p>
                        <p>En foi de quoi, nous lui delivrons cette attestation pour servir et valoir ce que de droit.</p>
                    </div>
                    <div class="text-center observation">
                        <h4 class=""><strong><u>Observations particulières</u></strong></h4>
                        <div class="">
                            <p>................................................................................................................................................</p>
                            <p>................................................................................................................................................</p>
                            <p>................................................................................................................................................</p>
                            <p>................................................................................................................................................</p>
                        </div>
                    </div>
                    <div class="">
                        <p>Fait à Douala le </p>
{{--                        <p>Fait à Yaounde le </p>--}}
                        <br>
                        <p>Le Promoteur Directeur Général et Franchisé</p>
                        @if($titre)
                            <p>P/O: {{ $titre }}</p>
                        @endif
                        <br><br>

                        <p><strong>{{ ($titre) ? $signataire : "Dr Henri TAFOU" }}</strong></p>
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