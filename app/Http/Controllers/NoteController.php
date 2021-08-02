<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear as Inscrip;
use App\Helpers\CodeUeHelper as SpeciialityCode;
use App\Http\Requests\CreateNoteRequest;
use App\Models\AcademicYear;
use App\Models\Contrat;
use App\Models\Enseignement;
use App\Repositories\AcademicYearRepository;
use App\Repositories\ContratRepository;
use App\Repositories\CycleRepository;
use App\Repositories\EcueRepository;
use App\Repositories\EnseignementRepository;
use App\Repositories\NoteRepository;
use App\Repositories\ResultatNominatifRepository;
use App\Repositories\SemestreInfoRepository;
use App\Repositories\SemestreRepository;
use App\Repositories\SpecialiteRepository;
use App\Repositories\UeInfoRepository;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class NoteController extends Controller
{
    protected $specialiteRepository;
    protected $cycleRepository;
    protected $semestreRepository;
    protected $enseignementRepository;
    protected $anneeAcademic;
    protected $contratRepository;
    protected $noteRepository;
    protected $ecueRepository;
    protected $ueInfoRepository;
    protected $semestreInfoRepository;
    protected $resultatNominatifsRepository;
    protected $specialityCode;
    protected $academicYearRepository;

    public function __construct(CycleRepository $cycleRepository, SpecialiteRepository $specialiteRepository,
                                SemestreRepository $semestreRepository, EnseignementRepository $enseignementRepository,
                                ContratRepository $contratRepository, Inscrip $academicYear,
                                NoteRepository $noteRepository, EcueRepository $ecueRepository, UeInfoRepository $ueInfoRepository,
                                SemestreInfoRepository $semestreInfoRepository, ResultatNominatifRepository $resultatNominatifRepository,
                                AcademicYearRepository $academicYearRepository)
    {
        $this->cycleRepository = $cycleRepository;
        $this->specialiteRepository = $specialiteRepository;
        $this->semestreRepository = $semestreRepository;
        $this->enseignementRepository = $enseignementRepository;
        $this->anneeAcademic = AcademicYear::find($academicYear->getCurrentAcademicYear());

        $this->contratRepository = $contratRepository;
        $this->noteRepository = $noteRepository;
        $this->ecueRepository = $ecueRepository;
        $this->semestreInfoRepository = $semestreInfoRepository;
        $this->ueInfoRepository = $ueInfoRepository;
        $this->resultatNominatifsRepository = $resultatNominatifRepository;
        $this->academicYearRepository = $academicYearRepository;

        $this->specialityCode = [
            'BF' => 1,
            'CG' => 2,
            'CMD' => 3,
            'TL' => 4,
            'MAMES' => 1,
            'MACMAD' => 2,
            'MAMREH' => 3,
            'MAACO' => 4,
            'MAFINE' => 5,
            'MAQUAP' => 6,
            'MATRAS' => 7,
            'MAFIDA' => 7,
            'EMBA' => 8,
        ];
    }

    public function search($n, $type = null){
        $specialites = $this->specialiteRepository->all();
        $cycles = $this->cycleRepository->all();

        $academicYears = [];
        $ay = $this->academicYearRepository->all();
        foreach ($ay as $a){
            $academicYears[$a->id] = $a->debut.'/'.$a->fin;
        }
        $cur_year= $this->anneeAcademic;

        if($n == '2')
            $method = 'imprime';
        elseif($n == '1')
            $method = 'affiche';
        elseif($n == '3')
            $method = 'deliberation';
        elseif($n == '4')
            $method = 'rattrapage';
        elseif ($n == '5'){
            $method = 'pv';
        }
        elseif ($n == '6'){
            $method = 'pvcc';
        }
        elseif ($n == '7') {
            $method = 'rn_intermediaire';
        }
        $model = 'notes';


        return view('search',compact('cycles','model', 'method', 'type', 'academicYears', 'cur_year'));
    }

    /**
     * @param $sem for semester
     * @param $spe for speciality
     * cette fonction sert à l'enregistrement des notes de l'etudiant
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function affiche($sem, $spe, Request $request){
        $semestre = $this->semestreRepository->findWithoutFail($sem);
        $specialite = $this->specialiteRepository->findWithoutFail($spe);
        $ecues = $specialite->ecues->where('semestre_id', $semestre->id);
        $aa = ($request->ay_id == null) ? $this->anneeAcademic : $this->academicYearRepository->findWithoutFail($request->ay_id);

        $ens = [];
        foreach($ecues as $ec){
            $enseignement = $ec->enseignements->where('specialite_id', $specialite->id)->where('academic_year_id', '==', $aa->id)->first();
            isset($enseignement->id) ? array_push($ens, $enseignement->id) : '';
        }
        $enseignements = $this->enseignementRepository->findWhereIn('id', $ens);

        return view('notes.affiche', compact('enseignements', 'specialite', 'semestre'));
    }

    /**
     * Afficher la page où l'on va renseigner les notes obtenues par les etudiants dans l'ecue choisies.
     *
     * @param  int  $id reprensente l'id de l'enseignement choisi
     * @return \Illuminate\Http\Response
     */
    public function show($type, $id){
        $enseignement = $this->enseignementRepository->findWithoutFail($id);
        $specialite = $enseignement->specialite->id;
        $cycle = $enseignement->ecue->semestre->cycle->id;
        $sem = $enseignement->ecue->semestre->id;

        // $contrats = $this->contratRepository->findWhere(['specialite_id' => $specialite, 'cycle_id' => $cycle, 'academic_year_id' => $this->anneeAcademic->id]);

        $c = Contrat::join('apprenants', 'apprenant_id', '=', 'apprenants.id')
            ->select('contrats.*')
            ->where('specialite_id', $specialite)
            ->where('cycle_id', $cycle)
            ->where('contrats.academic_year_id', $enseignement->academic_year_id)
            ->orderBy('apprenants.nom')
            ->orderBy('apprenants.prenom');

        //Si on est en deuxieme session? on recupere les etudiant qui son alles en 2e session
        $contrats = ($type != 'session2') ? $c->get() : $c->whereHas('semestre_infos', function($q) use ($sem){
            $q->where('session', 'session2')->where('semestre_id', $sem);
        })->get();

        $ccComp = true;

        // controller que tous les apprenants ont deja une note de cc;
        foreach($contrats as $contrat){
            if(!$contrat->notes->where('enseignement_id', $enseignement->id)->first() && $type != 'cc')
                $ccComp = false;
        }

        if(!$ccComp){
            Flash::error('Un ou plusieurs apprenants n\'ont pas de note de CC');
            return redirect()->back();
        }

        return view('notes.show', compact('enseignement', 'contrats' , 'type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($type, $enseignement, Request $request){
        $input = $request->except('_token', 'DataTables_Table_0_length');
        $enseignement    = $this->enseignementRepository->findWithoutFail($enseignement);
        foreach($input as $key => $value){
            $contrat = $this->contratRepository->findWithoutFail($key);

            $note = $this->noteRepository->updateOrCreate(
                ['enseignement_id' => $enseignement->id, 'contrat_id' => $key],
                [$type => ($value != null) ? $value : 0]
            );
            if($type != 'cc'){
                if($type == 'session1'){
                    $note->del1 = ($note->session1 == 0) ? 0 : $note->cc*0.4 + $note->session1*0.6;
                    $note->save();
                }
                elseif($type == 'session2'){
                    $note->del2 = ($note->session2 == 0) ? 0 : $note->cc*0.4 + $note->session2*0.6;
                    $note->save();
                }
            }
            if($type == 'cc'){//lorsqu'on enregistre le cc apres la note d'examen le syteme recalcule la note finale
                $note->del1 = ($note->del1 != null) ? $note->cc*0.4 + $note->session1*0.6 : null;
                $note->del2 = ($note->del2 != null) ? $note->cc*0.4 + $note->session2*0.6 : null;
                $note->save();
            }

        }
        return redirect()->route('notes.affiche', [$enseignement->ecue->semestre->id, $note->contrat->specialite->id]);
    }

    /**
     * @param $sem
     * @param $spec
     * @param $session
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     *
     * Liste des etudiants à deliberer (possibilité de choisir les etudiants avant delibération)
     *
     */

    public function a_deliberer($sem, $spec, $session, Request $request){

        $cycle = $this->semestreRepository->findWithoutFail($sem)->cycle;
        $aa = ($request->ay_id == null) ? $this->anneeAcademic : $this->academicYearRepository->findWithoutFail($request->ay_id);

        //on recupere tous les contrats par ordre alphabetique

        $c = Contrat::join('apprenants', 'apprenant_id', '=', 'apprenants.id')
            ->select('contrats.*')
            ->where('specialite_id', $spec)
            ->where('cycle_id', $cycle->id)
            ->where('contrats.academic_year_id', $aa->id)
            ->orderBy('apprenants.nom')
            ->orderBy('apprenants.prenom');

        //Si on est en deuxieme session? on recupere les etudiant qui son alles en 2e session
        $contrats = ($session == 'session1') ? $c->get() : $c->whereHas('semestre_infos', function($q) use ($sem){
            $q->where('session', 'session2')->where('semestre_id', $sem);
        })->get();

        if (empty($contrats)) {
            Flash::error('Aucun apprenant dans cette classe');
            return redirect()->back();
        }
        return view('notes.a_deliberer', compact('contrats', 'sem', 'session', 'spec'));
    }

    public function pv($sem, $spec, $session, Request $request){
        $id = $request->input('contrat_id');
        if (empty($id)) {
            Flash::error('Selectionnez au moins un étudiant');
            return redirect()->back();
        }
        $cycle = $this->semestreRepository->findWithoutFail($sem)->cycle;
        $aa = ($request->ay_id == null) ? $this->anneeAcademic : $this->academicYearRepository->findWithoutFail($request->ay_id);

        //on recupere tous les contrats par ordre alphabetique

        $c = Contrat::join('apprenants', 'apprenant_id', '=', 'apprenants.id')
            ->select('contrats.*')
            ->where('specialite_id', $spec)
            ->where('cycle_id', $cycle->id)
            ->where('contrats.academic_year_id', $aa->id)
            ->whereIn('contrats.id', $id)
            ->orderBy('apprenants.nom')
            ->orderBy('apprenants.prenom');

        //Si on est en deuxieme session? on recupere les etudiant qui son alles en 2e session
        $contrats = ($session == 'session1') ? $c->get() : $c->whereHas('semestre_infos', function($q) use ($sem){
            $q->where('session', 'session2')->where('semestre_id', $sem);
        })->get();

//        dd($contrats, $id, $request->ay_id, $aa->id);

        if (empty($contrats)) {
            Flash::error('Aucun des apprenants selectionnés dans cette classe ne possède de note');
            return redirect()->back();
        }

        $i=0; // increment d'effectif
        $semestre = $this->semestreRepository->findWithoutFail($sem);
        $specialite = $this->specialiteRepository->findWithoutFail($spec);
        $ecues =[];
        $academicYear = $aa;
        $ec = $specialite->ecues->where('semestre_id', $sem);
        foreach($ec as $ecue){
            $ecues[] = $ecue->id;
        }
        // $enseignements = $specialite->enseignements->whereIn('ecue_id', $ecues)->where('academic_year_id', $this->anneeAcademic->id);

        $enseignements = Enseignement::whereHas('notes')->whereIn('ecue_id', $ecues)->where('academic_year_id', $aa->id)->where('specialite_id', $specialite->id)->get();

        // dd($enseignements);

        $ues = [];
        foreach($enseignements as $enseignement){
            $ues[$enseignement->ue->id] = $enseignement->ue;
        }
        // dd($ues);

        foreach($contrats as $contrat){
            $result = $this->saveNotes($contrat, $enseignements, $session, $sem); // renvoi true si tous les enseignements ont une note de cc
        }

        //Controle pour verifier que tous les apprenants ont des notes enregistrées
        foreach ($contrats as $contrat) {
            foreach ($enseignements as $enseignement) {
                if($contrat->notes->where('enseignement_id', $enseignement->id)->first() == null){
                    Flash::error('L\'etudiant(e) '. $contrat->apprenant->nom .' '. $contrat->apprenant->prenom .' ne possede pas de note de '. $enseignement->ecue->title);
                    return redirect()->back();
                }
            }
        }


        $specialityCode = $this->specialityCode[$specialite->slug];
        return view('notes.pv', compact('contrats', 'enseignements', 'ues', 'semestre', 'i', 'academicYear', 'session', 'specialite', 'specialityCode' ));
    }

    /**
     * cette fonction est une fonction interne qui permettra d'enregistrer les
     * informations sur le semestre de l'etudiant
     *
     *
     */
    protected function saveNotes($contrat, $enseignements, $session, $semestre){
        $semestreInfo = $this->semestreInfoRepository->firstOrNew([
            'semestre_id'=>$semestre,
            'contrat_id' => $contrat->id
        ]);
        // dd($session);
        $semestreInfo->session = $session;
        $elimSemestre = false;

        $creditObtsem = 0;
        $nbUeValid = 0;
        $totalSem = 0;
        // dd($session);
        $ues = [];

        foreach ($enseignements as $enseignement){
            $ues[$enseignement->ue_id] = $enseignement->ue;
        }

        foreach ($ues as $ue){
            $ueInfo = $this->ueInfoRepository->firstOrNew(['ue_id' => $ue->id, 'contrat_id' => $contrat->id]);
            $elim = false;
            $creditTot = $enseignements->where('ue_id', $ue->id)->sum('credits');
            $creditObt = 0;
            $totalUe = 0;
            //en fonction des notes enjambement. lorsque ce sera géré.
            $note = 0;


            // $notes=[];
            foreach ($enseignements->where('ue_id', $ue->id) as $enseignement){
                if($contrat->notes->where('enseignement_id', $enseignement->id)->first() == null){
                    return false;
                }



                $note = ($session == 'session1') ? $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del1 : $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del2;
                if ($session == 'session1'){
                    $note = $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del1 ;
                }
                elseif($session == 'session2'){

                    $del1 = $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del1;
                    $del2 = $contrat->notes->where('enseignement_id', $enseignement->id)->first()->del2;

                    $note = ($del2 > $del1) ? $del2 : $del1; //Si la note deuxieme session est superieure a la note de premiere session considerer la note de 2e session sinon considerer la 1ere session
                    // dd($note);
                }
                elseif($session == 'enjambement'){
                    $note = $contrat->notes->where('enseignement_id', $enseignement->id)->first()->enjambement;
                }
                $totalUe += $note * $enseignement->credits;
                if ($note < 5){
                    $elim = $elimSemestre = true;
                }
                if($note >= 10) {
                    $creditObt += $enseignement->credits;
                }

            }

            $ueInfo->creditObt = $creditObt;
            $ueInfo->creditTot = $creditTot;
            $ueInfo->moyenne = $totalUe / $ueInfo->creditTot;
            $ueInfo->totalNotes = $totalUe;

            $totalSem += $ueInfo->totalNotes;


            if(!$elim && $ueInfo->moyenne >= 10){
                $ueInfo->mention = 'Validé';
                $ueInfo->creditObt = $ueInfo->creditTot;
                $nbUeValid +=1;
            }
            else{
                $ueInfo->mention = 'Non Validé';
            }
            $ueInfo->save();
            $creditObtsem += $ueInfo->creditObt;
        }
// dd($totalSem);
        $semestreInfo->moyenne = $totalSem/30;
        $semestreInfo->creditObt = $creditObtsem;
        $semestreInfo->nbUeValid = $nbUeValid;
        $semestreInfo->totalNotes = $totalSem;

        /*
         * Si une ou plusieurs unités d'enseignements n'ont pas obtenus de note eliminatoire,
         * on verifie que l'apprenant a valider au moins (n-1) unités d'enseignement du semestre
         * le cas echeant le semestre est considéré comme non validé
         */
        if(!$elimSemestre && $semestreInfo->moyenne >= 10){
            if($nbUeValid == sizeof($ues)){
                $semestreInfo->mention = 'Validé';
            }
//            elseif(sizeof($ues) > $nbUeValid && (sizeof($ues) - $nbUeValid) ==1){
//                $semestreInfo->mention = 'Validé par Compensation';
//                $semestreInfo->creditObt = 30;
//                $semestreInfo->nbUeValid = sizeof($ues);
//            }
            else{
                $semestreInfo->mention = 'Non Validé';
            }
        }
        else{
            $semestreInfo->mention = 'Non Validé';
        }
        // dd($session);
        if($session == 'session1'){
            $semestreInfo->session = ($semestreInfo->mention == 'Non Validé') ? 'session2' : 'session1';
        }

        $semestreInfo->save();
        return true;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deliberation($sem, $spec, Request $request){
        $specialite = $this->specialiteRepository->findWithoutFail($spec);
        $semestre = $this->semestreRepository->findWithoutFail($sem);
        $aa = ($request->ay_id == null) ? $this->anneeAcademic : $this->academicYearRepository->findWithoutFail($request->ay_id);
        $contrats = $this->contratRepository->findWhere([
            'specialite_id' => $specialite->id,
            'cycle_id' => $semestre->cycle->id,
            'academic_year_id' => $aa->id
        ]);

        return view('notes.deliberation', compact('specialite', 'semestre', 'contrats'));

    }


    public function noteDeliberation($type, $app, $sem){
        $contrat = $this->contratRepository->findWithoutFail($app);
        $semestre = $this->semestreRepository->findWithoutFail($sem);
        $ecues = $contrat->specialite->ecues->where('semestre_id', $semestre->id)->where('academic_year_id', $contrat->academic_year_id); // toutes les ecues de la specialite de l'etudiant.

        $denied = false; //pour verifier que les notes de 1ere session ont ete deja renseignees

        $enseignements = []; //conteneur dans lequel seront chargés tous les enseignements concernés

        foreach($ecues as $ecue){
            $ens = $ecue->enseignements->where('specialite_id', $contrat->specialite_id)->where('academic_year_id', '==', $contrat->academic_year_id)->first();
            ($ens) ? $enseignements[] = $ens : '';
        }

        /**
         * Pour chaque enseigements verifier que l'etudiant possede une note et
         * qu'il possede aussi une note dans la session dans laquelle il va etre delibere.
         */

        foreach ($enseignements as $e){
            if($contrat->notes->where('enseignement_id', $e->id)->first()) {
                if ($contrat->notes->where('enseignement_id', $e->id)->first()->session1 == null)
                    $denied = true;
            }
            else
                $denied = true;
        }

//         if($denied){
//             Flash::error('Veuillez renseigner les notes de '.$type .' de tous les etudiants avant de deliberer');
//             return redirect()->back();
//         }

        return view('notes.noteDeliberation', compact('contrat', 'enseignements', 'type', 'sem'));
    }

    public function saveDeliberation($sem, $type, $contrat, Request $request){
        $input = $request->except('_token');
        $contrat = $this->contratRepository->findWithoutFail($contrat);
        $semestre = $this->semestreRepository->findWithoutFail($sem);
        // dd($input);
        foreach ($input as $key => $value){
            $enseignement = $this->enseignementRepository->findWithoutFail($key);
            $note = $this->noteRepository->findWhere(
                ['enseignement_id' => $enseignement->id, 'contrat_id' => $contrat->id]
            )->first();
            // dd(['session'=>$type]);
            if ($type =='session1'){
                $note->update(['del1'=> $value]);
            }
            elseif ($type == 'session2'){
                ($value != null) ? $note->update(['del2' => $value]) : "";
            }
        }

        $enseignements = $semestre->enseignements->where('specialite_id', $contrat->specialite_id)->where('academic_year_id', $contrat->academic_year_id);

        $this->saveNotes($contrat, $enseignements, $type, $sem);

        // traitement des cas d'enjambement
        if ($type == 'session2' && $semestre->suffixe == 2){
            $this->setResultat($contrat, $semestre);
        }


        return redirect()->route('notes.deliberation',[$semestre->id, $contrat->specialite_id]);
    }

    protected function setResultat($contrat, $semestre){
        $resultat = $this->resultatNominatifsRepository->firstOrNew(['contrat_id' => $contrat->id]);

        if ($semestre->cycle_id != 3 && $semestre->cycle_id != 5){

            if ($semestre->cycle->niveau == 1){
                $credits = $contrat->semestre_infos->sum('creditObt');
                $nb_sem_val = $contrat->semestre_infos->where('credtiObt', 30)->count();

                /** L'apprenant a validé le semestre **/

                if ($nb_sem_val == 2){
                    $resultat->next_cycle_id = $contrat->cycle_id + 1;
                    $resultat->decision = 'Admis';
                    $resultat->save();
                }
                elseif($nb_sem_val < 2 && $credits >= 45){
                    if ($nb_sem_val == 1 || $contrat->semestre_infos->where('creditObt', '>=', 23)){
                        $resultat->next_cycle_id = $contrat->cycle_id + 1;
                        $resultat->decision = 'Enjambement';
                        $resultat->save();
                    }
                    else{
                        $resultat->next_cycle_id = $contrat->cycle_id;
                        $resultat->decision = 'Redouble';
                        $resultat->save();
                    }
                }
                else{
                    $resultat->next_cycle_id = $contrat->cycle_id;
                    $resultat->decision = 'Redouble';
                    $resultat->save();
                }
            }
            elseif ($semestre->cycle->niveau == 2){ /** L'apprenant est en licence 2 **/
                if($contrat->academic_year_id != $contrat->apprenant->academic_year_id && $contrat->apprenant->academic_year_id != 1){ /** anciens apprenants de Pigier */
                    $credits = $contrat->apprenant->semestre_infos->sum('creditObt');
                    $nb_sem_val = $contrat->apprenant->semestre_infos->where('creditObt', 30)->count();

                    if ($credits == 120){
                        $resultat->next_cycle_id = $contrat->cycle_id + 1;
                        $resultat->decision = 'Admis';
                        $resultat->save();
                    }
                    /**
                     * Anciens apprenant de licence 2 pouvant etre en situation d'enjambement
                     **/
                    elseif ($credits >= 90 && $nb_sem_val >= 2 && $contrat->apprenant->semestre_infos->where('creditObt', '>=', 15)->count() == 4){
                        /** Egal à 4 car deux semestres sont supposé avoir 30 credits */
                        $resultat->next_cycle_id = $contrat->cycle_id + 1;
                        $resultat->decision = 'Enjambement';
                        $resultat->save();
                    }
                    else{
                        $resultat->next_cycle_id = $contrat->cycle_id;
                        $resultat->decision = 'Redouble';
                        $resultat->save();
                    }
                }
            }
        }
    }

    public function rattrapage($sem, $spec, Request $request){

        $semestre = $this->semestreRepository->findWithoutFail($sem);
        $specialite = $this->specialiteRepository->findWithoutFail($spec);
        $aa = ($request->ay_id == null) ? $this->anneeAcademic : $this->academicYearRepository->findWithoutFail($request->ay_id);

        $app = $this->contratRepository->findWhere(['specialite_id' => $specialite->id, 'cycle_id' => $semestre->cycle_id, 'academic_year_id' => $aa->id]);

        $contrats = [];

        $enseignements= [];

        foreach($app as $contrat){
            $ens =[];
            $semestreInfo = $contrat->semestre_infos->where('semestre_id', $semestre->id)->first();
            if (!$semestreInfo){
                Flash::error('Veuillez deliberer tous les etudiants avant svp');
                return redirect()->back();
            }

            if($semestreInfo->mention == 'Non Validé'){
                $contrats[] = $contrat;
                foreach($contrat->ue_infos as $ueInfo){
                    if($ueInfo->mention == 'Non Validé'){
                        foreach ($contrat->notes as $note) {
                            if ($note->enseignement->ue_id == $ueInfo->ue_id && $note->del1 < 10) {
                                $ens[$note->enseignement->ecue->title] = $note->enseignement;
                            }
                        }
                        $enseignements[$ueInfo->ue->title] = $ens;
                    }
                }
            }
            $enseignements[$contrat->id] = $ens;
        }
        return view('notes.rattrapage', compact('contrats', 'enseignements'));
    }



    public function getNoteContrat($contrat, $enseignement){
        $note = $this->noteRepository->findWhere(['enseignement_id' => $enseignement, 'contrat_id' => $contrat]);
        return response()->json($note);
    }

    public function imprime($sem, $specialite, Request $request){
        $semestre = $this->semestreRepository->findWithoutFail($sem);
        $aa = ($request->ay_id == null) ? $this->anneeAcademic : $this->academicYearRepository->findWithoutFail($request->ay_id);
        $contrats = $this->contratRepository->findWhere(['specialite_id' => $specialite, 'cycle_id' => $semestre->cycle_id, 'academic_year_id' => $aa->id]);

        return view('notes.imprime', compact('contrats', 'semestre'));
    }

    public function releve($session, $contrat, $semestre){

        $contrat = $this->contratRepository->findWithoutFail($contrat);



        $academicYear = $contrat->academic_year;

        $semestre = $this->semestreRepository->findWithoutFail($semestre);

        $enseignements = $semestre->enseignements->where('specialite_id', $contrat->specialite_id)->where('academic_year_id', $contrat->academic_year_id);

        foreach ($enseignements as $enseignement) {
            if($contrat->notes->where('enseignement_id', $enseignement->id)->first() == null){
                Flash::error('L\'etudiant(e) '. $contrat->apprenant->nom .' '. $contrat->apprenant->prenom .' ne possede pas de note de '. $enseignement->ecue->title);
                return redirect()->back();
            }
        }
        $ues = [];

        foreach ($enseignements as $enseignement) {
            $ues[$enseignement->ue_id] = $enseignement->ue;
        }

        $specialityCode = $this->specialityCode[$contrat->specialite->slug];

        return view('notes.rnr_imprime', compact('contrat', 'semestre', 'enseignements', 'ues', 'academicYear', 'session', 'specialityCode'));
    }

    public function rn_intermediaire($sem, $spec, $session, Request $request){
        $semestre = $this->semestreRepository->findWithoutFail($sem);
        $cycle = $this->semestreRepository->findWithoutFail($sem)->cycle;
        $aa = ($request->ay_id == null) ? $this->anneeAcademic : $this->academicYearRepository->findWithoutFail($request->ay_id);

        $c = Contrat::join('apprenants', 'apprenant_id', '=', 'apprenants.id')
            ->select('contrats.*')
            ->where('specialite_id', $spec)
            ->where('cycle_id', $cycle->id)
            ->where('contrats.academic_year_id', $aa->id)
            ->orderBy('apprenants.nom')
            ->orderBy('apprenants.prenom');

        $contrats = ($session == 'session1') ? $c->get() : $c->whereHas('semestre_infos', function($q) use ($sem){
            $q->where('session', 'session2')->where('semestre_id', $sem);
        })->get();

        $type = $session;
        $i=0;
        $specialite = $this->specialiteRepository->findWithoutFail($spec);
        $ecues =[];
        $academicYear = $this->anneeAcademic;
        $ec = $specialite->ecues->where('semestre_id', $sem);
        foreach($ec as $ecue){
            $ecues[] = $ecue->id;
        }
        $enseignements = $specialite->enseignements->whereIn('ecue_id', $ecues)->where('academic_year_id', $aa->id);
        
        return view('notes.rn_intermediaire', compact('contrats', 'enseignements', 'semestre', 'i', 'academicYear', 'session'));
    }



    public function pvcc($sem, $spec, Request $request){
        $specialite = $this->specialiteRepository->findWithoutFail($spec);
        $semestre = $this->semestreRepository->findWithoutFail($sem);
        $cycle = $this->semestreRepository->findWithoutFail($semestre->id)->cycle;
        $aa = ($request->ay_id == null) ? $this->anneeAcademic : $this->academicYearRepository->findWithoutFail($request->ay_id);

        $contrats = Contrat::join('apprenants', 'apprenant_id', '=', 'apprenants.id')
            ->select('contrats.*')
            ->where('specialite_id', $spec)
            ->where('cycle_id', $cycle->id)
            ->where('contrats.academic_year_id', $aa->id)
            ->orderBy('apprenants.nom')
            ->orderBy('apprenants.prenom')
            ->get();

        $ecues =[];
        $academicYear = $aa;
        $ec = $specialite->ecues->where('semestre_id', $sem);
        foreach($ec as $ecue){
            $ecues[] = $ecue->id;
        }
        $enseignements = $specialite->enseignements->whereIn('ecue_id', $ecues)->where('academic_year_id', $aa->id);

        return view('notes.pvcc', compact('contrats', 'enseignements', 'academicYear', 'semestre'));
    }



    /**
     * API methods definition Start
    */

    


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
