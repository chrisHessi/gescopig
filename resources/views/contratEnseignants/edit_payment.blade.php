@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>

    @include('adminlte-templates::common.errors')

    <div class="clearfix"></div>

    <section class="content-header">
        <h1>
{{--            Paiement des honoraires de : {{ $contrat->enseignant->name. ' - ' .$contrat->academic_year->debut. '/' .$contrat->academic_year->fin }}--}}
        </h1>
    </section>
    <div class="content">
        {{ Form::model($payment,['route' =>['contratEnseignants.update_payment', $payment->id], 'method' => 'patch' ]) }}
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group col-xs-3 doc">
                    {!! Form::label('montant', 'Montant versement:') !!}
                    {!! Form::text('montant', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-xs-3 doc">
                    {!! Form::label('date', 'Date de paiement:') !!}
                    {!! Form::date('date', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-xs-3 doc">
                    {!! Form::label('tranche', 'tranche:') !!}
                    {!! Form::select('tranche', ['4/5'=>'4/5', '1/5' => '1/5', '100%' => 'Totalité'], null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-xs-3 doc">
                    {!! Form::label('numero_piece', 'Numero piece de paiement:') !!}
                    {!! Form::text('numero_piece', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-xs-3 doc">
                    {!! Form::label('observation', 'Observations:') !!}
                    {!! Form::text('observation', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="box-footer">
                <div class="form-group col-sm-12 text-right">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('contratEnseignants.index') !!}" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>
        {{Form::close()}}
    </div>

@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('css/build.css') }}">
@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <script type="text/javascript">

    </script>

@endsection