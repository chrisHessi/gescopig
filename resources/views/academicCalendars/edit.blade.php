@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ $calendar->semestre->title }}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($calendar, ['route' => ['academicCalendars.update', $calendar->id], 'method' => 'patch']) !!}

                        <div class="form-group col-sm-3">
                            {!! Form::label('dateDebutPrevue', 'Date debut prevue:') !!}
                            {!! Form::date('dateDebutPrevue', isset($calendar) ? $calendar->dateDebutPrevue : null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-3">
                            {!! Form::label('dateDebut', 'Date debut effective:') !!}
                            {!! Form::date('dateDebut', isset($calendar) ? $calendar->dateDebut : null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-3">
                            {!! Form::label('dateFinPrevue', 'Date fin prevue:') !!}
                            {!! Form::date('dateFinPrevue', isset($calendar) ? $calendar->dateFinPrevue : null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-3">
                            {!! Form::label('dateFin', 'Date fin effective:') !!}
                            {!! Form::date('dateFin', isset($calendar) ? $calendar->dateFin : null, ['class' => 'form-control']) !!}
                        </div>

                    <div class="form-group col-sm-12">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! route('academicCalendars.index') !!}" class="btn btn-default">Cancel</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection