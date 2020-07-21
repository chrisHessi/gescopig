@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>

    @include('adminlte-templates::common.errors')

    <div class="clearfix"></div>

    <section class="content-header">
        <h1>
            Autres frais de {{ $corkage->contrat->apprenant->nom. ' ' .$corkage->contrat->apprenant->prenom }}
        </h1>
    </section>
    <div class="content">
        {{ Form::model($corkage, ['route' => ['corkages.update', $corkage->id], 'method' => 'patch']) }}
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group col-sm-4">
                    {!! Form::label('title', 'Libellé:') !!}
                    {!! Form::text('title', $corkage->title, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('montant', 'Montant:') !!}
                    {!! Form::number('montant', $corkage->montant, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('reduction', 'Reduction?:') !!}
                    {!! Form::select('reduction', [0 => 'NON', 1 => 'OUI'], $corkage->reduction, ['class' => 'form-control', 'placeholder' => '---- Choisir ----']) !!}
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group col-sm-12">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('corkages.show', [$corkage->contrat->apprenant->id]) !!}" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('css/build.css') }}">
@endsection