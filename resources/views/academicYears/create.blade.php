@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Academic Year
        </h1>
    </section>
    <div class="row container">
        <div class="content">
            @include('adminlte-templates::common.errors')

            {!! Form::open(['route' => 'academicYears.store', 'id' => 'form']) !!}

            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="form-group col-sm-4">
                            {!! Form::label('debut', 'Année de debut :') !!}
                            {!! Form::text('debut', isset($academicYear) ? $academicYear->debut : null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-4">
                            {!! Form::label('fin', 'Année de fin') !!}
                            {!! Form::text('fin', isset($academicYear) ? $academicYear->fin : null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-4">
                            {!! Form::label('actif', 'Année en cours?') !!}
                            {!! Form::select('actif', [1 => 'Oui',0 => 'Non'], isset($academicYear) ? $academicYear->actif : null, ['class' => 'form-control', 'placeholder' => '--- Votre choix ---']) !!}
                        </div>

                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-right">
                        {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('academicYears.index') !!}" class="btn btn-default">Annuler</a>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection