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
            @foreach($semestres as $semestre)
                <div class="row">
                    <div class="form-group col-sm-3">
                        {!! Form::label('dateDebutPrevue'. $semestre->id, 'Date debut prevue:') !!}
                        {!! Form::date('dateDebutPrevue'. $semestre->id, ($semestre->academic_calendars->where('academic_year_id', $ay)->first() != null) ? $semestre->academic_calendars->where('academic_year_id', $ay)->first()->dateDebutPrevue : null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-3">
                        {!! Form::label('dateDebut'. $semestre->id, 'Date debut effective:') !!}
                        {!! Form::date('dateDebut'. $semestre->id, ($semestre->academic_calendars->where('academic_year_id', $ay)->first() != null) ? $semestre->dateDebut : null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-sm-3">
                        {!! Form::label('dateFinPrevue'. $semestre->id, 'Date fin prevue:') !!}
                        {!! Form::date('dateFinPrevue'. $semestre->id, ($semestre->academic_calendars->where('academic_year_id', $ay)->first() != null) ? $semestre->academic_calendars->where('academic_year_id', $ay)->first()->dateFinPrevue : null, ['class' => 'form-control']) !!}
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