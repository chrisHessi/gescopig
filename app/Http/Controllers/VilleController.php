<?php

namespace App\Http\Controllers;

use App\Repositories\PaysRepository;
use App\Repositories\VilleRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class VilleController extends Controller
{
    protected $villeRepository;
    protected $paysRepository;

    public function __construct(VilleRepository $villeRepository, PaysRepository $paysRepository)
    {
        $this->villeRepository = $villeRepository;
        $this->paysRepository = $paysRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villes = $this->villeRepository->all();

        return view('villes.index', compact('villes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pays = $this->paysRepository->all();

        $paysNames = [];

        foreach ($pays as $payi) {
            $paysNames[$payi->id] = $payi->nom;
        }

        return view('villes.create', compact("paysNames"));
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

        $ville = $this->villeRepository->create($input);

        Flash::success('La ville ' . $ville->nom . ' a été créé avec succès');

        return redirect(route('villes.index'));
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
        $ville = $this->villeRepository->find($id);
        if (empty($ville)) {
            Flash::error('Cette ville n\'existe plus en base de données');

            return redirect(route('ville.index'));
        }


        $pays = $this->paysRepository->all();

        $paysNames = [];

        foreach ($pays as $payi) {
            $paysNames[$payi->id] = $payi->nom;
        }
        return view('villes.edit', compact('ville', 'paysNames'));
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
        $ville = $this->villeRepository->find($id);
        if (empty($ville)) {
            Flash::error('Ce ville n\'existe plus en base de données');

            return redirect(route('ville.index'));
        }

        $ville = $this->villeRepository->update($request->all(), $id);

        Flash::success('La ville "' . $ville->nom . '" a été mis à jour avec succès.');

        return redirect(route('villes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ville = $this->villeRepository->find($id);
        if (empty($ville)) {
            Flash::error('Ce ville n\'existe plus en base de données');

            return redirect(route('ville.index'));
        }

        $villeNom = $ville->nom;
        $ville = $this->villeRepository->delete($id);
        Flash::success('La ville "' . $villeNom . '" a été supprimée avec succès.');

        return redirect(route('villes.index'));
    }
}
