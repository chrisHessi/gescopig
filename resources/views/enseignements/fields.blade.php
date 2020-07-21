
<div class="form-group col-sm-6">
    {!! Form::label('ecue_id', 'Ecue:') !!}
    {!! Form::select('ecue_id',$ecues, isset($enseignement) ? $enseignement->ecue->id : null,['class' => 'form-control', 'placeholder' => '', auth()->user()->can('edit enseignements')? '' : 'disabled']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('contrat_enseignant_id', 'Enseignant:') !!}
    {!! Form::select('contrat_enseignant_id',$enseignants, isset($enseignement) ? $enseignement->contratEnseignant->id : null,['class' => 'form-control', 'placeholder' => '', auth()->user()->can('edit enseignements')? '' : 'disabled']) !!}
</div>

<div class="form-group col-sm-6">
    {{ Form::label('credits', 'Credits') }}
    {{ Form::number('credits', isset($enseignement)? $enseignement->credits : null, ['class' => 'form-control']) }}
</div>

<div class="form-group col-sm-6">
    {{ Form::label('ue_id', 'Unite d\'enseignement') }}
    {{ Form::select('ue_id', $ues, isset($enseignement)? $enseignement->ue_id : null, ['class' => 'form-control']) }}
</div>

<!-- Datedebutprevue Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dateDebut', 'Date de Debut du cours:') !!}
    {!! Form::date('dateDebut', isset($enseignement) ? $enseignement->dateDebut : null, ['class' => 'form-control', auth()->user()->can('edit enseignements')? '' : 'disabled']) !!}
</div>



<!-- Datefinprevue Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dateFin', 'Date de fin du cours:') !!}
    {!! Form::date('dateFin', isset($enseignement) ? $enseignement->dateFin : null, ['class' => 'form-control', auth()->user()->can('edit enseignements')? '' : 'disabled']) !!}
</div>



<!-- Masse horaire total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mhTotal', 'Mhtotal:') !!}
    {!! Form::number('mhTotal', isset($enseignement) ? $enseignement->mhTotal : null, ['class' => 'form-control', auth()->user()->can('edit enseignements')? '' : 'disabled']) !!}
</div>

<div class="col-sm-2 form-group">
    {!! Form::label('progression', 'Progression:') !!}
    {!! Form::checkbox('progression', 1, isset($enseignement) ? $enseignement->progression : null, ['class' => 'checkbox', auth()->user()->can('update enseignements')? '' : 'disabled']) !!}
</div>

<div class="col-sm-2 form-group">
    {!! Form::label('communication', 'F.Comm.') !!}
    {!! Form::checkbox('communication', 1, isset($enseignement) ? $enseignement->communication : null, ['class' => 'checkbox', auth()->user()->can('update enseignements')? '' : 'disabled']) !!}
</div>

<div class="col-sm-2 form-group">
    {!! Form::label('cc', 'Contrôle Continu') !!}
    {!! Form::checkbox('cc', 1, isset($enseignement) ? $enseignement->cc : null, ['class' => 'checkbox', auth()->user()->can('update enseignements')? '' : 'disabled']) !!}
</div>
<div class="form-group">
    {{ Form::hidden('specialite_id', $specialite, ['class' => 'form-control']) }}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('enseignements.index') !!}" class="btn btn-default">Cancel</a>
</div>

