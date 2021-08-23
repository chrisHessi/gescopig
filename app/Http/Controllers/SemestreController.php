<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear;
use App\Http\Requests\CreateSemestreRequest;
use App\Http\Requests\UpdateSemestreRequest;
use App\Models\Cycle;
use App\Repositories\AcademicCalendarRepository;
use App\Repositories\AcademicYearRepository;
use App\Repositories\CycleRepository;
use App\Repositories\SemestreRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use NumberFormatter;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SemestreController extends AppBaseController
{
    /** @var  SemestreRepository */
    private $semestreRepository;
    protected $cycleRepository;
    protected $academicCalendarRepository;
    protected $academicYear;


    public function __construct(SemestreRepository $semestreRepo, CycleRepository $cycleRepository, AcademicCalendarRepository $academicCalendarRepository, AcademicYear $ay)
    {
        $this->semestreRepository = $semestreRepo;
        $this->cycleRepository = $cycleRepository;
        $this->academicCalendarRepository = $academicCalendarRepository;
        $this->academicYear = $ay::getCurrentAcademicYear();
    }

    /**
     * Display a listing of the Semestre.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->semestreRepository->pushCriteria(new RequestCriteria($request));
        $semestres = $this->semestreRepository->all();
        $calendars = $this->academicCalendarRepository->findWhere(['academic_year_id' => $this->academicYear]);

        return view('semestres.index', compact('semestres', 'calendars'));
    }

    /**
     * Show the form for creating a new Semestre.
     *
     * @return Response
     */
    public function create()
    {
        $c = $this->cycleRepository->all();
        $cycle = array();

        foreach($c as $cycles){
            $cycle[$cycles->id] = $cycles->slug;
        }
        return view('semestres.create')->with('cycle', $cycle);
    }

    /**
     * Store a newly created Semestre in storage.
     *
     * @param CreateSemestreRequest $request
     *
     * @return Response
     */
    public function store(CreateSemestreRequest $request)
    {
        $input = $request->only('title','cycle_id', 'suffixe', 'mhSemaine');
        $calendar_input = $request->except('title','cycle_id', 'suffixe', 'mhSemaine');
        $calendar_input['academic_year_id'] = $this->academicYear;

        $semestre = $this->semestreRepository->create($input);
        $calendar = $this->academicCalendarRepository->updateOrCreate([
            'academic_year_id' => $this->academicYear,
            'semestre_id' => $semestre->id
            ], $calendar_input);
        Flash::success('Semestre saved successfully.');

        return redirect(route('semestres.index'));
    }

    /**
     * Display the specified Semestre.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $semestre = $this->semestreRepository->findWithoutFail($id);

        if (empty($semestre)) {
            Flash::error('Semestre not found');

            return redirect(route('semestres.index'));
        }

        return view('semestres.show')->with('semestre', $semestre);
    }

    /**
     * Show the form for editing the specified Semestre.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $semestre = $this->semestreRepository->findWithoutFail($id);
        $calendar = $semestre->academic_calendars->where('academic_year_id', $this->academicYear);
        $c = $this->cycleRepository->all();
        $cycle = array();

        foreach($c as $cycles){
            $cycle[$cycles->id] = $cycles->slug;
        }

        if (empty($semestre)) {
            Flash::error('Semestre not found');

            return redirect(route('semestres.index'));
        }

        return view('semestres.edit')->with(['calendar' => $calendar, 'cycle' => $cycle]);
    }

    /**
     * Update the specified Semestre in storage.
     *
     * @param  int              $id
     * @param UpdateSemestreRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSemestreRequest $request)
    {
        $semestre = $this->semestreRepository->findWithoutFail($id);

        if (empty($semestre)) {
            Flash::error('Semestre not found');

            return redirect(route('semestres.index'));
        }

        $semestre = $this->semestreRepository->update($request->all(), $id);

        Flash::success('Semestre updated successfully.');

        return redirect(route('semestres.index'));
    }

    /**
     * Remove the specified Semestre from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $semestre = $this->semestreRepository->findWithoutFail($id);

        if (empty($semestre)) {
            Flash::error('Semestre not found');

            return redirect(route('semestres.index'));
        }

        $this->semestreRepository->delete($id);

        Flash::success('Semestre deleted successfully.');

        return redirect(route('semestres.index'));
    }
}
