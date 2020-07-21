<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear as AnneeAcademic;
use App\Models\AcademicYear;
use App\Models\Moratoire;
use App\Repositories\ContratRepository;
use App\Repositories\MoratoireRepository;
use Illuminate\Http\Request;

class MoratoireController extends Controller
{

    protected $moratoireRepository;
    protected $contratRepository;
    protected $anneeAcademic;

    public function __construct(MoratoireRepository $moratoireRepository, ContratRepository $contratRepository, AnneeAcademic $academicYear)
    {
        $this->contratRepository = $contratRepository;
        $this->moratoireRepository = $moratoireRepository;
        $this->anneeAcademic = AcademicYear::find($academicYear::getCurrentAcademicYear());
    }

    public function index(){
        $contrats = $this->contratRepository->findWhere(['academic_year_id' => $this->anneeAcademic->id]);

        return view('moratoires.index', compact('contrats'));
    }

    public function create($id){
        $contrat = $this->contratRepository->findWithoutFail($id);
        return view('moratoires.create', compact('contrat'));
    }

    public function store($id, Request $request){
        $n = (int)$request->input('number');
        $contrat = $this->contratRepository->findWithoutFail($id);
        for($i=1; $i<=$n; $i++){
            $this->moratoireRepository->create([
                'contrat_id' => $contrat->id,
                'montant' => $request->input('montant'.$i),
                'date' => $request->input('date'.$i)
            ]);
        }
        $contrat->moratoire = true;
        $contrat->save();
        return redirect()->route('moratoires.index');
    }

    public function edit($id){
        $contrat = $this->contratRepository->findWithoutFail($id);
        $moratoires= [];
        $mors= $contrat->moratoires;
        foreach ($mors as $moratoire){
            $moratoires[] = $moratoire;
        }
        return view('moratoires.edit', compact('contrat', 'moratoires'));
    }

    public function update($id, Request $request){
        $contrat = $this->contratRepository->findWithoutFail($id);
        foreach ($contrat->moratoires as $moratoire){
            $moratoire->delete();
        }
        $n = (int)$request->input('number');
        for($i=1; $i<=$n; $i++){
            $this->moratoireRepository->create([
                'contrat_id' => $contrat->id,
                'montant' => $request->input('montant'.$i),
                'date' => $request->input('date'.$i)
            ]);
        }
        return redirect()->route('moratoires.index');
    }
}
