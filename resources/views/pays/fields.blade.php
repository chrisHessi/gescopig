<!-- Form field for country's name -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('nom', 'Nom du pays') !!}
    {!! Form::text('nom', null, array('class' => 'form-control')) !!}
</div>

<!-- Form field for country's code -->
<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('code', 'Code du pays') !!}
    {!! Form::text('code', null, array('class' => 'form-control')) !!}
</div>