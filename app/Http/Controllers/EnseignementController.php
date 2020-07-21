<?php

namespace App\Http\Controllers;

use App\DataTables\EnseignementDataTable;
use App\Events\EnseignementUpdate;
use App\Helpers\AcademicYear;
use App\Http\Requests;
use App\Http\Requests\CreateEnseignementRequest;
use App\Http\Requests\UpdateEnseignementRequest;
use App\Repositories\ContratEnseignantRepository;
use App\Repositories\CycleRepository;
use App\Repositories\EcueRepository;
use App\Repositories\EnseignantRepository;
use App\Repositories\EnseignementRepository;
use App\Repositories\SemestreRepository;
use App\Repositories\SpecialiteRepository;
use App\Repositories\UeRepository;
use Carbon\Carbon;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use PDF;


class EnseignementController extends AppBaseController
{
    /** @var  EnseignementRepository */
    private $enseignementRepository;
    private $ecueRepository;
    private $enseignantRepository;
    private $semestreRepository;
    private $specialiteRepository;
    private $cycleRepository;
    protected $anneeAcademic;
    protected $ueRepository;
    protected $contratEnseignantRepository;

    public function __construct(EnseignementRepository $enseignementRepo, AcademicYear $academicYear, ContratEnseignantRepository $contratEnseignantRepository,
                                EcueRepository $ecueRepository, EnseignantRepository $enseignantRepository,
                                SemestreRepository $semestreRepository, SpecialiteRepository $specialiteRepository,
                                CycleRepository $cycleRepository,UeRepository $ueRepository, Request $request)
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

        $this->enseignementRepository = $enseignementRepo;
        $this->ecueRepository = $ecueRepository;
        $this->enseignantRepository = $enseignantRepository;
        $this->semestreRepository = $semestreRepository;
        $this->specialiteRepository = $specialiteRepository;
        $this->cycleRepository = $cycleRepository;
        $this->ueRepository = $ueRepository;
        $this->anneeAcademic = $academicYear->getCurrentAcademicYear();
        $this->contratEnseignantRepository = $contratEnseignantRepository;
    }

    /**
     * Display a listing of the Enseignement.
     *
     * @param EnseignementDataTable $enseignementDataTable
     * @return Response
     */
    public function index(EnseignementDataTable $enseignementDataTable)
    {
//        return $enseignementDataTable->render('enseignements.index');

        $enseignements = $this->enseignementRepository->findWhere(['academic_year_id' => $this->anneeAcademic]);

        return view('enseignements.index', compact('enseignements'));
    }

    /**
     * Show the form for creating a new Enseignement.
     *
     * @return Response
     */
    public function create($semestre, $specialite)
    {
        $ens= $this->contratEnseignantRepository->findWhere(['academic_year_id' => $this->anneeAcademic]);
        $ue = $this->ueRepository->all();
        //Variables dans lesquelles seront sockées les ecues et les enseignants filtrés
        $ecues=$enseignants=array();

        $spe = $this->specialiteRepository->findWithoutFail($specialite);
        $ec = $spe->ecues->where('semestre_id', $semestre)->where('academic_year_id', $this->anneeAcademic);

        $ues = array();

        foreach($ue as $u){
            $ues[$u->id] = $u->title;
        }

        foreach($ec as $ecue){
            if($ecue->semestre_id == $semestre){
                $ecues[$ecue->id] = $ecue->title;
            }
        }

        foreach($ens as $contrat){
            if($contrat->enseignant)
                $enseignants[$contrat->id] = $contrat->enseignant->name;
        }
        return view('enseignements.create', compact('ecues', 'enseignants', 'ues', 'specialite'));
    }

    public function search($n){
        $specialites = $this->specialiteRepository->all();
        $cycles = $this->cycleRepository->all();
        if($n == '1')
            $method = 'create';
        elseif($n == '2')
            $method = 'affiche';
        $model = 'enseignements';

        return view('search',compact('cycles','model', 'method'));
    }

    public function affiche($sem, $spe, Request $request){
        $semestre = $this->semestreRepository->findWithoutFail($sem);
        $specialite = $this->specialiteRepository->findWithoutFail($spe);
        $ecues = $specialite->ecues->where('semestre_id', $semestre->id)->where('academic_year_id', $this->anneeAcademic);

        $ens = [];
        foreach($ecues as $ec){
            $enseignement = $ec->enseignements->where('specialite_id', $specialite->id)->first();
            isset($enseignement->id) ? array_push($ens, $enseignement->id) : '';
        }
        $enseignements = $this->enseignementRepository->findWhereIn('id', $ens);
        $request->session()->forget('url');

        return view('enseignements.affiche', compact('enseignements', 'specialite', 'semestre'));

    }

    public function rapport($n){
        if($n==1 || $n==2){
            $semestres = $this->semestreRepository->findWhere(['suffixe' => $n]);


            view()->share(['semestres'=>$semestres, 'anneeAcademic' => $this->anneeAcademic]);

            return view('enseignements.rapport');
        }
        else{
            return route('home');
        }

    }

    /**
     * Store a newly created Enseignement in storage.
     *
     * @param CreateEnseignementRequest $request
     *
     * @return Response
     */
    public function store(CreateEnseignementRequest $request)
    {
        $input = $request->except(['ecue_id', 'specialite_id']);
        $input['academic_year_id'] = $this->anneeAcademic;
//        dd($input);
        $enseignement = $this->enseignementRepository->updateOrCreate([
            'ecue_id' => $request->input('ecue_id'), 'specialite_id' => $request->input('specialite_id')],
            $input
        );
//        dd($enseignement);

        Flash::success('Enseignement saved successfully.');

        return redirect(route('enseignements.index'));
    }

    /**
     * Display the specified Enseignement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $enseignement = $this->enseignementRepository->findWithoutFail($id);

        if (empty($enseignement)) {
            Flash::error('Enseignement not found');

            return redirect(route('enseignements.index'));
        }

        return view('enseignements.show')->with('enseignement', $enseignement);
    }

    /**
     * Show the form for editing the specified Enseignement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $enseignement = $this->enseignementRepository->findWithoutFail($id);

        if($enseignement->ingoing)
            $enseignement->ingoing->delete();

        $ec = $this->ecueRepository->findWhere(['academic_year_id' => $this->anneeAcademic]);
        $spe = $this->specialiteRepository->all();
        $ens = $this->contratEnseignantRepository->findWhere(['academic_year_id' => $this->anneeAcademic]);
        $ue = $this->ueRepository->all();
        $ecues = [];
        $enseignants = [];
        foreach($ec as $ecue){
            $ecues[$ecue->id] = $ecue->title;
        }

        $specialite = $enseignement->specialite->id;

        $ues = array();

        foreach($ue as $u){
            $ues[$u->id] = $u->title;
        }

        foreach($ens as $contrat){
            if($contrat->enseignant)
            $enseignants[$contrat->id] = $contrat->enseignant->name;
        }
        if (empty($enseignement)) {
            Flash::error('Enseignement not found');

            return redirect(route('enseignements.index'));
        }


        return view('enseignements.edit', compact('enseignement', 'ecues', 'enseignants', 'specialite', 'ues'));
    }

    public function editMh($id){
        $enseignement = $this->enseignementRepository->findWithoutFail($id);
        if (empty($enseignement)) {
            Flash::error('Enseignement not found');

            return redirect(route('enseignements.index'));
        }

        $url = back()->getTargetUrl();
        session(['url' => $url]);

        return view('enseignements.editMh', compact('enseignement', 'ecues', 'url'));
    }

    public function updateMh($id, UpdateEnseignementRequest $request){

        $enseignement = $this->enseignementRepository->findWithoutFail($id);
        $input = $request->all();
        $input['mhEff'] = (int)($enseignement->mhEff + $input['mhEff']);
//        dd($input);

        if (empty($enseignement)) {
            Flash::error('Enseignement not found');

            return redirect(route('enseignements.index'));
        }

        $enseignement = $this->enseignementRepository->update($input, $id);

        Flash::success('Enseignement updated successfully.');

        return redirect($request->session()->get('url'));
    }

    public function pdfview(Request $requests){
        $enseignements = $this->enseignementRepository->findWhere(['academic_year_id' => $this->anneeAcademic]);
        view()->share('enseignements',$enseignements);

        if($requests->has('download')){
            $pdf = PDF::loadView('enseignements.pdfView');
            return $pdf->download('enseignementList.pdf');
        }
        return view('enseignements.pdfView');
    }

    /**
     * Update the specified Enseignement in storage.
     *
     * @param  int              $id
     * @param UpdateEnseignementRequest $request
     *
     * @return Response
     */
    public function update($id, CreateEnseignementRequest $request)
    {
        $enseignement = $this->enseignementRepository->findWithoutFail($id);
        $input = $request->all();
        //$input['mhEff'] = (int)($enseignement->mhEff + $input['mhEff']);
        //dd($input);

        if (empty($enseignement)) {
            Flash::error('Enseignement not found');

            return redirect(route('enseignements.index'));
        }
        
        $enseignement = $this->enseignementRepository->update($input, $id);
        //dd($enseignement);

        Flash::success('Enseignement updated successfully.');

        return redirect(route('enseignements.index'));
    }

    /**
     * Remove the specified Enseignement from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $enseignement = $this->enseignementRepository->findWithoutFail($id);

        if (empty($enseignement)) {
            Flash::error('Enseignement not found');

            return redirect(route('enseignements.index'));
        }

        $this->enseignementRepository->delete($id);

        Flash::success('Enseignement deleted successfully.');

        return redirect(route('enseignements.index'));
    }
}
