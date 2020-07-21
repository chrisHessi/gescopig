@extends('layouts.app')
@section('content')

    <section class="content-header">
        <h1 class="pull-left">Liste des etudiants</h1>
        {{--<h1 class="pull-right">--}}
            {{--<a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('ecues.create') !!}">Add New</a>--}}
        {{--</h1>--}}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <table class="table-responsive table-bordered">
                    <thead>
                        <tr>
                            <th>Nom et prenom</th>
                            <th>Specialite</th>
                            <th>Total versements</th>
                            <th>Montant Scolarite</th>
                            <th>Dette</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($scolarites as $scolarite)
                        <tr>
                            <td>{!! $scolarite->apprenant->nom. ' ' .$scolarite->apprenant->prenom !!}</td>
                            <td>{!! $scolarite->specialite->slug. $scolarite->cycle->niveau !!}</td>
                            <td>{!! $scolarite->versements->sum('montant') !!}</td>
                            <td>{!! $scolarite->cycle->echeanciers->where('academic_year_id', \App\Helpers\AcademicYear::getCurrentAcademicYear())->sum('montant') !!}</td>
                            <td>{!! $scolarite->dette !!}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('scolarites.versement', [$scolarite->id])}}" class="btn btn-primary">Versements</a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>

@endsection