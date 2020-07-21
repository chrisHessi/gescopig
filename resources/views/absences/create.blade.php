@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Absence
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        {{--<div class="box box-primary">--}}

            {{--<div class="box-body">--}}
                {{--<div class="row">--}}
                    {{--{!! Form::open(['id' => 'filtreEtudiant']) !!}--}}

                        {{--@include('absences.fields')--}}

                    {{--{!! Form::close() !!}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="box box-primary">
            {!! Form::open(['route' => 'absences.store' ]) !!}
            <div class="box-body">

                <div>
                    <table class="table table-condensed table-striped" id="apprenantTable">
                        <thead>
                            <tr>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('date', 'Date:') !!}
                                    {!! Form::date('date', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-6">
                                    {!! Form::label('ecue_id', 'Ecue:') !!}
                                    {!! Form::select('ecue_id',$enseignements,null,['class' => 'form-control', 'placeholder' => '']) !!}
                                </div>
                            </tr>
                            <tr>
                                <th>id</th>
                                <th>Name</th>
                                <th>niveau</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($contrats->where('academic_year_id', AcademicYear::getCurrentAcademicYear()) as $contrat)
                                <tr>
                                    <td>{!! Form::checkbox('contrat_id[]', $contrat->id, null, ['id' => 'apprenants']) !!}</td>
                                    <td>{!! $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom !!}</td>
                                    <td>{!! $contrat->specialite->slug.' '.$contrat->cycle->niveau !!}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <h4 class="pull-right" style="padding: 0px">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('absences.search', ['1']) !!}" class="btn btn-default">Cancel</a>
                </h4>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
@endsection

@section('scripts')
    <script src="http://localhost/pigier/public/js/jquery.tablesorter.js"></script>
    <script>
        $(function(){
            $('#apprenantTable').tablesorter();
            $('#filtreEtudiant').submit(function(e){
                e.preventDefault();
                var c = $('#cycle').val();
                var sp = $('#specialite').val();

                $.post(
                   'absences/search',
                   {cycle:c, specialite:sp},
                   function(data){
                       console.log(data);
                   }
                );

            });
        });

        {{--$(function(){--}}
            {{--oTable = $('#Apprenant-table').DataTable({--}}
                {{--"processing": true,--}}
                {{--"serverSide" : true,--}}
                {{--"ajax":{--}}
                    {{--url: "{{ route('absence.search') }}",--}}
                    {{--data: function(d){--}}
                        {{--d.cycle = $('input[name=name]').val();--}}
                    {{--}--}}

                {{--},--}}
                {{--"columns": [--}}
                    {{--{data: 'id', name: 'id'},--}}
                    {{--{data: 'name', name: 'name'},--}}
                    {{--{data: 'cycle.name', name: 'cycle'}--}}
                {{--]--}}
            {{--});--}}

            {{--$('#cycle').on('change', function(e){--}}
                {{--oTable.draw();--}}
                {{--e.preventDefault();--}}
            {{--})--}}
        {{--});--}}
    </script>
@endsection
