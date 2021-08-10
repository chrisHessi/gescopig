<!-- Form field for ville's name -->
<div class="form-group @if ($errors->has('nom')) has-error @endif">
    {!! Form::label('nom', 'Nom de la ville') !!}
    {!! Form::text('nom', null, array('class' => 'form-control')) !!}
</div>

<!-- Form field for ville's code -->
<div class="form-group @if ($errors->has('code')) has-error @endif">
    {!! Form::label('code', 'Code de la ville') !!}
    {!! Form::text('code', null, array('class' => 'form-control')) !!}
</div>

<!-- Form field for ville's code -->
<div class="form-group @if ($errors->has('pays_id')) has-error @endif">
    {!! Form::label('pays_id', 'Pays:') !!}
    {!! Form::select('pays_id',$paysNames, isset($ville->pays_id) ? $ville->pays_id : null,['class' => 'form-control', 'placeholder' => '']) !!}
</div>