@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>

    @include('adminlte-templates::common.errors')

    <div class="clearfix"></div>

    <section class="content-header">
        <h1>
            Versements des scolarites {{ $versement->contrat->apprenant->nom. ' ' .$versement->contrat->apprenant->prenom }}
        </h1>
    </section>
    <div class="content">
        {{ Form::model($versement,['route' => ['versements.update', $versement->id], 'method' => 'patch']) }}
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group col-sm-4">
                    {!! Form::label('montant', 'Montant:') !!}
                    {!! Form::number('montant', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('motif', 'Motif:') !!}
                    {!! Form::text('motif', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('versements.listeApprenants') !!}" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection