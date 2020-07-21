@extends('layouts.app')

@section('content')

    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>

    <section class="content-header">
        {{ $contrats[0]->specialite->slug. ' ' .$contrats[0]->cycle->niveau. ' - Rattrappage' }}
    </section>

    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive table-stripped" id="table">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Specialite</th>
                        <th>Matieres à rattraper</th>
                        <th>Ues Non validées</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($contrats as $contrat)
                        @if($enseignements[$contrat->id])
                            <tr>
                                <td>{!! $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom !!}</td>
                                <td>{!! $contrat->specialite->slug. ' ' .$contrat->cycle->niveau !!}</td>
                                <td>
                                    @foreach($enseignements[$contrat->id] as $enseignement)
                                        <ul>{!! $enseignement->ecue->title !!}</ul>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($contrat->ue_infos->where('mention', 'Non Validé') as $ueInfo)
                                        <ul>{!! $ueInfo->ue->title !!}</ul>
                                    @endforeach
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer text-right m">
                {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
                {{--<a href="{{ route('notes.deliberation', [$enseignement->ecue->semestre_id, $contrat->specialite_id]) }}" class="btn btn-default">--}}
                    {{--Back--}}
                {{--</a>--}}
            </div>

        </div>
    </div>

@endsection