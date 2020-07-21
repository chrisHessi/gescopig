<!-- Title Field -->

<div class="form-group col-sm-4">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('suffixe', 'Suffixe:') !!}
    {!! Form::number('suffixe', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('cycle_id', 'Cycle:') !!}
    {!! Form::select('cycle_id',$cycle,null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('dateDebutPrevue', 'Date debut prevue:') !!}
    {!! Form::date('dateDebutPrevue', isset($calendar) ? $calendar->dateDebutPrevue : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('dateDebut', 'Date debut effective:') !!}
    {!! Form::date('dateDebut', isset($calendar) ? $calendar->dateDebut : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('dateFinPrevue', 'Date fin prevue:') !!}
    {!! Form::date('dateFinPrevue', isset($calendar) ? $calendar->dateFinPrevue : null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('dateFin', 'Date fin effective:') !!}
    {!! Form::date('dateFin', isset($calendar) ? $calendar->dateFin : null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('mhSemaine', 'Mhsemaine:') !!}
    {!! Form::number('mhSemaine', isset($semestre) ? $semestre->mhSemaine : null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('semestres.index') !!}" class="btn btn-default">Cancel</a>
</div>

