<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear as AnneeAcademic;
use App\Http\Requests\CreateAbsenceRequest;
use App\Http\Requests\UpdateAbsenceRequest;
use App\Models\Absence;
use App\Models\AcademicYear;
use App\Models\Apprenant;
use App\Repositories\AbsenceRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ApprenantRepository;
use App\Repositories\ContratRepository;
use App\Repositories\CycleRepository;
use App\Repositories\EcueRepository;
use App\Repositories\EnseignementRepository;
use App\Repositories\SemestreRepository;
use App\Repositories\SpecialiteRepository;
use App\Transformers\ApprenantTransformer;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Yajra\DataTables\Datatables;
use DB;
use Yajra\DataTables\Html\Builder;
use App\Transformers;

class AbsenceController extends AppBaseController
{
    /** @var  AbsenceRepository */
    private $absenceRepository;
    protected $specialiteRepository;
    protected $ecueRepository;
    protected $semestreRepository;
    protected $cycleRepository;
    protected $apprenantRepository;
    protected $contratRepository;
    protected $academicYear;
    protected $enseignementRepository;

    public function __construct(AbsenceRepository $absenceRepo,ApprenantRepository $apprenantRepository,
                                CycleRepository $cycleRepository, EcueRepository $ecueRepository, ContratRepository $contratRepository,
                                SpecialiteRepository $specialiteRepository, SemestreRepository $semestreRepository,
                                Request $request, AnneeAcademic $academicYear, EnseignementRepository $enseignementRepository)
    {
        if (request()->server("SCRIPT_NAME") !== 'artisan') {

            if ($request->route()->getName() == 'absences.store')
                $this->middleware(['permission:create absences']);
            if ($request->route()->getName() == 'absences.update')
                $this->middleware(['permission:edit absences']);
            if ($request->route()->getName() == 'absences.store')
                $this->middleware(['role:Admin|AA']);
        }



        $this->absenceRepository = $absenceRepo;
        $this->specialiteRepository = $specialiteRepository;
        $this->ecueRepository = $ecueRepository;
        $this->semestreRepository = $semestreRepository;
        $this->cycleRepository = $cycleRepository;
        $this->apprenantRepository = $apprenantRepository;
        $this->contratRepository = $contratRepository;
        $this->academicYear = AcademicYear::find($academicYear::getCurrentAcademicYear());
        $this->enseignementRepository = $enseignementRepository;

    }

    /**
     * Display a listing of the Absence.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
//        $this->absenceRepository->pushCriteria(new RequestCriteria($request));
//        $absences = $this->absenceRepository->all();
//
//        return view('absences.index')
//            ->with('absences', $absences);
        $cycles = $this->cycleRepository->all();
        return view('index', compact('cycles'));
    }

    public function search($n){
        $specialites = $this->specialiteRepository->all();
        $cycles = $this->cycleRepository->all();
        if($n == '1')
            $method = 'create';
        elseif($n == '2')
            $method = 'affiche';
        $model = 'absences';

        return view('search',compact('cycles','model', 'method'));
    }

    public function etat(){
        $specialites = $this->specialiteRepository->all();
        $cycles = $this->cycleRepository->all();

        return view('absences.etat',compact('cycles'));
    }

    public function affiche($semestre, $specialite){

        $sem = $this->semestreRepository->findWithoutFail($semestre);
        $cycle = $this->semestreRepository->findWithoutFail($semestre)->cycle;

        $ec = $this->ecueRepository->findWhere(['semestre_id' => $sem->id]);
        $ecues = [];

        foreach($ec as $e){
            $ecues[] = $e->id;
        }

        $contrats = $this->contratRepository->findWhere([
            'specialite_id'=>$specialite,
            'cycle_id' => $cycle->id,
        ]);

            $absences = $contrats->first()->absences->whereIn('ecue_id', $ecues)->where('justify',0)->count();
//        dd($absences);

        return view('absences.affiche', compact('contrats', 'sem', 'ecues'));
    }


    /**
     * Show the form for creating a new Absence.
     *
     * @return Response
     */
    public function create($semestre, $specialite)
    {
        //$semestres = $this->semestreRepository->findWithoutFail($semestre);
        $specialites = $this->specialiteRepository->findWithoutFail($specialite);
        $ec = $specialites->ecues->where('semestre_id', $semestre);
        $cycle = $this->semestreRepository->find($semestre)->cycle;
        $contrats = $this->contratRepository->findWhere(['academic_year_id' => $this->academicYear->id,'cycle_id'=> $cycle->id, 'specialite_id' => $specialites->id]);

        $ecues= array();
        $enseignements = [];

        foreach($ec as $ecue){
            $ecues[] = $ecue->id;
        }
        $ens = $this->enseignementRepository->findWhereIn('ecue_id', $ecues)->where('academic_year_id', $this->academicYear->id)->where('specialite_id', $specialite);
        foreach ($ens as $enseignement){
            $enseignements[$enseignement->ecue->id] = $enseignement->ecue->title;
        }
//        dd($enseignements);
        return view('absences.create', compact('enseignements','contrats'));
    }

    /**
     * Store a newly created Absence in storage.
     *
     * @param CreateAbsenceRequest $request
     *
     * @return Response
     */
    public function store(CreateAbsenceRequest $request)
    {
//        $input = $request->except('apprenant_id');
        $contrat_id = $request->input('contrat_id');
        $ecue = $this->ecueRepository->findWithoutFail( $request->input('ecue_id'));
        $date = $request->input('date');
        $justify = false;
        $justification = null;


//        $absence = $this->absenceRepository->create($input);

        foreach($contrat_id as $contrat){
            Absence::create(['contrat_id' => $contrat, 'date' => $date, 'ecue_id' => $ecue->id, 'justify' => $justify]);
        }

        $model = 'absences';
        $c = $this->cycleRepository->all();
        Flash::success('Absence saved successfully.');

        return redirect(url('absences/search/1'));
    }

    /**
     * Display the specified Absence.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $absence = $this->absenceRepository->findWithoutFail($id);

        if (empty($absence)) {
            Flash::error('Absence not found');

            return redirect(route('absences.index'));
        }

        return view('absences.show')->with('absence', $absence);
    }

    /**
     * Show the form for editing the specified Absence.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($contrat, $semestre)
    {
        $contrat = $this->contratRepository->with('absences')->findWithoutFail($contrat);
        if($contrat->ingoing) {
            $contrat->ingoing->delete();
        }
        $sem = $this->semestreRepository->findWithoutFail($semestre);

//        if (empty($absence)) {
//            Flash::error('Absence not found');
//
//            return redirect(route('absences.index'));
//        }

        $ec = $this->ecueRepository->findWhere(['semestre_id' => $sem->id]);
        $ecues = [];

        foreach($ec as $e){
            $ecues[] = $e->id;
        }

        return view('absences.edit', compact('contrat','sem', 'ecues' ));
    }

    public function updateJustif($justification, $absence){
        $absence = $this->absenceRepository->findWithoutFail($absence);
        $absence->justification = $justification;
        $absence->justify = true;
        $absence->save();
        Flash::success('Absence justifiée');

        return back();
    }

    /**
     * Update the specified Absence in storage.
     *
     * @param  int              $id
     * @param UpdateAbsenceRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $absence = $this->absenceRepository->findWithoutFail($id);

        if (empty($absence)) {
            Flash::error('Absence not found');

            return redirect(route('absences.index'));
        }
        $absence->justification = $request->input('justification');
        $absence->justify = (int)$request->input('justify');
        $absence->save();
        Flash::success('Absence updated successfully.');

        return redirect(route('absences.etat'));
    }

    /**
     * Remove the specified Absence from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $absence = $this->absenceRepository->findWithoutFail($id);

        if (empty($absence)) {
            Flash::error('Absence not found');

            return redirect(route('absences.index'));
        }

        $this->absenceRepository->delete($id);

        Flash::success('Absence deleted successfully.');

        return redirect(route('absences.index'));
    }

    public function test(){
        $apprenant = $this->apprenantRepository->all();

        return view('DataTables.test', compact('apprenant'));
    }
}
