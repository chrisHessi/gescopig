<!-- Name Field -->

<div class="form-group col-sm-6">
    {!! Form::label('titre', 'Titre:') !!}
    {!! Form::select('titre', ['Monsieur' => 'Monsieur', 'Madame' => 'Madame', 'Docteur' => 'Docteur', 'Professeur' => 'Professeur'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Tel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tel', 'Tel:') !!}
    {!! Form::text('tel', null, ['class' => 'form-control']) !!}
</div>

<!-- Mail Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mail', 'Mail:') !!}
    {!! Form::text('mail', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('profession', 'Profession:') !!}
    {!! Form::text('profession', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('domicile', 'Domicile:') !!}
    {!! Form::text('domicile', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('nationalite', 'Nationalité:') !!}
    {!! Form::text('nationalite', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('date_naissance', 'Date de naissance:') !!}
    {!! Form::date('date_naissance', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('lieu_naissance', 'Lieu de naissance:') !!}
    {!! Form::text('lieu_naissance', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('enseignants.index') !!}" class="btn btn-default">Cancel</a>
</div>
