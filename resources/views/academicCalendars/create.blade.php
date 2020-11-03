@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Apprenant
        </h1>
    </section>
    <div class="row container">
        <div class="content ">
            @include('adminlte-templates::common.errors')

            {!! Form::open(['route' => 'academicCalendars.store', 'id' => 'form']) !!}
            <div class="row">
                <div class="form-group col-xs-6">
                    {!! Form::label('academic_year_id', 'Année Académique:') !!}
                    {!! Form::select('academic_year_id',$academicYears, null, ['class' => 'form-control', 'placeholder' => 'selectioner l\'année']) !!}
                </div>
            </div>
            <hr>
            @foreach($semestres as $semestre)
                <div class="row">
                    <div class="form-group col-sm-3">
                        {!! Form::label('dateDebutPrevue'. $semestre->id, 'Date debut prevue:') !!}
                        {!! Form::date('dateDebutPrevue'. $semestre->id, null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-3">
                        {!! Form::label('dateDebut'. $semestre->id, 'Date debut effective:') !!}
                        {!! Form::date('dateDebut'. $semestre->id, null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-3">
                        {!! Form::label('dateFinPrevue'. $semestre->id, 'Date fin prevue:') !!}
                        {!! Form::date('dateFinPrevue'. $semestre->id, null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-3">
                        <h3>
                            {!! $semestre->title. '-' .$semestre->cycle->label !!}
                        </h3>
                    </div>
                </div>
            @endforeach
            <div class="form-group col-sm-12">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{!! route('academicCalendars.index') !!}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection