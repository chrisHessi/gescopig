@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Semestres</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('academicCalendars.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table table-responsive" id="semestres-table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Suffix</th>
                        <th>Cycle</th>
                        <th>date Debut</th>
                        <th>date Fin</th>
                        <th colspan="3">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($calendars as $calendar)
                        <tr>
                            <td>{!! $calendar->semestre->title !!}</td>
                            <td>{!! $calendar->semestre->suffixe !!}</td>
                            <td>{!! $calendar->semestre->cycle->slug !!}</td>
                            <td>{!! isset($calendar->dateDebutPrevue) ? $calendar->dateDebutPrevue->format('d-m-y'): 'undefined' !!}</td>
                            <td>{!! isset($calendar->dateFinPrevue) ? $calendar->dateFinPrevue->format('d-m-y'): 'undefined' !!}</td>
                            <td>

                                {!! Form::open(['route' => ['semestres.destroy', $calendar->id], 'method' => 'delete']) !!}

                                <div class='btn-group'>
                                    {{--                    <a href="{!! route('semestres.show', [$semestre->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                                    @can('edit semestres')
                                        <a href="{!! route('academicCalendars.edit', [$calendar->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                    @endcan
                                    @can('delete semestres')
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