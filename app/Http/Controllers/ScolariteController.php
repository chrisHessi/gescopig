<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear as AnneeAcademic;
use App\Models\AcademicYear;
use App\Models\Attestation;
use App\Models\Autorisation;
use App\Models\Contrat;
use App\Repositories\AcademicYearRepository;
use App\Repositories\AttestationRepository;
use App\Repositories\AutorisationRepository;
use App\Repositories\CertificatRepository;
use App\Repositories\ContratRepository;
use App\Repositories\CycleRepository;
use App\Repositories\EcheancierRepository;
use App\Repositories\InscriptionRepository;
use App\Repositories\PreinscriptionRepository;
use App\Repositories\ScolariteRepository;
use App\Repositories\SpecialiteRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function PHPSTORM_META\type;

class ScolariteController extends Controller
{
    protected $academicYear;
    protected $contratRepository;
    protected $academicYearRepository;
    protected $cycleRepository;
    protected $echeancierRepository;
    protected $autorisationRepository;
    protected $attestationRepository;
    protected $certificatRepository;
    protected $inscriptionRepository;
    protected $preinscriptionRepository;
    protected $specialiteRepository;


    public function __construct(AnneeAcademic $academicYear, AutorisationRepository $autorisationRepository,
                                ContratRepository $contratRepository, CycleRepository $cycleRepository,
                                EcheancierRepository $echeancierRepository, AttestationRepository $attestationRepository,
                                CertificatRepository $certificatRepository, InscriptionRepository $inscriptionRepository,
                                PreinscriptionRepository $preinscriptionRepository, Request $request,
                                SpecialiteRepository $specialiteRepository, AcademicYearRepository $academicYearRepository)
    {

        if(request()->server("SCRIPT_NAME") !== 'artisan') {
            if ($request->route()->getName() == 'enseignements.create')
                $this->middleware(['permission:create enseignements']);
            if ($request->route()->getName() == 'enseignements.affiche')
                $this->middleware(['permission:read enseignements']);
            if ($request->route()->getName() == 'enseignements.editMh')
                $this->middleware(['permission:update enseignements']);
            if ($request->route()->getName() == 'enseignements.index')
                $this->middleware(['permission:read enseignements']);
            if ($request->route()->getName() == 'enseignements.edit')
                $this->middleware(['permission:update enseignements|edit enseignements']);
            if ($request->route()->getName() == 'enseignements.update')
                $this->middleware(['permission:update enseignements|edit enseignements']);
            if ($request->route()->getName() == 'enseignements.updateMh')
                $this->middleware(['permission:update enseignements']);
        }

        $this->academicYear = AcademicYear::find($academicYear::getCurrentAcademicYear());
        $this->contratRepository = $contratRepository;
        $this->cycleRepository = $cycleRepository;
        $this->echeancierRepository = $echeancierRepository;
        $this->autorisationRepository = $autorisationRepository;
        $this->attestationRepository = $attestationRepository;
        $this->certificatRepository = $certificatRepository;
        $this->inscriptionRepository = $inscriptionRepository;
        $this->preinscriptionRepository = $preinscriptionRepository;
        $this->specialiteRepository = $specialiteRepository;
        $this->academicYearRepository = $academicYearRepository;
    }

    public function search($n){
//        $specialites = $this->specialiteRepository->all();
        $cycles = $this->cycleRepository->all();
        if($n == '1')
            $method = 'select_admis';
        elseif($n == '2')
            $method = 'affiche'; // à comprendre

        $model = 'scolarites';

        $academicYears = [];
        $ay = AcademicYear::all();
        foreach ($ay as $a){
            $academicYears[$a->id] = $a->debut.'/'.$a->fin;
        }
        $cur_year= $this->academicYear;

        return view('search',compact('cycles','model', 'method', 'academicYears', 'cur_year'));
    }

    public function index(){
        $academicYear = $this->academicYear;
        $contrats = Contrat::where('academic_year_id', '>=', $this->academicYear->id)->get();
        $today = Carbon::today();
        $echeanciers = $this->echeancierRepository->findWhere(['academic_year_id' => $academicYear->id, ['date', '<=', $today]]);
        return view('scolarites.index', compact('contrats', 'academicYear', 'echeanciers'));
    }

    public function select_admis($c, $spec, Request $request){
        $aa = ($request->ay_id == null) ? AcademicYear::find($this->academicYear) : $this->academicYearRepository->findWithoutFail($request->ay_id);

        $specialite = $this->specialiteRepository->findWithoutFail($spec);
        $cycle = $this->cycleRepository->findWithoutFail($c);
        $contrats_list = Contrat::join('apprenants', 'apprenant_id', '=', 'apprenants.id')
            ->select('contrats.*')
            ->where('specialite_id', $spec)
            ->where('cycle_id', $cycle->id)
            ->where('contrats.academic_year_id', $aa->id)
            ->orderBy('apprenants.nom')
            ->orderBy('apprenants.prenom')
            ->get();
        $contrats = [];
        foreach ($contrats_list as $contrat){ //On selectionne les contrats qui ont une note semestrielle dans les deux semestres
            if ($contrat->semestre_infos->count() >= 1){
                $contrats[$contrat->id] = $contrat;
            }
        }

        return view('scolarites.select_admis', compact('contrats'));
    }

    public function attestations_reussite(Request $request){
        $session_fr = $request->session_fr;
        $session_en = $request->session_en;
        $date = $request->date;

        $contrats = $this->contratRepository->findWhereIn('id', $request->contrat_id);
        $speciality = [
            "CG" => "Audit and Management Control",
            "BF" => "Banking and Corporate Finance",
            "TL" => "Transport, Customs and Logistic Transit",
            "CMD" => "Communication, Marketing and Digital",
            "MAACO" => "Audit and Management Control",
            "MAFINE" => "Finance",
            "MATRAS" => "Transport an Supply Chain Management",
            "MACMAD" => "Communication, Marketing and Digital",
            "MAQUAP" => "Quality and Project Management",
            "MAFIDA" => "Taxation and Business Law",
            "MAMES" => "Corporate Management"
        ];

        return view("documents.attestation_reussite", compact('contrats', 'session_en', 'session_fr', 'date', 'speciality'));
    }

    public function inscrits(){
        $currentYear = $this->academicYear;
        $years = $this->academicYearRepository->all();
        $specialites = $this->specialiteRepository->all();
        $cycles = $this->cycleRepository->all();

        $filterYears = [];
        $filterSpecialites = [];
        $filterCycles = [];

        foreach ($years as $year){
            $filterYears[$year->id] = $year->debut. '/' .$year->fin;
        }

        foreach ($specialites as $specialite){
            $filterSpecialites[$specialite->id] = $specialite->slug. '-' .$specialite->title;
        }

        foreach ($cycles as $cycle){
            $filterCycles[$cycle->id] = $cycle->label. ' ' .$cycle->niveau;
        }

        $contrats = $this->contratRepository->all();
        $today = Carbon::today();
        $echeanciers = $this->echeancierRepository->findWhere(['academic_year_id' => $currentYear->id, ['date', '<=', $today]]);
        return view('scolarites.inscrits', compact('contrats', 'currentYear', 'echeanciers', 'filterYears', 'filterCycles', 'filterSpecialites'));
    }

    public function filter(Request $request){
        $currentYear = $this->academicYear;
        $today = Carbon::today();
        $echeanciers = $this->echeancierRepository->findWhere(['academic_year_id' => $currentYear->id, ['date', '<=', $today]]);

        $years = $this->academicYearRepository->all();
        $specialites = $this->specialiteRepository->all();
        $cycles = $this->cycleRepository->all();

        $filterYears = [];
        $filterSpecialites = [];
        $filterCycles = [];

        foreach ($years as $y){
            $filterYears[$y->id] = $y->debut. '/' .$y->fin;
        }

        foreach ($specialites as $sp){
            $filterSpecialites[$sp->id] = $sp->slug. '-' .$sp->title;
        }

        foreach ($cycles as $c){
            $filterCycles[$c->id] = $c->label. ' ' .$c->niveau;
        }

        $year = $this->academicYearRepository->findWithoutFail($request->year);
        $specialite = $this->specialiteRepository->findWithoutFail($request->specialite);
        $cycle = $this->cycleRepository->findWithoutFail($request->cycle);

        $contrats = (empty($year)) ? $this->contratRepository->all() : $this->contratRepository->findWhere(['academic_year_id' => $year->id]);

        $contrats = (empty($specialite)) ? $contrats : $contrats->where('specialite_id', $specialite->id);

        $contrats = (empty($cycle)) ? $contrats : $contrats->where('cycle_id', $cycle->id);

        return view('scolarites.inscrits', compact('contrats', 'currentYear', 'echeanciers', 'filterYears', 'filterCycles', 'filterSpecialites'));
    }

    public function old(){
        $contrats = Contrat::where('academic_year_id', '<>', $this->academicYear->id )->get();
        return view('scolarites.old', compact('contrats'));
    }

    public function contrats($id, Request $request){
        $contrat = $this->contratRepository->findWithoutFail($id);
        $lastContract = Contrat::withTrashed()->where('academic_year_id', '<', $this->academicYear->id)->count();
        $rang = $contrat->id - $lastContract;
        if($request->type){
            $titre = $request->titre;
            $signataire = $request->signataire;
            $currentContrat = $this->contratRepository->findWhere(['academic_year_id'=> $contrat->academic_year_id]);
            $ids = [];
            foreach ($currentContrat as $c){
                (isset($c->autorisation)) ? $ids[] = $c->autorisation->id : '';
            }
            if (!isset($contrat->autorisation)){
                $document = $this->autorisationRepository->create(['contrat_id' => $contrat->id, 'rang' => sizeof($ids)+1]);
            }
            else{
                $document = $contrat->autorisation;
            }
            return view('documents.autorisationInscription', compact('contrat', 'document', 'titre', 'signataire'));
        }
        $contrat->state = 'Etabli';
        $contrat->save();
        return view('documents.contrats', compact('contrat', 'rang'));

    }

    public function certificat($id,$type, Request $request){
        $contrat = $this->contratRepository->findWithoutFail($id);
        $academic = $this->academicYear;
        $titre = $request->titre;
        $signataire = $request->signataire;
        $circuit = $request->circuit;
        $semestre = $request->semestre;
        $currentContrat = $this->contratRepository->findWhere(['academic_year_id'=> $contrat->academic_year_id]);// liste des contrats de la promo de l'etudiant
        $ids = [];
        $view = '';
        $document = null;

        if($type == 'inscription'){
            $view = 'inscription';
            foreach ($currentContrat as $c){
                (isset($c->inscription)) ? $ids[] = $c->inscription->id : ''; // Si l'on dejà imprimer le document de l'apprenant on ne l'enregistre plus
            }
            if (!isset($contrat->inscription)){
                $document = $this->inscriptionRepository->create(['contrat_id' => $contrat->id, 'rang' => sizeof($ids)+1]);
            }
            else{
                $document = $contrat->inscription;
            }
        }

        if($type == 'preinscription'){
            $view = 'inscription';
            foreach ($currentContrat as $c){
                (isset($c->preinscription)) ? $ids[] = $c->preinscription->id : '';
            }
            if (!isset($contrat->preinscription)){
                $document = $this->preinscriptionRepository->create(['contrat_id' => $contrat->id, 'rang' => sizeof($ids)+1]);
            }
            else{
                $document = $contrat->preinscription;
            }
        }

        if($type == 'certificat'){
            $view = 'certificat';
            foreach ($currentContrat as $c){
                (isset($c->certificat)) ? $ids[] = $c->certificat->id : '';
            }
            if (!isset($contrat->certificat)){
                $document = $this->certificatRepository->create(['contrat_id' => $contrat->id, 'rang' => sizeof($ids)+1]);
            }
            else{
                $document = $contrat->certificat;
            }
        }

        if($type == 'attestation'){
            $view = 'certificat';
            foreach ($currentContrat as $c){
                (isset($c->attestation)) ? $ids[] = $c->attestation->id : '';
            }
            if (!isset($contrat->attestation)){
                $document = $this->attestationRepository->create(['contrat_id' => $contrat->id, 'rang' => sizeof($ids)+1]);
            }
            else{
                $document = $contrat->attestation;
            }
        }
        return view('documents.'.$view, compact('type', 'contrat', 'document', 'titre', 'signataire', 'circuit', 'academic', 'semestre'));
    }

    public function suspension($id, Request $request){
        $contrat = $this->contratRepository->findWithoutFail($id);
        $date_susp = $request->date_susp;
        $reduction = (int)$request->reduction;
        $signataire = $request->signataire;
        $academicYear = $this->academicYear;
        $titre = $request->titre;

        return view('documents.suspension', compact('contrat', 'date_susp', 'reduction', 'academicYear', 'signataire', 'titre'));
    }

    public function printSuspension(){
        $academicYear = $this->academicYear;
        $contrats = $this->contratRepository->findWhere(['academic_year_id' => $academicYear->id]);
        $today = Carbon::today();
        $echeanciers = $this->echeancierRepository->findWhere(['academic_year_id' => $academicYear->id, ['date', '<=', $today]]);

        return view('scolarites.printSuspension', compact('contrats', 'academicYear', 'echeanciers'));
    }

    public function suspensions(Request $request){
        dd($request->input('contrats'));
    }

}
