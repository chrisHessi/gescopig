@extends('layouts.app')
    @section("css")
        <style>

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
                body .contenu{
                    padding-top: 250px;
                }
            }

            .lieuNaissance{
                padding-left: 40px;
            }

            .lieuNaissanceen{
                padding-left: 135px;
            }
            .footer p{
                font-size: 10px;
                line-height: normal;
            }


            p{
                font-size: 13px;
                font-family: "Comic Sans MS";
                color: black;
            }
            h3{
                margin: 35px auto;
            }

        </style>
    @endsection
    @section('content')
        <div class="container-fluid" id="rnr">
            @foreach($contrats as $contrat)
                <div class="contenu" style="text-align: justify">
                    <br><p><strong>Les soussignés, <br><small><i>The undersigned</i></small></strong></p>
                    <p>Vu le procès – verbal du Jury en date du <b>{{ Carbon\Carbon::parse($date)->format('d/m/Y') }}</b>, certifient que : <br><small><i>Considering the jury’s decison of, <b>{{ Carbon\Carbon::parse($date)->format('d/m/Y') }}</b> certify that :</i></small></p>
                    <p>M./Mme/Mlle <strong>{{ $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom }}</strong><br><small><i>Mr, (Miss)</i></small></p>
                    <p>
                        Né.e le :  {{ $contrat->apprenant->dateNaissance->format('d/m/Y') }} <span class="lieuNaissance">à : {{ $contrat->apprenant->lieuNaissance }}</span> <br>
                        <small><i>Born on <span class="lieuNaissanceen">at :</span></i></small>
                    </p>
                    <p>Inscrit.e sous le matricule N° : <b>{{ $contrat->apprenant->matricule }}</b> <br><small><i>Registration number :</i></small></p>
                    <p>A validé la totalité des Unités d’Enseignement requises pour l’obtention du diplôme de <strong>{{ ($contrat->cycle->label == "Licence") ? "LICENCE PROFESSIONNELLE" : "MASTER PROFESSIONNEL" }}</strong>.
                        <br><small><i>Has successfully validated all the teaching units required for the award of <strong>{{ ($contrat->cycle->label == "Licence") ? "PROFESSIONAL BACHELOR DEGREE" : "PROFESSIONAL MASTER DEGREE" }}</strong>.</i></small></p>
                    <div class="row">
                        <p class="col-xs-8"><u>Domaine</u> : <strong>SCIENCES &Eacute;CONOMIQUES ET DE GESTION</strong> <br>
                                <small><i><strong>Discipline : </strong>Economic Science and Business Administration</i></small></p>
                        <p class="col-xs-4">Mention : <b id="{{ 'mention-'. $contrat->id }}"></b> <br><small><i>Distinction:</i></small></p>
                    </div>
                    <p><b>Spécialité : <b>{{ $contrat->specialite->title }}</b> </b><br><small><i>Speciality: {{ $speciality[$contrat->specialite->slug] }}</i></small></p>
                    <div class="row">
                        <p class="col-xs-8">Année Académique : <b>{{ $contrat->academic_year->debut. '/' .$contrat->academic_year->fin }}</b> <br><small><i>Year : </i></small></p>
                        <p class="col-xs-4"><b>Session: {{ $session_fr }} </b><br><small><i>Session: {{ $session_en }}</i></small></p>
                    </div>
                    <br>
                    <p>En foi de quoi la présente attestation est établie et lui est délivrée pour servir et valoir ce que de droit <strong>en attendant la remise effective dudit diplôme.</strong></p>
                    <p><small><i>In witness where of this individual results testimonial is issued to serve the purpose for which it may be intended, pending effective delivery of said diploma.</i></small></p>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <p class="pull-left"><strong><u>Le Directeur de L'ESSEC/ The Director of ESSEC</u></strong></p><br><br><br><br>
                        <p class="pull-left"><strong>Pr Georges Bertrand TAMOKWE PIAPTIE</strong></p>
                    </div>
                    <div class="col-xs-6">
                        <p class="text-right"><strong><u>Le Responsable Académique/ The Head Teacher:</u></strong></p><br><br><br>
                        <p class="text-right"><strong>Pr Germain NDJIEUNDE</strong></p>
                    </div>
                </div>
                <div style="page-break-after: always;" ></div>
            @endforeach

        </div>
    @endsection

@section("scripts")
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

    $(function () {
        @foreach($contrats as $contrat)
            var moy = parseInt({{ $contrat->semestre_infos->sum('moyenne')/2 }})
            if (moy < 12) {
                $("{{ "#mention-".$contrat->id }}").html("Passable")
            }
            else if (moy < 14) {
                $("{{ "#mention-".$contrat->id }}").html("Assez bien")
            }
            else if (moy < 16) {
                $("{{ "#mention-".$contrat->id }}").html("Bien")
            }
            else if (moy < 18) {
                $("{{ "#mention-".$contrat->id }}").html("Très Bien")
            }
            else if (moy <= 20) {
                $("{{ "#mention-".$contrat->id }}").html("Excellent")
            }
        @endforeach
        var printContents = document.getElementById('rnr').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;

        document.body.innerHTML = originalContents;
        window.onload = window.print(printContents);
    })
</script>
@endsection
{{--</body>--}}

{{--</html>--}}