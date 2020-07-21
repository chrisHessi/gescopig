<?php

namespace App\Http\Controllers;

use App\Repositories\ApprenantRepository;
use App\Repositories\ContratRepository;
use App\Repositories\CorkageRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class CorkageController extends Controller
{
    protected $contratRepository;
    protected $corkageRepository;
    protected $apprenantRepository;


    public function __construct(ContratRepository $contratRepository, CorkageRepository $corkageRepository, ApprenantRepository $apprenantRepository)
    {
        $this->contratRepository = $contratRepository;
        $this->corkageRepository = $corkageRepository;
        $this->apprenantRepository = $apprenantRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apprenants = $this->apprenantRepository->all();
        return view('corkages.index', compact('apprenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $apprenant = $this->apprenantRepository->findWithoutFail($id);
        if (empty($apprenant)) {
            Flash::error('Apprenant not found');

            return redirect(route('corkages.index'));
        }

        return view('corkages.create',compact('apprenant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $contrat = $request->input('contrat_id');
        $title = $request->input('title');
        $montant = $request->input('montant');
        $reduction = $request->input('reduction');
        $corkage = $this->corkageRepository->create(['contrat_id' => $contrat,'title' => $title, 'montant' => ($reduction) ? -$montant : $montant, 'reduction' => $reduction]);
        Flash::success('Frais accesoire enregistré avec succes');
        return redirect()->route('corkages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apprenant = $this->apprenantRepository->findWithoutFail($id);
        if (empty($apprenant)) {
            Flash::error('Apprenant not found');

            return redirect(route('corkages.index'));
        }

        return view('corkages.show', compact('apprenant'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $corkage = $this->corkageRepository->findWithoutFail($id);
        if (empty($corkage)) {
            Flash::error('Frais innexistant en base');

            return redirect(route('corkages.index'));
        }

        return view('corkages.edit', compact('corkage'));
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
        $corkage = $this->corkageRepository->findWithoutFail($id);
        if (empty($corkage)) {
            Flash::error('Frais innexistant en base');

            return redirect(route('corkages.index'));
        }
        $title = $request->input('title');
        $montant = $request->input('montant');
        $reduction = $request->input('reduction');
        $input = ['title' => $title, 'montant' => ($reduction) ? -$montant : $montant, 'reduction' => $reduction];
        $this->corkageRepository->update($input,$id);

        return redirect()->route('corkages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $corkage = $this->corkageRepository->findWithoutFail($id);
        if (empty($corkage)) {
            Flash::error('Frais innexistant en base');

            return redirect(route('corkages.index'));
        }
        $this->corkageRepository->delete($id);

        return redirect()->route('corkages.show', [$corkage->contrat->apprenant->id]);
    }
}
