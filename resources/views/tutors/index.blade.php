@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Parents de {{ $tutors->first()->apprenant->nom. ' ' .$tutors->first()->apprenant->prenom }}</h1>
        <h1 class="pull-right">
            @can('create tutors')
                <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('tutors.create', [$tutors->first()->apprenant->id]) !!}">Ajouter un parent</a>
            @endcan
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive" id="specialites-table">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Relation</th>
                        <th>Téléphone</th>
                        <th>Profession</th>
                        <th colspan="3">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tutors as $tutor)
                        <tr>
                            <td>{!! $tutor->name !!}</td>
                            <td>{!! $tutor->type !!}</td>
                            <td>{!! $tutor->tel_mobile !!}</td>
                            <td>{!! $tutor->profession !!}</td>
                            <td>
                                {!! Form::open(['route' => ['tutors.destroy', $tutor->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    {{--                    <a href="{!! route('specialites.show', [$specialite->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                                    @can('edit tutors')
                                        <a href="{!! route('tutors.edit', [$tutor->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                    @endcan
                                    @can('delete tutors')
                                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    @endcan
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection