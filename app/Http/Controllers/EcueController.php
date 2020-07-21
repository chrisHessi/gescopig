<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear;
use App\Http\Requests\CreateEcueRequest;
use App\Http\Requests\UpdateEcueRequest;
use App\Models\Ecue;
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

    public function __construct(EcueRepository $ecueRepo, SemestreRepository $semestreRepository,UeRepository $ueRepository, AcademicYear $ay, SpecialiteRepository $specialiteRepository)
    {
        $this->ecueRepository = $ecueRepo;
        $this->semestreRepository = $semestreRepository;
        $this->specialiteRepository = $specialiteRepository;
        $this->ueRepository = $ueRepository;
        $this->academicYear = $ay::getCurrentAcademicYear();
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
        $ecues = $this->ecueRepository->findWhere(['academic_year_id' => $this->academicYear]);;
//        $ecues = Ecue::withTrashed()->get();
//        foreach ($ecues as $ecue){
//            $ecue->academic_year_id = $this->academicYear;
//            $ecue->save();
//        }
//        dd($ecues);
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
        $ecues = $this->ecueRepository->findWhere(['academic_year_id' => $this->academicYear]);
        $specialiteEcue = null;
        $semestres = array();

        foreach($sem as $semestre){
            $semestres[$semestre->id] = $semestre->title. ' - ' . $semestre->cycle->label;
        }


        return view('ecues.create', compact('semestres', 'specialites', 'specialiteEcue', 'ecues'));
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
        $input['academic_year_id'] = $this->academicYear;
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

        foreach($sem as $semestre){
            $semestres[$semestre->id] = $semestre->title. ' - ' . $semestre->cycle->label;
        }

        if (empty($ecue)) {
            Flash::error('Ecue not found');

            return redirect(route('ecues.index'));
        }

        return view('ecues.edit', compact('ecue', 'specialites', 'semestreEcue', 'semestres'));
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
