<!-- Title Field -->
<div class="form-group col-md-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-6">
    {!! Form::label('semestre_id', 'Semestre') !!}
    {!! Form::select('semestre_id', $semestres, $semestreEcue, ['class' => 'form-control']) !!}
</div>

<div class="panel panel-default ">
    <div class="panel-heading"><strong>Specialite</strong></div>
    <div class="panel-body">
        <ul class="form-group list-group">
            @foreach($specialites as $specialite)
                <li class="list-group-item">
                    <label class="checkbox-inline">
                        {{--{!! Form::hidden('cycle', false) !!}--}}
                        <label class="checkbox-inline">
                            {{--{!! Form::hidden('cycle', false) !!}--}}

                            {!! Form::checkbox('specialite[]', $specialite->id,$ecue->specialites->find($specialite->id),['id' => $specialite->title]) !!}
                            {!! Form::label($specialite->title,$specialite->title. ' - ' .$specialite->slug )!!}

                        </label>

                    </label>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-md-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('ecues.index') !!}" class="btn btn-default">Cancel</a>
</div>

