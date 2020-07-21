@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Enseignement - {{ $enseignement->ecue->title }}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($enseignement, ['route' => ['enseignements.updateMh', $enseignement->id], 'method' => 'patch']) !!}

                    {{--@include('enseignements.fields')--}}
                    {{--<div class="form-group col-sm-6 ">--}}
                        {{--{!! Form::label('dateDebutEff', 'Datedebuteff:') !!}--}}
                        {{--{!! Form::date('dateDebutEff', null, ['class' => 'form-control', 'id' => 'dateDebut']) !!}--}}
                    {{--</div>--}}
                    {{--<div class="form-group col-sm-6 ">--}}
                        {{--{!! Form::label('dateFinEff', 'Date fin eff:') !!}--}}
                        {{--{!! Form::date('dateFinEff', null, ['class' => 'form-control ', 'id' => 'dateFin']) !!}--}}
                    {{--</div>--}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('mhEff', 'Masse horaire Effectuée:') !!}
                        {{--{!! Form::number('mhEff', null, ['class' => 'form-control']) !!}--}}
                        <input class="form-control" name="mhEff" type="number" id="mhEff">

                    </div>
                    <div class="col-sm-2 form-group">
                        {!! Form::label('progression', 'Progression:') !!}
                        {!! Form::checkbox('progression', 1, isset($enseignement) ? $enseignement->progression : null, ['class' => 'checkbox']) !!}
                    </div>

                    <div class="col-sm-2 form-group">
                        {!! Form::label('communication', 'F.Comm.') !!}
                        {!! Form::checkbox('communication', 1, isset($enseignement) ? $enseignement->communication : null, ['class' => 'checkbox']) !!}
                    </div>

                    <div class="col-sm-2 form-group">
                        {!! Form::label('cc', 'Contrôle Continu') !!}
                        {!! Form::checkbox('cc', 1, isset($enseignement) ? $enseignement->cc : null, ['class' => 'checkbox']) !!}
                    </div>

                    <div class="form-group col-sm-12">
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        <a href="{!! url()->previous() !!}" class="btn btn-default">Cancel</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(function(){
            $('#dateDebut').val = null;
            $('#dateFin').val = null;
        });
    </script>

@endsection