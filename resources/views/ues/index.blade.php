@extends('layouts.app')

@section('content')

    <div class="content col-md-10">
        <h1>{{ __('Liste des unités d\'enseignement') }}</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('ues.create') !!}">Ajouter</a>
        </h1>
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <table id="ue-table" class="table table-bordered table-stripped">
                    <thead>
                    <tr>
                        <th class="">Titre</th>
                        <th>Code</th>
                        <th>categorie</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($ues as $ue)
                        <tr>
                            <td>{{ $ue->title }}</td>
                            <td>{{ $ue->code }}</td>
                            <td>{{ $ue->cat_ue->title }}</td>
                            <td>
                                <div class='btn-group pull-right'>
                                    <a href="{!! route('ues.edit', [$ue->id]) !!}" class='btn btn-primary btn-sm '>Modifier <i class="glyphicon glyphicon-edit"></i></a>
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

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.css"/>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.js"></script>
    <script type="text/javascript">
        var table = $('#ue-table').DataTable({
            dom:'Bfrtip',
            buttons:[
                'copy', 'excel', 'pdf'
            ]
        });

        table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container() ))
    </script>
@endsection