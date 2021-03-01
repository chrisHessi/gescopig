@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <section class="content-header">
        <h1>
            Choisir les etudiants Diplomés
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            {!! Form::open(['route' =>'scolarites.attestations_reussite'], ['onSubmit'=>'window.open()']) !!}
            <div class="box-header">
                <div class="form-group col-xs-4 ">
                    {!! Form::label('session_fr', 'Session (FR):') !!}
                    {!! Form::text('session_fr', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xs-4">
                    {!! Form::label('session_en', 'Session (EN) :') !!}
                    {!! Form::text('session_en', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-xs-4">
                    {!! Form::label('date', 'Date de délibération :') !!}
                    {!! Form::date('date', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="box-body">
                <div class="">
                    <div>
                        <table class="table table-condensed table-striped" id="apprenantTable">
                            <thead>
                            <tr>
                                <th><input id="tout_cocher" name="tout_cocher" type="checkbox"></th>
                                <th>Name</th>
                                <th>niveau</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($contrats as $contrat)
                                <tr>
                                    <td>{!! Form::checkbox('contrat_id[]', $contrat->id, null, ['class' => 'apprenants']) !!}</td>
                                    <td>{!! $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom !!}</td>
                                    <td>{!! $contrat->specialite->slug.' '.$contrat->cycle->niveau !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <h4 class="pull-right" style="padding: 0px">
                    {!! Form::submit('Imprimer PV', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('scolarites.search', ['1']) !!}" class="btn btn-default">Cancel</a>
                </h4>
            </div>

        </div>
        {!! Form::close() !!}
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $("#tout_cocher").click(function () {
                if($("#tout_cocher").is(':checked')){
                    $(".apprenants").prop("checked", true)
                }
                else {
                    $(".apprenants").prop("checked", false)
                }
            })


        })
    </script>
@endsection