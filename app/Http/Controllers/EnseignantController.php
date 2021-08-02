<?php

namespace App\Http\Controllers;

use App\DataTables\EnseignantDataTable;
use App\Helpers\AcademicYear;
use App\Http\Requests;
use App\Http\Requests\CreateEnseignantRequest;
use App\Http\Requests\UpdateEnseignantRequest;
use App\Models\Enseignement;
use App\Repositories\ContratEnseignantRepository;
use App\Repositories\EnseignantRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Response;

class EnseignantController extends AppBaseController
{
    /** @var  EnseignantRepository */
    private $enseignantRepository;
    protected $contratEnseignantRepository;
    protected $academicYear;

    public function __construct(EnseignantRepository $enseignantRepo, AcademicYear $ay, ContratEnseignantRepository $contratEnseignantRepository, Request $request)
    {
        if(request()->server("SCRIPT_NAME") !== 'artisan') {
            if ($request->route()->getName() == 'enseignants.store' || $request->route()->getName() == 'enseignants.create')
                $this->middleware(['permission:create enseignants|edit enseignants']);
            if ($request->route()->getName() == 'enseignants.index')
                $this->middleware(['permission:read enseignants']);
            if ($request->route()->getName() == 'enseignants.update' || $request->route()->getName() == 'enseignants.edit')
                $this->middleware(['permission:edit enseignants']);
        }
        $this->enseignantRepository = $enseignantRepo;
        $this->contratEnseignantRepository = $contratEnseignantRepository;
        $this->academicYear = $ay::getCurrentAcademicYear();
    }

    /**
     * Display a listing of the Enseignant.
     *
     * @param EnseignantDataTable $enseignantDataTable
     * @return Response
     */
    public function index(EnseignantDataTable $enseignantDataTable)
    {
        $enseignants = $this->enseignantRepository->all();
        $contrat= '';
//        foreach ($enseignants as $enseignant){
//            $contrat = $this->contratEnseignantRepository->create(['enseignant_id' => $enseignant->id, 'academic_year_id' => $this->academicYear]);
//        }
//        dd($contrat);
        return $enseignantDataTable->render('enseignants.index');
    }

    /**
     * Show the form for creating a new Enseignant.
     *
     * @return Response
     */
    public function create()
    {
        return view('enseignants.create');
    }

    /**
     * Store a newly created Enseignant in storage.
     *
     * @param CreateEnseignantRequest $request
     *
     * @return Response
     */
    public function store(CreateEnseignantRequest $request)
    {
        $input = $request->except(['mh_licence', 'mh_master']);

        $enseignant = $this->enseignantRepository->create($input);

        $last_range = $this->contratEnseignantRepository->findWhere(['academic_year_id' => $this->academicYear])->last()->rang;
        $rang = $last_range + 1;

        $contratInput = $request->only(['mh_licence', 'mh_master']);

        $contratInput['enseignant_id'] = $enseignant->id;
        $contratInput['academic_year_id'] = $this->academicYear;
        $contratInput['rang'] = $rang;

        $contrat = $this->contratEnseignantRepository->create($contratInput);

        Flash::success('Enseignant saved successfully.');

        return redirect(route('contratEnseignants.index'));
    }

    /**
     * Display the specified Enseignant.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $enseignant = $this->enseignantRepository->findWithoutFail($id);

        if (empty($enseignant)) {
            Flash::error('Enseignant not found');

            return redirect(route('enseignants.index'));
        }

        return view('enseignants.show')->with('enseignant', $enseignant);
    }

    /**
     * Show the form for editing the specified Enseignant.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $enseignant = $this->enseignantRepository->findWithoutFail($id);

        if (empty($enseignant)) {
            Flash::error('Enseignant not found');

            return redirect(route('enseignants.index'));
        }

        return view('enseignants.edit')->with('enseignant', $enseignant);
    }

    /**
     * Update the specified Enseignant in storage.
     *
     * @param  int              $id
     * @param UpdateEnseignantRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEnseignantRequest $request)
    {
        $enseignant = $this->enseignantRepository->findWithoutFail($id);

        if (empty($enseignant)) {
            Flash::error('Enseignant not found');

            return redirect(route('enseignants.index'));
        }

        $enseignant = $this->enseignantRepository->update($request->all(), $id);

        Flash::success('Enseignant updated successfully.');

        return redirect(route('enseignants.index'));
    }

    /**
     * Remove the specified Enseignant from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $enseignant = $this->enseignantRepository->findWithoutFail($id);

        if (empty($enseignant)) {
            Flash::error('Enseignant not found');

            return redirect(route('enseignants.index'));
        }

        $this->enseignantRepository->delete($id);

        Flash::success('Enseignant deleted successfully.');

        return redirect(route('enseignants.index'));
    }
}
