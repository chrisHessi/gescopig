<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <span>{!! $semestre->id !!}</span>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <span>{!! $semestre->title !!}</span>
</div>

<!-- Cycle Id Field -->
<div class="form-group">
    {!! Form::label('cycle_id', 'Cycle Id:') !!}
    <span>{!! $semestre->cycle_id !!}</span>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <span>{!! $semestre->created_at !!}</span>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <span>{!! $semestre->updated_at !!}</span>
</div>

