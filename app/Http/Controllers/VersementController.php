<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear as AnneeAcademic;
use App\Http\Requests\CreateVersementRequest;
use App\Models\AcademicYear;
use App\Repositories\ApprenantRepository;
use App\Repositories\ContratRepository;
use App\Repositories\VersementRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class VersementController extends Controller
{
    protected $contratRepository;
    protected $versementRepository;
    protected $anneeAcademic;
    protected $apprenantRepository;


    public function __construct(ContratRepository $contratRepository,ApprenantRepository $apprenantRepository, VersementRepository $versementRepository, AnneeAcademic $academicYear){
        $this->contratRepository = $contratRepository;
        $this->versementRepository = $versementRepository;
        $this->anneeAcademic = AcademicYear::find($academicYear->getCurrentAcademicYear());
        $this->apprenantRepository = $apprenantRepository;
    }

    public function listeApprenants(){
        $apprenants = $this->apprenantRepository->all();
        return view('versements.apprenants', compact('apprenants'));
    }

    public function store(CreateVersementRequest $request, $reincription){
//        if($reincription && $request->input('apprenant_id')){
//            $apprenant = $this->apprenantRepository->findWithoutFail($request->input('apprenant_id'));
//            $specialite = $apprenant->contrats->last()->specialite_id;
//            $cycle = $apprenant->contrats->last()->resultatNominatif->cycle;
//            $contrat = $this->contratRepository->create([
//                'apprenant_id' => $apprenant->id,
//                'specialite_id' => $specialite,
//                'cycle_id' => $cycle->id,
//                'academic_year_id' => $this->anneeAcademic,
//                'type' => 'Reinscription',
//                'state' => 'Etabli'
//            ]);
//            $versement = $this->versementRepository->create([
//                'contrat_id' => $contrat->id,
//                'montant' => $request->input('montant'),
//                'motif' => $request->input('motif')
//            ]);
//
//            return redirect()->route('versements.listeApprenants');
//        }
        $versement = $this->versementRepository->create($request->all());
        return redirect()->back();
    }

    public function details($id){
        $apprenant = $this->apprenantRepository->findWithoutFail($id);
        $academicYear = $this->anneeAcademic;
        $reinscription = false;
        //Si l'apprenant n'a pas de contrat cette annee là ca signifie que c'est un ancien qui effectue son premier versement
        if (!isset($apprenant->contrats->where('academic_year_id', $academicYear->id)->map)){
            $reinscription = true;
        }
        return view('versements.details', compact('apprenant', 'academicYear', 'reinscription'));
    }

    public function show($id){
        $contrat = $this->contratRepository->findWithoutFail($id);
        return view('versements.show', compact('contrat'));
    }

    public function edit($id){
        $versement = $this->versementRepository->findWithoutFail($id);
        return view('versements.edit', compact('versement'));
    }

    public function update(Request $request, $id){
        $versement = $this->versementRepository->findWithoutFail($id);
        if (!isset($versement)){
            Flash::error('Versement nnon existant');
            return redirect()->route('versements.show', [$versement->contrat->id]);
        }
        $this->versementRepository->update($request->all(), $id);
        return redirect()->route('versements.show', [$versement->contrat->id]);
    }

    public function destroy($id){
        $versement = $this->versementRepository->findWithoutFail($id);
        $contrat = $versement->contrat;
        $this->versementRepository->delete($id);
        return redirect()->route('versements.show', [$contrat->id]);
    }

}
