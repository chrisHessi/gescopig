<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

<div class="panel panel-default ">
    <div class="panel-heading">Niveau Academique</div>
    <div class="panel-body">
        <ul class="form-group list-group">
            @foreach($cycle as $cycles)
                <li class="list-group-item">
                    <label class="checkbox-inline">
                        {{--{!! Form::hidden('cycle', false) !!}--}}
                        <label class="checkbox-inline">
                            {{--{!! Form::hidden('cycle', false) !!}--}}
                            {!! Form::checkbox('cycle[]', $cycles->id,isset($cycleSpecialite) ? in_array($cycles->slug, $cycleSpecialite) : null,['id' => $cycles->label.'_'.$cycles->niveau]) !!}
                            {!! Form::label($cycles->label.'_'.$cycles->niveau,$cycles->label.' '.$cycles->niveau)!!}

                        </label>

                    </label>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('specialites.index') !!}" class="btn btn-default">Cancel</a>
</div>
