@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Ecues</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('ecues.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('ecues.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.js"></script>
    <script type="text/javascript">
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
            var table = $('#ecuesTable').DataTable({
                dom:'Blfrtip',
                buttons:[
                    'copy', 'excel', 'pdf'
                ],
                "columnDefs":[
                    {"orderable":false, "targets":5}
                ]
            });

            table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container() ))
    </script>

@endsection

@section('css')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/datatables.min.css"/>

    {{--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">--}}
    {{--<style>--}}
        {{--.results tr[visible='false'], .no-result{--}}
            {{--display: none;--}}
        {{--}--}}
        {{--.results tr[visible='true']{--}}
            {{--display: table-row;--}}
        {{--}--}}
        {{--.counter{--}}
            {{--padding: 8px;--}}
            {{--color: #acacac;--}}
        {{--}--}}
    {{--</style>--}}
@endsection
