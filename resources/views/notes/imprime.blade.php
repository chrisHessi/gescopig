@extends('layouts.app')

@section('content')

    <div class="content">
        <h1>
            Relevé de notes {!! $contrats->first->specialite->slug. ''. $semestre->cycle->niveau. ' - '. $semestre->title !!}
        </h1>

        <div class="clear-fix"></div>
        @include('flash::message')
        <div class="clear-fix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th>Nom et Prenom</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contrats as $contrat)
                            @if(isset($contrat))
                                <tr>
                                    <td>{{ $contrat->apprenant->nom .' '. $contrat->apprenant->prenom}}</td>
                                    <td>
                                        <div class="btn-group pull-right">
                                            <a href="{{ route('notes.releve',['session1',$contrat->id, $semestre->id]) }}" class="btn btn-primary btn-sm">Session 1</a>
                                            @if(!empty($contrat->semestre_infos) && $contrat->semestre_infos->where('semestre_id', $semestre->id)->first() != null)
                                                @if($contrat->semestre_infos->where('semestre_id', $semestre->id)->first()->session == 'session2')
                                                    <a href="{{ route('notes.releve',['session2',$contrat->id, $semestre->id]) }}" class="btn btn-primary btn-sm">Session 2</a>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection