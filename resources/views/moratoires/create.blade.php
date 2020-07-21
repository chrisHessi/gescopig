@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>

    <section class="content-header">
        <h1>
            Creer un echeancier particulier pour {{ $contrat->apprenant->nom.' '.$contrat->apprenant->prenom }}
        </h1>
    </section>

    <div class="content">
        <div class="box box-primary">
            {{ Form::open(['route' => ['moratoires.store', $contrat->id] ,'id'=>'form']) }}
            <div class="box-body">
                <div class="row" id="moratoire1">
                    <div class="form-group col-xs-4">
                        {!! Form::label('montant1', 'Montant', ['class' => 'label1']) !!}
                        {!! Form::number('montant1', null, ['class' => 'form-control input1']) !!}
                    </div>

                    <div class="form-group col-xs-4">
                        {!! Form::label('date1', 'Date d\'echeance', ['class' => 'label2']) !!}
                        {!! Form::date('date1', null, ['class' => 'form-control input2']) !!}
                    </div>
                    <div class="col-xs-4">
                        <h2 class="text-center">Tranche1</h2>
                    </div>
                </div>
                <div class="button-container">
                    <a class="btn btn-primary" id="ajouter">
                        Ajouter ligne
                    </a>
                </div>
            </div>
            <div class="box-footer">
                <h4 class="pull-right" style="padding: 0px">
                    {{Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'save'])}}
                    <a href="{!! route('moratoires.index') !!}" class="btn btn-default">Cancel</a>
                </h4>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            var elem = $('#moratoire1').clone();
            var form = $('#form')
            var i = 1;
            $('#ajouter').click(function(e){
                e.preventDefault();
                var clone = elem;
                ++i;
                clone.attr('id','moratoire' + i);
                clone.find('.label1').attr('for', 'montant'+i).val('');
                clone.find('.input1').attr('name', 'montant'+i).val('');
                clone.find('.label2').attr('for', 'date'+i).val('');
                clone.find('.input2').attr('name', 'date'+i).val('');
                clone.find('h2').html('Tranche'+i)

                clone.insertBefore('.button-container')
                elem = clone.clone()
            })

            $('#save').click(function(e){
                e.preventDefault();
                var input = '<input type="hidden" value="'+i+'" name="number"/>';
                $('.box-body').append(input);
                form.submit();
            })
        })
    </script>
@endsection