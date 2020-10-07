<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear as Inscrip;
use App\Http\Requests\ContratRequest;
use App\Http\Requests\UpdateContratRequest;
use App\Models\AcademicYear;
use App\Models\Contrat;
use App\Repositories\AcademicYearRepository;
use App\Repositories\ApprenantRepository;
use App\Repositories\ContratRepository;
use App\Repositories\CycleRepository;
use App\Repositories\SpecialiteRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ContratController extends Controller
{
    protected $apprenantRepository;
    protected $specialiteRepository;
    protected $cycleRepository;
    protected $anneeAcademique;
    protected $contratRepository;
    protected $academicYearRepository;

    public function __construct(ContratRepository $contratRepository, AcademicYearRepository $academicYearRepository ,ApprenantRepository $apprenantRepository, SpecialiteRepository $specialiteRepository, CycleRepository $cycleRepository)
    {
        $this->contratRepository = $contratRepository;
        $this->apprenantRepository = $apprenantRepository;
        $this->specialiteRepository = $specialiteRepository;
        $this->cycleRepository = $cycleRepository;
        $inscrip = Inscrip::getCurrentAcademicYear();
        $this->anneeAcademique = AcademicYear::find($inscrip);
        $this->academicYearRepository = $academicYearRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contrats = Contrat::where('academic_year_id', '>=', $this->anneeAcademique->id)->get();
        return view('contrats.index', compact('contrats'));
    }

    public function all(){
        $contrats = $this->contratRepository->all();
        return view('contrats.all', compact('contrats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = $this->academicYearRepository->orderBy('id', 'desc')->first();
        $contrats = $this->contratRepository->findWhere(['academic_year_id' => $years->id]);

        $app=[];
        foreach($contrats as $contrat){
            array_push($app,$contrat->apprenant_id);
        }

        $apprenants = $this->apprenantRepository
            ->orderBy('id', 'desc')
            ->findWhereNotIn('id', $app); // on retrouve tous les apprenants qui n'ont pas encore de contrats dans la base de données
        $spe = $this->specialiteRepository->all();
        $c = $this->cycleRepository->all();
        $cycles = array();
        $specialites = array();
        $academicYears = [];
        $ay = $this->academicYearRepository->all();
        foreach ($ay as $a){
            $academicYears[$a->id] = $a->debut.'/'.$a->fin;
        }

        foreach($c as $cycle){
            $specialites[$cycle->label] = $cycle->specialites->pluck('title', 'id')->toArray();
        }

        foreach($c as $cycle){
            $cycles[$cycle->id] = $cycle->label. ' ' .$cycle->niveau;
        }
        return view('contrats.create', compact('apprenants', 'specialites', 'cycles', 'academicYears'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContratRequest $request)
    {
        $apprenant = $this->apprenantRepository->findWithoutFail($request->get('apprenant_id'));
        $type = 'Reinscription';
        $statut = 'Etabli';
        $input = $request->all();
        $input['type'] = $type;
        $input['state'] = $statut;

        $contrat = $this->contratRepository->updateOrCreate(
            [
                'apprenant_id' => $apprenant->id,
                'academic_year_id' => $request->input('academic_year_id'),
            ],
            $input
        );

        Flash::success('Apprenant saved successfully.');

        return redirect(route('contrats.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contrat $contrat)
    {
        $apprenants = $this->apprenantRepository->orderBy('id', 'desc')->paginate(3);
        $spe = $this->specialiteRepository->all();
        $c = $this->cycleRepository->all();
        $cycles = array();
        $specialites = array();
        $academicYears = [];
        $ay = $this->academicYearRepository->all();
        foreach ($ay as $a){
            $academicYears[$a->id] = $a->debut.'/'.$a->fin;
        }
        foreach($c as $cycle){
            $specialites[$cycle->label] = $cycle->specialites->pluck('title', 'id')->toArray();
        }

        foreach($c as $cycle){
            $cycles[$cycle->id] = $cycle->label. ' ' .$cycle->niveau;
        }

        return view('contrats.edit', compact('contrat', 'cycles', 'apprenants', 'specialites', 'academicYears'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContratRequest $request, Contrat $contrat)
    {
        $this->contratRepository->update($request->all(),$contrat->id);
        return redirect(route('contrats.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contrat $contrat)
    {
        $this->contratRepository->delete($contrat->id);
        return redirect()->route('contrats.index');
    }
}
