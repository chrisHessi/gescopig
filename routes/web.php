<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();
Route::prefix('admin')->namespace('Back')->group(function(){
    Route::name('admin')->get('/', 'AdminController@index');
});
Route::prefix('')->middleware('auth')->group(function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('home', 'HomeController@index');
    Route::get('absences/updateJustif/{justification}/{absence}', ['middleware' => 'permission:edit absences','uses' => 'AbsenceController@justif'])->name('absences.updateJustif');

    Route::get('absences/updateJustif/{justification}/{absence}', ['middleware' => 'permission:edit absences','uses' => 'AbsenceController@updateJustif'])->name('absences.updateJustif');

    Route::get('absences/search/{n}', ['middleware' => 'permission:create absences|read absences|read enseignements','uses' => 'AbsenceController@search'])->name('absences.search');
    Route::get('absences/etat', 'AbsenceController@etat')->name('absences.etat');
    Route::get('absences/affiche/{semestre}/{specialite}', ['middleware' => 'permission:read absences','uses' => 'AbsenceController@affiche'] )->name('absences.affiche');
    Route::get('absences/create/{semestre}/{specialite}', ['middleware' => 'permission:create absences','uses' => 'AbsenceController@create'] )->name('absences.create');
    Route::get('absences/{apprenant}/edit/{semestre}', ['middleware' => 'permission:read absences','uses' => 'AbsenceController@edit'])->name('absences.edit');
//    Route::get('absence/afficheData, AbsenceController@afficheData')->name('absences.afficheData');
    Route::resource('absences', 'AbsenceController')->except('create','edit', 'show');

    Route::name('specialites.getData')->get('specialites/getData', 'SpecialiteController@getData');

    Route::resource('semestres', 'SemestreController');

    Route::get('contrats/all', 'ContratController@all')->name('contrats.all');
    Route::resource('contrats', 'ContratController');

    Route::resource('ecues', 'EcueController');

    Route::resource('cycles', 'CycleController');

    Route::resource('apprenants', 'ApprenantController');

    Route::resource('specialites', 'SpecialiteController');

    Route::resource('enseignants', 'EnseignantController');

    Route::get('tutors/{id}', 'TutorController@index')->name('tutors.index');
    Route::get('tutors/create/{id}', 'TutorController@create')->name('tutors.create');
    Route::post('tutors/{id}', 'TutorController@store')->name('tutors.store');
    Route::resource('tutors', 'TutorController')->only('edit', 'update', 'destroy');

    Route::resource('enseignements', 'EnseignementController')->except('create');
    Route::get('enseignements/affiche/{semestre}/{specialite}', 'EnseignementController@affiche')->name('enseignements.affiche');
    Route::get('enseignements/search/{n}', 'EnseignementController@search')->name('enseignements.search');
    Route::patch('enseignements/{specialites}/updateMh', 'EnseignementController@updateMh')->name('enseignements.updateMh');
    Route::get('enseignements/{specialite}/editMh', 'EnseignementController@editMh')->name('enseignements.editMh');
    Route::get('enseignements/create/{semestre}/{specialite}', 'EnseignementController@create')->name('enseignements.create');
    Route::get('enseignements/rapport/{n}', 'EnseignementController@rapport')->name('rapport');
//    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('users', 'UserController');

    Route::get('absences/test', 'AbsenceController@test');

    Route::resource('catUes', 'CatUeController')->except('show');
    Route::resource('ues', 'UeController')->except('show');

    Route::get('notes/search/{n}/{type?}', 'NoteController@search')->name('notes.search');
    Route::get('notes/affiche/{semestre}/{specialite}', 'NoteController@affiche')->name('notes.affiche');
    Route::get('notes/imprime/{semestre}/{specialite}', 'NoteController@imprime')->name('notes.imprime');
    Route::get('notes/releve/{session}/{contrat}/{semestre}', 'NoteController@releve')->name('notes.releve');
    Route::get('notes/pv/{specialite}/{semestre}/{type?}', 'NoteController@pv')->name('notes.pv');
    Route::get('notes/pvcc/{specialite}/{semestre}', 'NoteController@pvcc')->name('notes.pvcc');
    Route::get('notes/rn_intermediaire/{specialite}/{semestre}/{type?}', 'NoteController@rn_intermediaire')->name('notes.rn_intermediaire');
    Route::resource('notes', 'NoteController')->except('store', 'show');

    Route::get('notes/show/{type}/{id}', 'NoteController@show')->name('notes.show');
    Route::post('notes/{type}/{enseignement}', 'NoteController@store')->name('notes.store');
    Route::post('notes/deliberation/{semestre}/{type}/{contrat}', 'NoteController@saveDeliberation')->name('notes.saveDeliberation');
    Route::get('notes/deliberation/{semestre}/{specialite}', 'NoteController@deliberation')->name('notes.deliberation');
    Route::get('notes/notesDeliberation/{type}/{contrat}/{semestre}', 'NoteController@noteDeliberation')->name('notes.noteDeliberation');

    Route::get('notes/getNoteContrat/{contrat}/{enseignement}', 'NoteController@getNoteContrat')->name('notes.getNoteContrat');

    Route::get('notes/rattrapage/{semestre}/{specialite}', 'NoteController@rattrapage')->name('notes.rattrapage');

    Route::get('versements/listeApprenants', 'VersementController@listeApprenants')->name('versements.listeApprenants');
    Route::get('versements/details/{id}', 'VersementController@details')->name('versements.details');
    Route::post('versements/{id}', 'VersementController@store')->name('versements.store');
    Route::get('versements/show/{id}', 'VersementController@show')->name('versements.show');
    Route::get('versements/{id}/edit', 'VersementController@edit')->name('versements.edit');
    Route::patch('versements/{id}/update', 'VersementController@update')->name('versements.update');
    Route::delete('versements/destroy/{id}', 'VersementController@destroy')->name('versements.destroy');


    Route::resource('echeanciers', 'EcheancierController');

    Route::get('moratoires/create/{id}', 'MoratoireController@create')->name('moratoires.create');
    Route::post('moratoires/{id}', 'MoratoireController@store')->name('moratoires.store');
    Route::get('moratoires', 'MoratoireController@index')->name('moratoires.index');
    Route::get('moratoires/{id}/edit', 'MoratoireController@edit')->name('moratoires.edit');
    Route::patch('moratoires/{id}', 'MoratoireController@update')->name('moratoires.update');

    Route::get('scolarites', 'ScolariteController@index')->name('scolarites.index');
    Route::get('scolarites/old', 'ScolariteController@old')->name('scolarites.old');
    Route::get('scolarites/inscrits', 'ScolariteController@inscrits')->name('scolarites.inscrits');

    Route::get('rnr', function(){
        return view('notes.rnr_imprime');
    });
    Route::get('certificat/{type}', function($type){
        return view('documents.certificat')->with(['type'=>$type]);
    });
    Route::get('scolarites/contrats/{id}', 'ScolariteController@contrats')->name('scolarites.contrat');
    Route::get('scolarites/attestation/{contrat}/{type}', 'ScolariteController@attestation')->name('scolarites.attestation');
    Route::get('scolarites/certificat/{contrat}/{type}', 'ScolariteController@certificat')->name('scolarites.certificat');
    Route::get('scolarites/autorisation/{id}', 'ScolariteController@autorisation')->name('scolarites.autorisation');
    Route::get('scolarites/suspension/{id}', 'ScolariteController@suspension')->name('scolarites.suspension');
    Route::get('scolarites/printSuspension', 'ScolariteController@printSuspension')->name('scolarites.printSuspension');
    Route::post('scolarites/printSuspension', 'ScolariteController@suspensions')->name('scolarites.suspensions');


    Route::get('resultatNominatifs/search/{n}', 'ResultatNominatifController@search')->name('resultatNominatifs.search');
    Route::get('resultatNominatifs/create/{specialite}/{cycle}', 'ResultatNominatifController@create')->name('resultatNominatifs.create');
    Route::post('resultatNominatifs', 'ResultatNominatifController@store')->name('resultatNominatifs.store');

//    Route::post('notes/{enseignement}/{contrat}', 'NoteController@store')->name('notes.store');

    Route::resource('academicYears', 'AcademicYearController');

    Route::resource('contratEnseignants', 'ContratEnseignantController')->except('show');
    Route::get('contratEnseignants/versements/{id}', 'ContratEnseignantController@versements')->name('contratEnseignants.versements');
    Route::post('contratEnseignants/versements/{id}', 'ContratEnseignantController@save')->name('contratEnseignants.save');
    Route::get('contratEnseignants/rapport/{id}', 'ContratEnseignantController@rapport')->name('contratEnseignants.rapport');
    Route::get('contratEnseignants/contrats/{id}', 'ContratEnseignantController@contrat')->name('contratEnseignants.contrat');

    Route::resource('academicCalendars', 'AcademicCalendarController');

    Route::resource('corkages', 'CorkageController')->except('create');
    Route::get('corkages/create/{id}', 'CorkageController@create')->name('corkages.create');

});