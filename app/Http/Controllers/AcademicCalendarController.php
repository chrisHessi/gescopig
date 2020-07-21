<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear;
use App\Models\AcademicCalendar;
use App\Repositories\AcademicCalendarRepository;
use App\Repositories\SemestreRepository;
use Illuminate\Http\Request;

class AcademicCalendarController extends Controller
{
    protected $semestreRepository;
    protected $academicCalendarRepository;
    protected $academicYear;

    public function __construct(SemestreRepository $semestreRepository, AcademicCalendarRepository $academicCalendarRepository, AcademicYear $ay)
    {
        $this->academicYear = $ay::getCurrentAcademicYear();
        $this->academicCalendarRepository = $academicCalendarRepository;
        $this->semestreRepository = $semestreRepository;
    }

    public function index(){
        $calendars = $this->academicCalendarRepository->findWhere(['academic_year_id' => $this->academicYear]);
        return view('academicCalendars.index', compact('calendars'));
    }

    public function create(){
        $semestres = $this->semestreRepository->all();
        return view('academicCalendars.create', compact('semestres'));
    }

    public function store(Request $request){
        $semestres = $this->semestreRepository->all();
        foreach ($semestres as $semestre){
            if ($request->input('dateDebutPrevue'.$semestre->id)!= null) {
                $calendar = $this->academicCalendarRepository->updateOrCreate(
                    [
                        'semestre_id' => $semestre->id,
                        'academic_year_id' => $this->academicYear
                    ],
                    [
                        'dateDebutPrevue' => $request->input('dateDebutPrevue' . $semestre->id),
                        'dateDebut' => $request->input('dateDebut' . $semestre->id),
                        'dateFinPrevue' => $request->input('dateFinPrevue' . $semestre->id),
                    ]
                );
            }
        }
        return redirect()->route('academicCalendars.index');
    }

    public function edit($id){
        $calendar = $this->academicCalendarRepository->findWithoutFail($id);
        return view('academicCalendars.edit', compact('calendar'));
    }

    public function update($id, Request $request){
        $calendar= $this->academicCalendarRepository->findWithoutFail($id);

        if (empty($calendar)) {
            Flash::error('Semestre not found');

            return redirect(route('academicCalendars.index'));
        }

        $calendar = $this->academicCalendarRepository->update($request->all(), $id);

        return redirect()->route('academicCalendars.index');
    }
}
