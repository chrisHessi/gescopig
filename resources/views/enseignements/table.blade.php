{{--@section('css')--}}
    {{--@include('layouts.datatables_css')--}}
{{--@endsection--}}

{{--{!! $dataTable->table(['width' => '100%']) !!}--}}

{{--@section('scripts')--}}
    {{--@include('layouts.datatables_js')--}}
    {{--{!! $dataTable->scripts() !!}--}}
{{--@endsection--}}

<table cellpadding="0" cellspacing="0" class="table responsive table-stripped results tablesorter" id="enseignements-table">
    <thead>
    <tr>
        <th>Specialite</th>
        <th>Semestre</th>
        <th>Ecue</th>
        <th>Enseignant</th>
        <th>MH totale</th>
        <th>MH Realisée</th>
        <th>Date de Debut</th>
        <th>Date de Fin</th>
        <th>UE</th>
        <th>F. Prog</th>
        <th>F. Comm.</th>
        <th>CC</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>

    @foreach($enseignements as $enseignement)
        <tr>

            <td>{!! $enseignement->specialite->slug.' ' .$enseignement->ecue->semestre->cycle->niveau !!}</td>
            <td>{!! $enseignement->ecue->semestre->title !!}</td>
            <td>{!! $enseignement->ecue->title !!}</td>
            <td>{!! isset($enseignement->contratEnseignant->enseignant->name) ? $enseignement->contratEnseignant->enseignant->name : 'non defini' !!}</td>
            <td>{!! $enseignement->mhTotal !!}</td>
            <td>{!! $enseignement->mhEff !!}</td>
            <td>{!! $enseignement->dateDebut->format('d-m-y') !!}</td>
            <td>{!! isset($enseignement->dateFin) ? $enseignement->dateFin->format('d-m-y') : 'Non determiné' !!}</td>
            <td>{!! $enseignement->ue->title !!}</td>
            <td>{!! $enseignement->progression ? 'Oui' : 'Non' !!}</td>
            <td>{!! $enseignement->communication ? 'Oui' : 'Non' !!}</td>
            <td>{!! $enseignement->cc ? 'Oui' : 'Non' !!}</td>
            <td>
                {!! Form::open(['route' => ['enseignements.destroy', $enseignement->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('enseignements.show', [$enseignement->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('enseignements.edit', [$enseignement->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@section('scripts')
    <script src="http://localhost/pigier/public/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#enseignements-table').DataTable({
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