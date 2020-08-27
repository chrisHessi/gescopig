@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Contrat de {{ $contrat->enseignant->nom }}
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div>
                    {!! Form::model($contrat, ['route' => ['contratEnseignants.update', $contrat->id], 'method' => 'patch']) !!}

                    <div class="form-group col-md-6">
                        {!! Form::label('mh_licence', 'Montant horaire Licence :') !!}
                        {!! Form::text('mh_licence', $contrat->mh_licence, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::label('mh_master', 'Montant horaire Master :') !!}
                        {!! Form::text('mh_master', $contrat->mh_master, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="box-footer text-right">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{!! route('contratEnseignants.index') !!}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection