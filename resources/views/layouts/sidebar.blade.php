    <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{(auth()->user()->role == 'admin') ? url('adminlte/img/avatar04.png') : url('adminlte/img/default-50x50.gif')  }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{!! Auth::user()->name !!}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        {{--<!-- search form (Optional) -->--}}
        {{--<form action="#" method="get" class="sidebar-form">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="q" class="form-control" placeholder="Search...">--}}
          {{--<span class="input-group-btn">--}}
              {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
              {{--</button>--}}
            {{--</span>--}}
            {{--</div>--}}
        {{--</form>--}}
        {{--<!-- /.search form -->--}}

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            {{--<li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>--}}
            {{--<li><a href="{{ route('generate-pdf') }}"><i class="fa fa-link"></i> <span>generer un pdf</span></a></li>--}}

            @can('print diplomes')
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Diplomation</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        @can('print diplomes')
                            <li><a href="{!! url('scolarites/attestations/search/1') !!}">Attestations</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('read notes')
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Notes</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        @can('create notes')
                            <li><a href="{!! url('notes/search/1') !!}">Enregistrer Notes</a></li>
                        @endcan
                        @can('create deliberation')
                            <li><a href="{!! url('notes/search/3') !!}">Enregistrer les notes de deliberation</a></li>
                        @endcan
                        @can('create deliberation')
                            <li><a href="{!! url('notes/search/4') !!}">Liste des etudiants en 2e session</a></li>
                        @endcan
                        @can('print notes')
                                <li><a href="{!! url('notes/search/6') !!}">Imprimer pv cc</a></li>
                                <li><a href="{!! url('notes/search/7/session1') !!}">Imprimer relevé int. S1</a></li>
                                <li><a href="{!! url('notes/search/7/session2') !!}">Imprimer relevé int. S2</a></li>
                                <li><a href="{!! url('notes/search/5/session1') !!}">Imprimer pv session 1</a></li>
                                <li><a href="{!! url('notes/search/5/session2') !!}">Imprimer pv session 2</a></li>
                                <li><a href="{!! url('notes/search/2') !!}">Imprimer Relevé de notes</a></li>
                        @endcan

                    </ul>
                </li>
            @endcan

            @can('read scolarites')
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Scolarites</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        @can('create apprenants')
                            <li><a href="{!! url('apprenants/create') !!}">Enregistrer Nouvel apprenant</a></li>
                        @endcan
                        @can('save versements')
                            <li><a href="{!! route('versements.listeApprenants') !!}">Versement des frais de scolarité</a></li>
                        @endcan
                        @can('read scolarites')
                            <li><a href="{!! route('scolarites.index') !!}">Imprimer documents administratifs</a></li>
                        @endcan
                        @can('print documents')
                            <li><a href="{!! route('scolarites.old') !!}">Imprimer certificats de scolarités <br>anciens etudiants</a></li>
                        @endcan
                        @can('export documents')
                            <li><a href="{!! route('scolarites.inscrits') !!}">Exporter liste des apprenants <br>inscrits</a></li>
                        @endcan
                        @can('read echeanciers')
                            <li><a href="{!! route('echeanciers.index') !!}">Gestion des Echeanciers</a></li>
                        @endcan
                        @can('read moratoires')
                            <li><a href="{!! route('moratoires.index') !!}">Gestion des Moratoires</a></li>
                        @endcan
                        @can('read corkages')
                            <li><a href="{!! route('corkages.index') !!}">Gestion des autres Frais</a></li>
                        @endcan

                    </ul>
                </li>
            @endcan

            @can('read resultats')
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Resultats Nom.</span>
                        <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        @can('create resultats')
                            <li><a href="{!! url('resultatNominatifs/search/1') !!}">Enregistrer les resultats</a></li>
                        @endcan
                        @can('edit resultats')
                            <li><a href="{!! url('resultatNominatifs/search/2') !!}">Afficher les resultats</a></li>
                        @endcan
                    </ul>
                </li>
            @endcan

{{--            <li class="treeview">--}}
{{--                <a href="#"><i class="fa fa-link"></i> <span>Users</span>--}}
{{--            <span class="pull-right-container">--}}
{{--                <i class="fa fa-angle-left pull-right"></i>--}}
{{--            </span>--}}
{{--                </a>--}}
{{--                <ul class="treeview-menu">--}}
{{--                    @can('create absences')--}}
{{--                    <li><a href="{!! url('absences/search/1') !!}">Enregistrer Absences</a></li>--}}
{{--                    @endcan--}}
{{--                    <li><a href="{!! url('absences/search/2') !!}">Etat des Absences</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}

            @can('read absences')
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Absences</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @can('create absences')
                    <li><a href="{!! url('absences/search/1') !!}">Enregistrer Absences</a></li>
                    @endcan
                    <li><a href="{!! url('absences/search/2') !!}">Etat des Absences</a></li>
                </ul>
            </li>
            @endcan

            @can('read enseignements')
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Enseignements</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @can('create enseignements')
                    <li><a href="{!! url('enseignements/search/1') !!}"><i class="fa fa-circle-o"> Creer un enseignement</i></a></li>
                    @endcan
                    <li><a href="{!! url('enseignements/search/2') !!}"><i class="fa fa-circle-o"> Evolution des enseignements</i></a></li>
                    <li><a href="{!! url('enseignements') !!}"><i class="fa fa-circle-o"> liste de tous les enseignements</i></a></li>
                    @can('read rapport')
                    <li><a href="{{ url('enseignements/rapport/1') }}"><i class="fa fa-print"></i> <span>Rapport d'évolution <br> des enseignements 1</span></a></li>
                    <li><a href="{{ url('enseignements/rapport/2') }}"><i class="fa fa-print"></i> <span>Rapport d'évolution <br> des enseignements 2</span></a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('read enseignants')
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Enseignants</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('enseignants/create') !!}">Enregistrer un nouvel enseignant</a></li>
                    <li><a href="{{ route('contratEnseignants.create') }}">Autoriser enseignant</a></li>
                    <li><a href="{{ route('contratEnseignants.index') }}">Enseignants Autorisés </a></li>
                    <li><a href="{!! url('enseignants') !!}">Tout les Enseignants</a></li>
                </ul>
            </li>
            @endcan

            @can ('read apprenants')
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Apprenants</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @can('edit apprenants')
                    <li><a href="{!! url('apprenants/create') !!}">Enregistrer un nouvel apprenant</a></li>
                    @endcan
                    @can('read apprenants')
                    <li><a href="{!! url('apprenants') !!}">Liste de Apprenants</a></li>
                        <li><a href="{{ url('contrats/all') }}">résumé apprenants a imprimer</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('read contrats')
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Contrats</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @can('create contrats')
                    <li><a href="{!! url('contrats/create') !!}">Enregistrer un nouveau Contrat</a></li>
                    @endcan
                    @can('read contrats')
                    <li><a href="{!! url('contrats') !!}">Liste des Contrats</a></li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('read ues')
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Unités d'enseignements</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{!! url('ues/create') !!}">Enregistrer une nouvelle UE</a></li>
                        <li><a href="{!! url('ues') !!}">Liste des UE</a></li>
                    </ul>
                </li>
            @endcan

            @can('read catUes')
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Catégories UE</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{!! url('catUes/create') !!}">Enregistrer une nouvelle Cat. UE</a></li>
                        <li><a href="{!! url('catUes') !!}">Liste des Cat. UE</a></li>
                    </ul>
                </li>
            @endcan

            @can('read ecues')
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Ecues</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('ecues/create') !!}">Enregistrer un nouvel Ecue</a></li>
                    <li><a href="{!! url('ecues') !!}">Liste des ecues</a></li>
                </ul>
            </li>
            @endcan

            @can('read specialites')
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Specialités</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        @can('create specialites')
                            <li><a href="{!! url('specialites/create') !!}">Enregistrer une nouvelle Specialité</a></li>
                        @endcan
                        <li><a href="{!! url('specialites') !!}">Liste des Specialités</a></li>
                    </ul>
                </li>
            @endcan

            @can('read cycles')
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Cycles</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('cycles/create') !!}">Enregistrer cycles</a></li>
                    <li><a href="{!! url('cycles') !!}">Tout les cycles</a></li>
                </ul>
            </li>
            @endcan

            @can('read semestres')
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Semestres</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! url('semestres/create') !!}">Enregistrer Semestre</a></li>
                    <li><a href="{!! url('semestres') !!}">Liste de semestres</a></li>
                    <li><a href="{!! url('academicCalendars') !!}">Voir le calendrier academique</a></li>
                    <li><a href="{!! url('academicCalendars/create') !!}">enregistrer le calendrier <br>de l'année académique en cours</a></li>

                </ul>
            </li>
            @endcan
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>