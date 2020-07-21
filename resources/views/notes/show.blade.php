@extends('layouts.app')

@section('content')

    <div class="clearfix"></div>

    @include('flash::message')

    <div class="clearfix"></div>

    <section class="content-header">
        {{ $contrats->first()->specialite->slug. ' '. $contrats->first()->cycle->niveau .' - '. $enseignement->ecue->title }}
    </section>

    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                {!! Form::open(['url' => 'notes/'.$type.'/'.$enseignement->id]) !!}
                <table class="table table-responsive table-stripped">

                    <thead>
                    <tr>
                        <th>Apprenant</th>
                        <th>Note {{ $type }}</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($contrats as $contrat)

                        <tr>
                            <td>{{ $contrat->apprenant->nom .' '. $contrat->apprenant->prenom }}</td>
                            <td>{{ Form::number($contrat->id, null, ['class' => 'form-control' , 'id' => $contrat->id, 'step' => 'any']) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer text-right m">
                {{Form::submit('Save', ['class' => 'btn btn-primary'])}}
                <a href="{{ route('notes.affiche', [$enseignement->ecue->semestre_id, $enseignement->specialite_id]) }}" class="btn btn-default">
                    Back
                </a>
            </div>
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.js"></script>

    <script>
        $(function() {
            @foreach($contrats as $contrat)
                @if($contrat->notes->where('enseignement_id', $enseignement->id)->first())
                    @if($type == 'cc')
                        $("#"+ {!! $contrat->id !!}).val({!! $contrat->notes->where('enseignement_id', $enseignement->id)->first()->cc !!})
                    @elseif($type == 'session1')
                        $("#"+ {!! $contrat->id !!}).val({!! $contrat->notes->where('enseignement_id', $enseignement->id)->first()->session1 !!})
                    @else
                        $("#"+ {!! $contrat->id !!}).val({!! $contrat->notes->where('enseignement_id', $enseignement->id)->first()->session2 !!})
                    @endif
                @endif
            @endforeach

            $('.table').DataTable({
                "pageLength": 50
            });
        })
    </script>

@endsection

@section('css')
    {{--    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">--}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/datatables.min.css"/>
@endsection