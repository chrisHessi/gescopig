
<table class="table table-responsive results" id="apprenants-table">
        <thead>
        <tr>
            <th>Matricule</th>
            <th>Name</th>
            <th>Date de naissance</th>
            <th>Nationalité</th>
            <th>E-mail</th>
            <th>Etablissement de provenance</th>
            <th>Nom du Parent</th>
            <th>Mobile du parent</th>
            <th>Action</th>
        </tr>
        {{--<tr class="no-result warning">--}}
            {{--<td colspan="5">No result2</td>--}}
        {{--</tr>--}}
        </thead>
        <tbody>
        @foreach($apprenants as $apprenant)
            <tr>
                <td>{!! $apprenant->matricule !!}</td>
                <td>{!! $apprenant->nom. ' '. $apprenant->prenom !!}</td>
                <td>{!! Carbon\Carbon::parse($apprenant->dateNaissance)->format('d-m-Y') !!}</td>
                <td>{!! $apprenant->nationalite !!}</td>
                <td>{!! $apprenant->email !!}</td>
                <td>{!! $apprenant->etablissement_provenance !!}</td>
                <td>{!! ($apprenant->tutors->first())?$apprenant->tutors->first()->name : 'NC' !!}</td>
                <td>{!! ($apprenant->tutors->first())? $apprenant->tutors->first()->tel_mobile: 'NC' !!}</td>
                <td>
                    @can('delete apprenants')
                        {!! Form::open(['route' => ['apprenants.destroy', $apprenant->id], 'method' => 'delete']) !!}
                    @endcan

                    <div class='btn-group'>
{{--                        <a href="{!! route('apprenants.show', [$apprenant->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                        @can('edit tutors')
                            <a href="{!! route('tutors.index', [$apprenant->id]) !!}" class='btn btn-default btn-xs' alt="editer les parents"><i class="glyphicon glyphicon-user"></i></a>
                        @endcan
                        @can('edit apprenants')
                            <a href="{!! route('apprenants.edit', [$apprenant->id]) !!}" class='btn btn-default btn-xs' title="editer l'apprenant"><i class="glyphicon glyphicon-edit"></i></a>
                        @endcan

                        @can('delete appreants')
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
</table>

@section('scripts')
    {{--<script src="http://localhost/pigier/public/js/jquery.tablesorter.js"></script>--}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
//            $('#apprenants-table').tablesorter();
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

@endsection