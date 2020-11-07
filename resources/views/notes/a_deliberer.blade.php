@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>
    <section class="content-header">
        <h1>
            Choisir les etudiants à deliberer
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="">
                    {!! Form::open([route('notes.pv', [$spec, $sem, $session])]) !!}

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
                            {!! Form::hidden('ay_id', $contrats->first()->academic_year_id) !!}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <h4 class="pull-right" style="padding: 0px">
                    {!! Form::submit('Imprimer PV', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('notes.search', ['5', $session]) !!}" class="btn btn-default">Cancel</a>
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