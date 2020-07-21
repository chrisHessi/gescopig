<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear;
use App\Repositories\AcademicYearRepository;
use App\Repositories\CycleRepository;
use App\Repositories\EcheancierRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class EcheancierController extends Controller
{
    protected $echeancierRepository;
    protected $anneeAcademic;
    protected $academicYearRepository;
    protected $cycleRepository;

    public function __construct(EcheancierRepository $echeancierRepository, AcademicYear $academicYear,
                                AcademicYearRepository $academicYearRepository, CycleRepository $cycleRepository)
    {
        $this->echeancierRepository = $echeancierRepository;
        $this->anneeAcademic = $academicYear->getCurrentAcademicYear();
        $this->cycleRepository = $cycleRepository;
        $this->academicYearRepository = $academicYearRepository;
    }

    public function index(){
        $echeanciers = $this->echeancierRepository->all();
//        dd($echeanciers);
        return view('echeanciers.index', compact('echeanciers'));
    }

    public function create(){
        $c = $this->cycleRepository->all();
        $cycles = array();
        foreach($c as $cycle){
            $cycles[$cycle->id] = $cycle->label. ' ' .$cycle->niveau;
        }
        $a = $this->academicYearRepository->all();
//        dd($a);
        $academicYears = [];
        foreach($a as $acad){
            $academicYears[$acad->id] = $acad->debut. '/' .$acad->fin;
        }

        return view('echeanciers.create', compact('cycles', 'academicYears'));
    }

    public function store(Request $request){
        $echeanciers = $this->echeancierRepository->create($request->all());
        return redirect()->route('echeanciers.index');
    }

    public function edit($id){
        $echeancier = $this->echeancierRepository->findWithoutFail($id);
        $c = $this->cycleRepository->all();
        $cycles = array();

        foreach($c as $cycle){
            $cycles[$cycle->id] = $cycle->label. ' ' .$cycle->niveau;
        }
        $a = $this->academicYearRepository->all();
        $academicYears = [];
        foreach($a as $acad){
            $academicYears[$acad->id] = $acad->debut. '/' .$acad->fin;
        }

        return view('echeanciers.create', compact('cycles', 'echeancier', 'academicYears'));
    }

    public function update($id, Request $request){
        $echeancier = $this->echeancierRepository->findWithoutFail($id);

        if (empty($echeancier)) {
            Flash::error('Echeancier not found');

            return redirect(route('echeanciers.index'));
        }

        $echeancier = $this->echeancierRepository->update($request->all(), $id);
        Flash::success('Echeancier updated successfully.');
        return redirect()->route('echeanciers.index');
    }

    public function destroy($id){
        $echeancier = $this->echeancierRepository->findWithoutFail($id);
        if (empty($echeancier)) {
            Flash::error('Echeancier not found');

            return redirect(route('absences.index'));
        }
        $this->echeancierRepository->delete($id);
        Flash::success('Echeancier deleted successfully.');
        return redirect(route('echeanciers.index'));
    }
}
