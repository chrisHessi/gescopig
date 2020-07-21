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
            height: 200px;
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
                <h1 class="text-center">RELEVE DE NOTES INTERMEDIAIRE</h1>
                <h1 class="text-center">Résultat des Examens {{ $semestre->title. ' ' .$session }}</h1>
                <h1 class="text-center">Mention : Science de gestion</h1>
                <h1 class="text-center">Spécialité : {{ $contrats->first()->specialite->slug. " (" .$contrats->first()->specialite->title. ")" }}</h1>
                <h1 class="text-center">Année Académique : {{ $academicYear->debut. '-' .$academicYear->fin }}</h1>
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
                    <tr >
                        <th class="text-center" colspan="{{ 3*$enseignements->count() +1 }}">
                            ELEMENTS CONSTITUTIFS D'UNITE D'ENSEIGNEMENT (ECUES)
                        </th>
                    </tr>
                    <tr class="bg-warning">
                        @foreach($enseignements as $enseignement)
                            <th class="" colspan="3">
                                <div>
                                    <p>
                                        {!! wordwrap($enseignement->ecue->title, 30, '<br />', true) !!}
                                    </p>
                                </div>
                            </th>
                        @endforeach
                    </tr>
                    <tr class="bg-info">
                        @foreach($enseignements as $enseignement)
                            <th>cc</th>
                            <th>Exam.</th>
                            <th>Moy Sem.</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                @foreach($contrats as $contrat)
                    <tr>
                        <td>{!! ++$i !!}</td>
                        <td>{!! $academicYear->debut.'-'.$contrat->id !!}</td>
                        <td>{!! $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom !!}</td>

                        @foreach($enseignements as $enseignement)
                            @if($contrat->notes->where('enseignement_id', $enseignement->id)->first() == null)
                                <td></td>
                                <td></td>
                                <td></td>
                            @else
                                <td class="text-center">{!! ($contrat->notes->where('enseignement_id', $enseignement->id)->first()) ? number_format($contrat->notes->where('enseignement_id', $enseignement->id)->first()->cc,2,',', ' ') : 0 !!}</td>
                                <td class="text-center">{!! ($session == 'session1') ? number_format($contrat->notes->where('enseignement_id', $enseignement->id)->first()->session1,2,',',' ') : number_format($contrat->notes->where('enseignement_id', $enseignement->id)->first()->session2,2,',', ' ') !!}</td>
                                <td class="text-center">{!! ($session == 'session1') ? number_format($contrat->notes->where('enseignement_id', $enseignement->id)->first()->del1,2,',', ' ') : number_format($contrat->notes->where('enseignement_id', $enseignement->id)->first()->del2,2,',', ' ') !!}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
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
    }
</script>
</body>

</html>