<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear;
use App\Models\AcademicCalendar;
use App\Repositories\AcademicCalendarRepository;
use App\Repositories\AcademicYearRepository;
use App\Repositories\SemestreRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class AcademicCalendarController extends Controller
{
    protected $semestreRepository;
    protected $academicCalendarRepository;
    protected $academicYear;
    protected $academicYearRepository;

    public function __construct(SemestreRepository $semestreRepository, AcademicYearRepository $academicYearRepository, AcademicCalendarRepository $academicCalendarRepository, AcademicYear $ay)
    {
        $this->academicYear = $ay::getCurrentAcademicYear();
        $this->academicCalendarRepository = $academicCalendarRepository;
        $this->semestreRepository = $semestreRepository;
        $this->academicYearRepository = $academicYearRepository;
    }

    public function index(){
        $calendars = AcademicCalendar::where('academic_year_id', '>=', $this->academicYear)->get();
        return view('academicCalendars.index', compact('calendars'));
    }

    public function create(){
        $semestres = $this->semestreRepository->all();
        $academicYears = [];
        $ay = $this->academicYearRepository->all();
        foreach ($ay as $a){
            $academicYears[$a->id] = $a->debut.'/'.$a->fin;
        }
        return view('academicCalendars.create', compact('semestres', 'academicYears'));
    }

    public function store(Request $request){
        if ($request->input('academic_year_id') != null){
            Flash::error('Veuillez renseigner l\année académique concernée');
            return redirect()->back();
        }
        $semestres = $this->semestreRepository->all();
        foreach ($semestres as $semestre){
            if ($request->input('dateDebutPrevue'.$semestre->id)!= null) {
                $calendar = $this->academicCalendarRepository->updateOrCreate(
                    [
                        'semestre_id' => $semestre->id,
                        'academic_year_id' => $request->input('academic_year_id')
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
