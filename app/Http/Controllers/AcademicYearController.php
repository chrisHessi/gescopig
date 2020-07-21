<?php

namespace App\Http\Controllers;

use App\Repositories\AcademicYearRepository;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    protected $academicYearRepository;

    public function __construct(AcademicYearRepository $academicYearRepository)
    {
        $this->academicYearRepository = $academicYearRepository;
    }

    public function index(){
        $academicYears = $this->academicYearRepository->all();
        return view('academicYears.index', compact('academicYears'));
    }

    public function create(){
        return view('academicYears.create');
    }

    public function store(Request $request){
        if ($request->input('actif')){
            $actif = $this->academicYearRepository->findWhere(['actif' => true])->first();
            $actif->actif = false;
            $actif->save();
        }
        $academicYear = $this->academicYearRepository->updateOrCreate([
            'debut'=>$request->input('debut')
        ],$request->all());

        return redirect()->route('academicYears.index');
    }

    public function activate($id){
        $academicYear = $this->academicYearRepository->findWithoutFail($id);
    }

    public function edit($id){
        $academicYear = $this->academicYearRepository->findWithoutFail($id);
        return view('academicYears.create', compact('academicYear'));
    }

}
