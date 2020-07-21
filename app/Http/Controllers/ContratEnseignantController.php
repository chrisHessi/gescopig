<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear;
use App\Repositories\ContratEnseignantRepository;
use App\Repositories\EnseignantRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ContratEnseignantController extends Controller
{

    protected $contratEnseignantRepository;
    protected $academicYear;
    protected $enseignantRepository;

    public function __construct(ContratEnseignantRepository $contratEnseignantRepository, EnseignantRepository $enseignantRepository, AcademicYear $ay)
    {
        $this->contratEnseignantRepository = $contratEnseignantRepository;
        $this->academicYear = $ay::getCurrentAcademicYear();
        $this->enseignantRepository = $enseignantRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contrats = $this->contratEnseignantRepository->findWhere(['academic_year_id' => $this->academicYear]);

        return view('contratEnseignants.index', compact('contrats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $contrats = $this->contratEnseignantRepository->findWhere(['academic_year_id' => $this->academicYear]);
        $ens=[];
        foreach($contrats as $contrat){
            array_push($ens,$contrat->enseignant_id);
        }

        $enseignants = $this->enseignantRepository
            ->orderBy('id', 'desc')
            ->findWhereNotIn('id', $ens);

        return view('contratEnseignants.create', compact('enseignants'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save($id)
    {
        $enseignant = $this->enseignantRepository->findWithoutFail($id);
        if (empty($enseignant)) {
            Flash::error('Enseignant not found');

            return redirect(route('contratEnseignants.create'));
        }
        $contrat = $this->contratEnseignantRepository->create(['enseignant_id' => $id, 'academic_year_id' => $this->academicYear]);
        Flash::success('Contrat de l\'Enseignant enregistré avec succès.');

        return redirect(route('contratEnseignants.index'));
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contrat = $this->contratEnseignantRepository->findWithoutFail($id);
        if (empty($contrat) || $contrat->enseignements->count()) {
            Flash::error('Impossible d\'effacer le contrat');

            return redirect(route('contratEnseignants.index'));
        }

        $this->contratEnseignantRepository->delete($id);
        Flash::success('Contrat supprimé avec succes');
        return redirect(route('contratEnseignants.index'));
    }
}
