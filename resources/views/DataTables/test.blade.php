@extends('layouts.app')

@section('content')
<table id="test" style="width: 100%" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Sexe</th>
            <th>Nationalite</th>
            <th>Nom du Pere</th>
        </tr>
    </thead>
    <tbody>
        @foreach($apprenant as $app)
            <tr>
                <td>{{ $app->nom }}</td>
                <td>{{ $app->prenom }}</td>
                <td>{{ $app->sexe }}</td>
                <td>{{ $app->nationalite }}</td>
                <td>{{ $app->tutor->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.css"/>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.js"></script>
    <script type="text/javascript">
        var table = $('#test').DataTable({
            dom:'Bfrtip',
            buttons:[
                'copy', 'excel', 'pdf'
            ]
        });

        table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container() ))
    </script>
@endsection

