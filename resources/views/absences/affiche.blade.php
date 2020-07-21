@extends('layouts.app')

@section('content')

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive results tablesorter" id="apprenants-table">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Specialite</th>
                        <th>Tel Parent</th>
                        <th>Absences</th>
                        <th>Absences Non Justifiées</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contrats->where('academic_year_id', AcademicYear::getCurrentAcademicYear()) as $contrat)
                        <tr>
                            <td>{!! $contrat->apprenant->matricule !!}</td>
                            <td>{!! $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom !!}</td>
                            <td>{!! $contrat->specialite->slug.' '.$contrat->cycle->niveau !!}</td>
                            <td>
                                <ul>
                                    @foreach($contrat->apprenant->tutors as $tutor)
                                        <li>{!! $tutor->tel_mobile !!}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{!! $contrat->absences->whereIn('ecue_id', $ecues)->count() !!}</td>
                            <td>{!! $contrat->absences->whereIn('ecue_id', $ecues)->where('justify',0)->count() !!}</td>
                            <td>
                                <div class='btn-group'>
                                    @if($contrat->absences->whereIn('ecue_id', $ecues)->count())
                                        <a href="{!! route('absences.edit', [$contrat->id, $sem]) !!}" class='btn btn-default btn-xs'>Details<i class="glyphicon glyphicon-eye-open"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


@section('scripts')

    <script src="{{ asset("js/jquery.tablesorter.js") }}"></script>
    {{--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">--}}

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>


    <script>

//        $('#apprenants-table').DataTable();
        $(document).ready(function() {

//            $('#apprenants-table').tablesorter();
//
//            $(".search").keyup(function () {
//                var searchTerm = $(".search").val();
//                var listItem = $('.results tbody').children('tr');
//                var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
//
//                $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
//                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
//                }
//                });
//
//                $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
//                    $(this).attr('visible','false');
//                });
//
//                $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
//                    $(this).attr('visible','true');
//                });
//
//                var jobCount = $('.results tbody tr[visible="true"]').length;
//                $('.counter').text(jobCount + ' item');
//
//                if(jobCount == '0') {$('.no-result').show();}
//                else {$('.no-result').hide();}
//            });

            var table = $('#apprenants-table').DataTable({
                responsive: true,
                dom:'Blfrtip',
                buttons:[
                    'copy', 'excel', 'pdf'
                ],
                "columnDefs":[
                    {"orderable":false, "targets":5}
                ]
            });

            table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container() ))

        });
    </script>

@endsection

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.css"/>

    <style>
        .results tr[visible='false'], .no-result{
            display: none;
        }
        .results tr[visible='true']{
            display: table-row;
        }
        .counter{
            padding: 8px;
            color: #acacac;
        }
    </style>
@endsection()
