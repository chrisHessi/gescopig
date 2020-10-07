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


    public function __construct(AnneeAcademic $academicYear, AutorisationRepository $autorisationRepository,
                                ContratRepository $contratRepository, CycleRepository $cycleRepository,
                                EcheancierRepository $echeancierRepository, AttestationRepository $attestationRepository,
                                CertificatRepository $certificatRepository, InscriptionRepository $inscriptionRepository,
                                PreinscriptionRepository $preinscriptionRepository, Request $request)
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
    }

    public function search($n){
//        $specialites = $this->specialiteRepository->all();
        $cycles = $this->cycleRepository->all();
        if($n == '1')
            $method = 'create';
        elseif($n == '2')
            $method = 'affiche';
        $model = 'scolarites';

        return view('search',compact('cycles','model', 'method'));
    }

    public function index(){
        $academicYear = $this->academicYear;
        $contrats = Contrat::where('academic_year_id', '>=', $this->academicYear->id)->get();
        $today = Carbon::today();
        $echeanciers = $this->echeancierRepository->findWhere(['academic_year_id' => $academicYear->id, ['date', '<=', $today]]);
        return view('scolarites.index', compact('contrats', 'academicYear', 'echeanciers'));
    }

    public function inscrits(){
        $academicYear = $this->academicYear;
        $contrats = $this->contratRepository->all();
        $today = Carbon::today();
        $echeanciers = $this->echeancierRepository->findWhere(['academic_year_id' => $academicYear->id, ['date', '<=', $today]]);
        return view('scolarites.inscrits', compact('contrats', 'academicYear', 'echeanciers'));
    }

    public function old(){
        $contrats = Contrat::where('academic_year_id', '<>', $this->academicYear->id )->get();
        return view('scolarites.old', compact('contrats'));
    }

    public function contrats($id, Request $request){
        $contrat = $this->contratRepository->findWithoutFail($id);
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
        return view('documents.contrats', compact('contrat'));

    }

    public function certificat($id,$type, Request $request){
        $contrat = $this->contratRepository->findWithoutFail($id);
        $academic = $this->academicYear;
        $titre = $request->titre;
        $signataire = $request->signataire;
        $circuit = $request->circuit;
        $semestre = $request->semestre;
        $currentContrat = $this->contratRepository->findWhere(['academic_year_id'=> $this->academicYear->id]);// liste des contrats de la promo de l'etudiant
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
