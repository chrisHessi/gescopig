@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="col-md-4">
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">

                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">Gestion des Scolarités</h3>
                    {{--<h5 class="widget-user-desc">Lead Developer</h5>--}}
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        @can('create apprenants')
                            <li><a href="{!! url('apprenants/create') !!}">Enregistrer Nouvel apprenant</a></li>
                        @endcan
                        @can('save versements')
                            <li><a href="{!! route('versements.listeApprenants') !!}">Versement des frais de scolarité</a></li>
                        @endcan
                        @can('print documents')
                            <li><a href="{!! route('scolarites.index') !!}">Imprimer documents administratifs</a></li>
                        @endcan
                        @can('read echeanciers')
                            <li><a href="{!! route('echeanciers.index') !!}">Gestion des Echeanciers</a></li>
                        @endcan
                        @can('read moratoires')
                            <li><a href="{!! route('moratoires.index') !!}">Gestion des Moratoires</a></li>
                        @endcan
{{--                        <li><a href="{!! route('echeanciers.index') !!}">Gestion des Echeanciers</a></li>--}}
{{--                        <li><a href="#"><i class="fa fa-abacus text-red"></i> Verifier la regularité des apprenants</a></li>--}}
{{--                        <li><a href="#"><i class="fa fa-abacus text-red"></i> Imprimer des contrats</a></li>--}}
{{--                        <li><a href="#"><i class="fa fa-abacus text-red"></i> Imprimer des contrats</a></li>--}}
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
