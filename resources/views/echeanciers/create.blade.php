@extends('layouts.app')

@section('content')

    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>

    <section class="content-header">
        <h1>
            {!! isset($echeancier) ? 'Editer echeancier' : 'Creer un Echeancier' !!}
        </h1>
    </section>

    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! isset($echeancier) ? Form::model($echeancier, ['route' => ['echeanciers.update', $echeancier->id], 'method' => 'patch']) :Form::open(['route'=>'echeanciers.store']) !!}
                    <div class="form-group col-sm-4">
                        {!! Form::label('academic_years_id', 'Année academique :') !!}
                        {!! Form::select('academic_year_id', isset($academicYears)? $academicYears : null, isset($echeancier) ? $echeancier->academic_year_id : null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-4">
                        {!! Form::label('cycle_id', 'Niveau') !!}
                        {!! Form::select('cycle_id', isset($cycles)? $cycles : null, isset($echeancier) ? $echeancier->cycle_id : null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-sm-4">
                        {!! Form::label('tranche', 'Tranche') !!}
                        {!! Form::select('tranche', ['Inscription' => 'Inscription','Tranche1' => 'Tranche1', 'Tranche2' => 'Tranche2', 'Tranche3' => 'Tranche3', 'Tranche4' => 'Tranche4'], isset($echeancier) ? $echeancier->tranche : null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-xs-4">
                        {!! Form::label('montant', 'Montant :') !!}
                        {!! Form::number('montant', isset($echeancier)? $echeancier->montant : null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-xs-4">
                        {!! Form::label('date', 'Date d\'echeance') !!}
                        {!! Form::date('date', isset($echeancier)? $echeancier->date : null, ['class' => 'form-control']) !!}
                    </div>

                </div>
            </div>
            <div class="box-footer">
                <div class="pull-right">
                    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('echeanciers.index') !!}" class="btn btn-default">Annuler</a>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection