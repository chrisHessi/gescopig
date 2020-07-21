@extends('layouts.app')

@section('content')

    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>

    <section class="content-header">
        {{ $contrat->specialite->slug. ' '. $contrat->cycle->niveau .' - '. $contrat->apprenant->nom. ' ' .$contrat->apprenant->prenom }}
    </section>

    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                {!! Form::open(['url' => 'notes/deliberation/'.$sem.'/'.$type.'/'.$contrat->id]) !!}
                <table class="table table-responsive table-stripped">
                    <thead>
                    <tr>
                        <th>Ecue</th>
                        <th>Note</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($enseignements as $enseignement)

                        <tr>
                            <td>{{ $enseignement->ecue->title }}</td>
                            @if($type == 'session1')
                                <td>
                                    {{ Form::number($enseignement->id, $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del1, ['class' => 'form-control', 'step' => 'any' ]) }}
                                </td>
                            @elseif($type == 'session2')
                                <td>
                                    {{ Form::number($enseignement->id, $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del2, ['class' => 'form-control', ($contrat->notes->where('enseignement_id', $enseignement->id)->first()->del2 >= 10)? 'readonly' : '', 'step' => 'any']) }}
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer text-right m">
                {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
                <a href="{{ route('notes.deliberation', [$enseignement->ecue->semestre_id, $contrat->specialite_id]) }}" class="btn btn-default">
                    Back
                </a>
            </div>
            {!! Form::close() !!}

        </div>
    </div>

@endsection