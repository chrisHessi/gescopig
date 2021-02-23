@extends('layouts.app')

@section('content')
    <div class="clearfix"></div>

    @include('adminlte-templates::common.errors')

    <div class="clearfix"></div>

    <section class="content-header">
        <h1>
            Paiement des honoraires de : {{ $contrat->enseignant->name. ' - ' .$contrat->academic_year->debut. '/' .$contrat->academic_year->fin }}
        </h1>
    </section>
    <div class="content">
        {{Form::open([route('contratEnseignants.save', [$teachable->id, 'type='. $type])])}}
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
                    {!! Form::text('tranche', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-xs-3 doc">
                    {!! Form::label('numero_piece', 'Numero piece de paiement:') !!}
                    {!! Form::text('numero_piece', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group col-xs-3 doc">
                    {!! Form::label('observation', 'Observations:') !!}
                    {!! Form::text('observation', null, ['class' => 'form-control']) !!}
                </div>
                {{ Form::hidden('type', $type) }}
            </div>
            <div class="box-footer">
                <div class="form-group col-sm-12 text-right">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    <a href="{!! route('contratEnseignants.index') !!}" class="btn btn-default">Cancel</a>
                </div>
            </div>
        </div>

        <div class="clear-fix"></div>

        <div class="box box-primary">
            {{--<div class="box-header">--}}
                {{--<div class="form-group col-sm-12 text-right">--}}
                    {{--{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}--}}
                    {{--<a href="{!! route('contratEnseignants.index') !!}" class="btn btn-default">Cancel</a>--}}
                    {{--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info">--}}
                        {{--Voir Le detail des enseignements--}}
                    {{--</button>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="box-body">--}}
                {{--<table class="table table bordered">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th></th>--}}
                        {{--<th>Ecue</th>                     --}}
                        {{--<th>Semestre</th>--}}
                        {{--<th>Montant horaire</th>--}}
                        {{--<th>Specialites</th> --}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                        {{--<tr>--}}
                            {{--<td>{{ ($type) ? $teachable->enseignements->first()->ecue->title : $teachable->ecue->title }}</td>--}}
                            {{--<td>{{ ($type) ? $teachable->enseignements->first()->ecue->semestre->title. ' ' .$teachable->enseignements->first()->ecue->semestre->niveau : $teachable->ecue->semestre->title. ' ' .$teachable->ecue->semestre->niveau }}</td>--}}
                            {{--<td>{{ (($type ? $teachable->enseignements->first()->ecue->semestre->cycle->label : $teachable->ecue->semestre->cycle->label) == 'Licence') ? $contrat->mh_licence : $contrat->mh_master }}</td>--}}
                            {{--<td>--}}
                                {{--@if($type)--}}
                                    {{--@foreach($teachable->enseignements as $enseignement)--}}
                                        {{--{{ $enseignement->specialite->slug .' '. $enseignement->ecue->semestre->cycle->niveau .' ' }}--}}
                                    {{--@endforeach--}}
                                {{--@else--}}
                                    {{--{{ $teachable->specialite->slug .' '. $teachable->ecue->semestre->cycle->niveau }}--}}
                                {{--@endif--}}
                            {{--</td>--}}
                            {{----}}
                        {{--</tr>--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
            {{--<div class="box-header">--}}
                {{--<div class="form-group col-sm-12 text-right">--}}
                    {{--{!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}--}}
                    {{--<a href="{!! route('contratEnseignants.index') !!}" class="btn btn-default">Cancel</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        {{Form::close()}}
    </div>
    {{--<div class="modal modal-success fade in" id="modal-info" style="display: none; padding-right: 17px;" aria-hidden="true">--}}
        {{--<div class="modal-dialog modal-lg">--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                        {{--<span aria-hidden="true">×</span></button>--}}
                    {{--<h4 class="modal-title">Info Modal</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<div class="nav-tabs-custom">--}}
                        {{--<ul class="nav nav-tabs">--}}
                            {{--<!-- @array_value pour selectionner le premier ecue et activer son onglet par defaut -->--}}
                            {{--@foreach($ecues as $ecue)--}}
                                {{--<li class="{{ (array_values($ecues)[0]->id == $ecue->id) ? 'active' : ''  }}"><a class="text-light-blue" href="#tab_{{ $ecue->id }}" data-toggle="tab">{{ $ecue->title }}</a></li>--}}
                            {{--@endforeach--}}
                        {{--</ul>--}}
                        {{--<div class="tab-content">--}}
                            {{--@foreach($ecues as $ecue)--}}

                                {{--<div class="tab-pane {{ (array_values($ecues)[0]->id == $ecue->id) ? 'active' : ''  }}" id="{{ 'tab_'.$ecue->id }}">--}}
                                    {{--<table class="table table-striped table-hover table-bordered text-black" id = "table-{{$ecue->id}}">--}}
                                        {{--<thead>--}}
                                        {{--<tr>--}}
                                            {{--<th>Specialités</th>--}}
                                            {{--<th>Masse horaire Prevue</th>--}}
                                            {{--<th>MH realisee</th>--}}
                                            {{--<th>MT</th>--}}
                                            {{--<th>5,50%</th>--}}
                                            {{--<th>NAP</th>--}}
                                            {{--<th>4/5</th>--}}
                                            {{--<th>1/5</th>--}}
                                        {{--</tr>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}
                                        {{--@foreach($ecue->enseignements->where('contrat_enseignant_id', $contrat->id) as $enseignement)--}}
                                            {{--<tr>--}}
                                                {{--<td>{{ $enseignement->specialite->slug.' '. $enseignement->ecue->semestre->cycle->niveau }}</td>--}}
                                                {{--<td>{{ $enseignement->mhTotal }}</td>--}}
                                                {{--<td>{{ $enseignement->mhEff }}</td>--}}
                                                {{--<td id="mt-{{ $enseignement->id }}">{{ $mt = (($ecue->semestre->cycle->label == 'Licence') ? $contrat->mh_licence : $contrat->mh_master) * (($enseignement->mhTotal > $enseignement->mhEff) ? $enseignement->mhEff : $enseignement->mhTotal)}}</td>--}}
                                                {{--<td id="ret-{{ $enseignement->id }}">{{ $ret = $mt*5.50/100 }}</td>--}}
                                                {{--<td id="nap-{{ $enseignement->id }}">{{ $nap = $mt - $ret }}</td>--}}
                                                {{--<td id="qt-{{ $enseignement->id }}">{{ $nap*4/5 }}</td>--}}
                                                {{--<td id="t-{{ $enseignement->id }}">{{ $nap*1/5 }}</td>--}}
                                            {{--</tr>--}}
                                        {{--@endforeach--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}
                        {{--@endforeach--}}
                        {{--</div>--}}
                        {{--<!-- /.tab-content -->--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>--}}
                    {{--<button type="button" class="btn btn-outline">Save changes</button>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- /.modal-content -->--}}
        {{--</div>--}}
        {{--<!-- /.modal-dialog -->--}}
    {{--</div>--}}


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