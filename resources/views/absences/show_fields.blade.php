<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $absence->id !!}</p>
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', 'Date:') !!}
    <p>{!! $absence->date !!}</p>
</div>

<!-- Justify Field -->
<div class="form-group">
    {!! Form::label('justify', 'Justify:') !!}
    <p>{!! $absence->justify !!}</p>
</div>

<!-- Justification Field -->
<div class="form-group">
    {!! Form::label('justification', 'Justification:') !!}
    <p>{!! $absence->justification !!}</p>
</div>

<!-- Ecue Id Field -->
<div class="form-group">
    {!! Form::label('ecue_id', 'Ecue Id:') !!}
    <p>{!! $absence->ecue_id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $absence->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $absence->updated_at !!}</p>
</div>

