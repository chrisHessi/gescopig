@extends('layouts.app')
@section('content')
    <div class="content" id="imprime">
        <div class="box box-default">
        <div class="box-body">
            <div class="header row bg-white">
                <div class="col-xs-3 logo">
                    <div><img src="{{ url('images/logo_pigier.jpg') }}" alt=""></div>
                </div>
                <div class="col-xs-6">
                    <h3 class="text-center">NOTES DE CONTROLES CONTINUS</h3>
                    <h3 class="text-center">Spécialité : {{ $contrats->first()->specialite->slug }}</h3>
                    <h3 class="text-center">{{ $semestre->title}}</h3>
                    <h3 class="text-center">Année Académique : {{ $academicYear->debut. '-' .$academicYear->fin }}</h3>
                </div>
                <div class="col-xs-3 pull-right pt-5">
                    <div>
                        <h4>Réf: PIG/RFO/F/029</h4>
                        <h4>Version: 1.0</h4>
                    </div>
                </div>
            </div>

            <table class="table table-bordered table-striped table-condensed" id="pv">
                <thead>
                <tr>
                    <th rowspan="2" class="vertical ref">Ref_Contrat</th>
                    <th rowspan="2">Nom et Prenom</th>
                    <th colspan="{{ $enseignements->count() +1 }}" class="text-center">ELEMENTS CONSTITUTIFS D'UNITE D'ENSEIGNEMENT (ECUES)</th>
                </tr>
                <tr>
                    @foreach($enseignements as $enseignement)
                        <th class="vertical">{{ $enseignement->ecue->title }}</th>
                    @endforeach
                </tr>
{{--                <tr>--}}
{{--                    @foreach($enseignements as $enseignement)--}}
{{--                        <th>Note CC/20</th>--}}
{{--                    @endforeach--}}
{{--                </tr>--}}
                </thead>
                <tbody>
                @foreach($contrats as $contrat)
                    <tr>
                        <td>{!! $academicYear->debut.'-'.$contrat->id !!}</td>
                        <td>{!! $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom !!}</td>
                        @foreach($enseignements as $enseignement)
                            <td class="text-right">{!! ($contrat->notes->where('enseignement_id', $enseignement->id)->first()) ? $contrat->notes->where('enseignement_id', $enseignement->id)->first()->cc : 0 !!}</td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>


            <div class="footer">
                <div class="">
                    <h4 class="text">Fait à Douala, le ...... / ...... /.......</h4><br><br>
                </div>
                <div class="row">
                    <div class="col-xs-3 pull-left">
                        <h4 class="text-center"><strong>Le DIRECTEUR DES ETUDES</strong></h4>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <button class="btn btn-primary" onclick="imprimer('imprime')">Imprimer</button>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>

    <script>
        // $(document).ready(function() {
        //     var table = $('#pv').DataTable({
        //         responsive: true,
        //         dom:'Blfrtip',
        //         buttons:[
        //             'copy', 'excel', 'pdf'
        //         ],
        //         "columnDefs":[
        //             {"orderable":false, "targets":2}
        //         ]
        //     });
        //
        //     table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container() ))

        // });
    </script>
    <script>
        function imprimer(rnr){
            var printContents = document.getElementById(rnr).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection