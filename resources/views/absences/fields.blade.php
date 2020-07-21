<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'form-control']) !!}
</div>

<!-- Justify Field -->
{{--<div class="form-group col-sm-3">--}}
    {{--{!! Form::label('justify', 'Justify:') !!}--}}
    {{--<label class="checkbox-inline">--}}
        {{--{!! Form::hidden('justify', false) !!}--}}
        {{--{!! Form::checkbox('justify', '1', null, ['id' => 'justify']) !!} 1--}}
    {{--</label>--}}
{{--</div>--}}

<div class="form-group col-sm-3">
    {!! Form::label('Semestre', 'Semestres:') !!}
    {!! Form::select('semestre',$semestre,null,['class' => 'form-control', 'id' => 'semestre']) !!}
</div>

<div class="form-group col-sm-3">
    {!! Form::label('Specialite', 'Specialite:') !!}
    {!! Form::select('specialite',$specialite,null,['class' => 'form-control', 'id' => 'specialite']) !!}
</div>

<div class="form-group col-sm-3">
    {!! Form::label('Ecue', 'Ecue:') !!}
    {!! Form::select('ecue',$ecue,null,['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-3">
    {!! Form::label('Cycle', 'Cycle:') !!}
    {!! Form::select('cycle',$cycle,null,['class' => 'form-control', 'id' => 'cycle']) !!}
</div>

{{--<div class="form-group col-sm-3">--}}
    {{--<label class="checkbox-inline form-control">--}}
        {{--{!! Form::hidden('specialite', false) !!}--}}
        {{--{!! Form::checkbox('specialite', '2',null, ['id' => 'specialite']) !!}--}}
        {{--{!! Form::label('specialite','Specialite')!!}--}}

    {{--</label>--}}

{{--</div>--}}

{{--<!-- Justification Field -->--}}
{{--<div class="form-group col-sm-12 col-lg-12">--}}
    {{--{!! Form::label('justification', 'Justification:') !!}--}}
    {{--{!! Form::textarea('justification', null, ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'btn_search']) !!}
    <a href="{!! route('absences.index') !!}" class="btn btn-default">Cancel</a>
</div>
