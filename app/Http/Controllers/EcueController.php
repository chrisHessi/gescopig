<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear;
use App\Http\Requests\CreateEcueRequest;
use App\Http\Requests\UpdateEcueRequest;
use App\Models\Ecue;
use App\Models\TroncCommun;
use App\Repositories\AcademicYearRepository;
use App\Repositories\EcueRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SemestreRepository;
use App\Repositories\SpecialiteRepository;
use App\Repositories\UeRepository;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class EcueController extends AppBaseController
{
    /** @var  EcueRepository */
    private $ecueRepository;
    protected $semestreRepository;
    protected $specialiteRepository;
    protected $ueRepository;
    protected $academicYear;
    protected $academicYearRepository;

    public function __construct(EcueRepository $ecueRepo, AcademicYearRepository $academicYearRepository, SemestreRepository $semestreRepository,UeRepository $ueRepository, AcademicYear $ay, SpecialiteRepository $specialiteRepository)
    {
        $this->ecueRepository = $ecueRepo;
        $this->semestreRepository = $semestreRepository;
        $this->specialiteRepository = $specialiteRepository;
        $this->ueRepository = $ueRepository;
        $this->academicYear = $ay::getCurrentAcademicYear();
        $this->academicYearRepository = $academicYearRepository;
    }

    /**
     * Display a listing of the Ecue.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->ecueRepository->pushCriteria(new RequestCriteria($request));
        $ecues = Ecue::where('academic_year_id', '>=', $this->academicYear)->get();
        $ec = $this->ecueRepository->all();

        foreach ($ec as $ecue){
            if($ecue->enseignements->count() > 1) {
                if ($ecue->enseignements->where('tronc_commun_id', null)->count() > 0) {

                    $tronc_commun = ($ecue->enseignements->where('tronc_commun_id', '<>', null)->first()) ? $ecue->enseignements->where('tronc_commun_id', '<>', null)->first()->tronc_commun : TroncCommun::create();
                    foreach ($ecue->enseignements as $enseignement) {
                        $enseignement->tronc_commun_id = $tronc_commun->id;
                        $enseignement->save();
                    }
                }
                else {
                    $tronc_commun = $ecue->enseignements->where('tronc_commun_id', '<>', null)->first()->tronc_commun_id;
                    foreach ($ecue->enseignements->where('tronc_commun_id', '<>', null) as $enseignement){
                        $enseignement->tronc_commun_id = $tronc_commun;
                        $enseignement->save();
                    }
                }
            }
        }
        return view('ecues.index')
            ->with('ecues', $ecues);
    }

    /**
     * Show the form for creating a new Ecue.
     *
     * @return Response
     */
    public function create()
    {
        $sem = $this->semestreRepository->all();
        $specialites = $this->specialiteRepository->all();
        $ecues = Ecue::where('academic_year_id', $this->academicYear)->get();
        $specialiteEcue = null;
        $semestres = array();
        $ac = $this->academicYear;

        $academicYears = [];
        $ay = $this->academicYearRepository->all();
        foreach ($ay as $a){
            $academicYears[$a->id] = $a->debut.'/'.$a->fin;
        }

        foreach($sem as $semestre){
            $semestres[$semestre->id] = $semestre->title. ' - ' . $semestre->cycle->label;
        }


        return view('ecues.create', compact('semestres', 'specialites', 'specialiteEcue', 'ecues', 'academicYears', 'ac'));
    }

    public function getEcues($id){
        $academic_year = $this->academicYearRepository->findWithoutFail($id);
        if (empty($academic_year)) {
            Flash::error('Année academique non renseignée');

            return json_encode([
                'status' => false,
                'error' => ('Année academique non renseignée')
            ]);
        }
        $ecues = Ecue::where('academic_year_id', $academic_year->id)->get();
        return $ecues;
    }

    /**
     * Store a newly created Ecue in storage.
     *
     * @param CreateEcueRequest $request
     *
     * @return Response
     */
    public function store(CreateEcueRequest $request)
    {
        $ecueNb = $this->ecueRepository->all()->count() + 1;
        $slug = 'EC'. str_pad($ecueNb,3,0,STR_PAD_LEFT);
        $input = $request->except('specialite');
        $input['slug'] = $slug;
        $specialites= $request->input('specialite');

        $ecue = $this->ecueRepository->create($input);

        foreach($specialites as $specialite){
            $ecue->specialites()->attach($specialite);
        }

        Flash::success('Ecue saved successfully.');

        return redirect(route('ecues.index'));
    }

    /**
     * Display the specified Ecue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $ecue = $this->ecueRepository->findWithoutFail($id);

        if (empty($ecue)) {
            Flash::error('Ecue not found');

            return redirect(route('ecues.index'));
        }

        return view('ecues.show')->with('ecue', $ecue);
    }

    /**
     * Show the form for editing the specified Ecue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $ecue = $this->ecueRepository->findWithoutFail($id);
        $sem = $this->semestreRepository->all();
        $semestreEcue = $ecue->semestre->id;
        $specialites = $this->specialiteRepository->all();
        $semestres = array();

        $academicYears = [];
        $ay = $this->academicYearRepository->all();
        foreach ($ay as $a){
            $academicYears[$a->id] = $a->debut.'/'.$a->fin;
        }

        foreach($sem as $semestre){
            $semestres[$semestre->id] = $semestre->title. ' - ' . $semestre->cycle->label;
        }

        if (empty($ecue)) {
            Flash::error('Ecue not found');

            return redirect(route('ecues.index'));
        }

        return view('ecues.edit', compact('ecue', 'specialites', 'semestreEcue', 'semestres', 'academicYears'));
    }

    /**
     * Update the specified Ecue in storage.
     *
     * @param  int              $id
     * @param UpdateEcueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEcueRequest $request)
    {
        $input = $request->except('specialite');
        $specialite = $request->input('specialite');
        $ecue = $this->ecueRepository->findWithoutFail($id);


        if (empty($ecue)) {
            Flash::error('Ecue not found');

            return redirect(route('ecues.index'));
        }

        $ecue = $this->ecueRepository->update($input, $id);
        $ecue->specialites()->sync($specialite);


        Flash::success('Ecue updated successfully.');

        return redirect(route('ecues.index'));
    }

    /**
     * Remove the specified Ecue from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $ecue = $this->ecueRepository->findWithoutFail($id);

        if (empty($ecue)) {
            Flash::error('Ecue not found');

            return redirect(route('ecues.index'));
        }

        if($ecue->enseignements->count()){
            Flash::error('Supprimer d\'abord les enseignements liés à cet ecue');

            return redirect(route('ecues.index'));
        }
        $spec = [];
        foreach($ecue->specialites as $specialite){
            array_push($spec, $specialite->id);
        }
        $ecue->specialites()->detach($spec);

        $this->ecueRepository->delete($id);
        
        Flash::success('Ecue deleted successfully.');

        return redirect(route('ecues.index'));
    }
}
