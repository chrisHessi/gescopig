@extends('layouts.app')

@section('content')

    <div class="content">
        <h1>
            {!! $specialite->slug. ''. $semestre->cycle->niveau. ' - '. $semestre->title !!}
        </h1>

        <div class="clear-fix"></div>
        @include('flash::message')
        <div class="clear-fix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <table id="notes-table" class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th>Ecue</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($enseignements as $enseignement)
                        @if(isset($enseignement))
                            <tr>
                                <td>{{ $enseignement->ecue->title }}</td>
                                <td>
                                    <div class="pull-right">
                                        <a href="{{ route('notes.show', ['cc',$enseignement->id]) }}" class="btn btn-primary btn-sm">CC</a>
                                        <a href="{{ route('notes.show', ['session1',$enseignement->id]) }}" class="btn btn-info btn-sm">1ere Session</a>
                                        <a href="{{ route('notes.show', ['session2',$enseignement->id]) }}" class="btn btn-warning btn-sm">2e Session</a>
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