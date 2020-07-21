@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Enseignement
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-header">
                <button class="btn btn-success pull-right" onclick="imprimer('table')">Download PDF</button>
            </div>
            <div class="box-body" id="table">
                <div class="container-fluid">

                    @include('enseignements.pdfView')

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.js"></script>

    <script>
        function imprimer(table){
            console.log(document.getElementById(table))
            var printContents = document.getElementById(table).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection