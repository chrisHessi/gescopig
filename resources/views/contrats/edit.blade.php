@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Contrat D'inscripition
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div>
                    {!! Form::model($contrat, ['route' => ['contrats.update', $contrat->id], 'method' => 'patch']) !!}

                    <div class="form-group col-md-4">
                        {!! Form::label('specialite_id', 'Specialite :') !!}
                        {!! Form::select('specialite_id', $specialites, $contrat->specialite->id, ['class' => 'form-control', 'placeholder' => '--choisissez la specialite--']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        {!! Form::label('cycle_id', 'Cycle :') !!}
                        {!! Form::select('cycle_id', $cycles, $contrat->cycle->id, ['class' => 'form-control', 'placeholder' => '--choisissez le niveau--']) !!}
                    </div>
                    <div class="form-group col-md-4">
                        {!! Form::label('state', 'Statut :') !!}
                        {!! Form::select('state', ['Etabli'=>'Etabli', 'En Attente de Retour' => 'En Attente de Retour', 'Retourné' => 'Retourné'], $contrat->state, ['class' => 'form-control']) !!}
                    </div>

                </div>
            </div>
            <div class="panel panel-default ">
                <div class="panel-heading">Liste des Apprenants</div>
                <div class="panel-body">
                    <ul class="form-group list-group">
                            <li class="list-group-item">
                                <label class="form-check-inline">
                                    {{--{!! Form::hidden('cycle', false) !!}--}}
                                    <label class="form-check-inline">
                                        {{--{!! Form::hidden('cycle', false) !!}--}}
                                        {!! Form::radio('apprenant_id', $contrat->apprenant->id, true) !!}
                                        {!! Form::label('apprenant_id',$contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom)!!}
                                    </label>

                                </label>
                            </li>
                    </ul>
                </div>
                <div class="panel-footer text-right">

                </div>
            </div>

            <div class="box-footer text-right">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{!! route('contrats.index') !!}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection