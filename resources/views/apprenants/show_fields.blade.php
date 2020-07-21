<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $apprenant->id !!}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $apprenant->name !!}</p>
</div>

<!-- Tel Field -->
<div class="form-group">
    {!! Form::label('tel', 'Tel:') !!}
    <p>{!! $apprenant->tel !!}</p>
</div>

<!-- Specialite Id Field -->
<div class="form-group">
    {!! Form::label('specialite_id', 'Specialite Id:') !!}
    <p>{!! $apprenant->specialite_id !!}</p>
</div>

<!-- Tel Parent Field -->
<div class="form-group">
    {!! Form::label('tel_parent', 'Tel Parent:') !!}
    <p>{!! $apprenant->tel_parent !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <span>{!! $apprenant->created_at !!}</span>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <span>{!! $apprenant->updated_at !!}</span>
</div>

