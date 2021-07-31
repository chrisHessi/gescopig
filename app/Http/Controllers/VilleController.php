<?php

namespace App\Http\Controllers;

use App\Repositories\VilleRepository;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    protected $villeRepository;

    public function __construct(VilleRepository $villeRepository)
    {
        $this->villeRepository = $villeRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ville = $this->villeRepository->all();

        return view('ville.index', compact('ville'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ville.create');
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

        Flash::success('La ville '. $ville->nom. ' a été créé avec succès');

        return redirect(route('ville.index'));
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
            Flash::error('Ce ville n\'existe plus en base de données');

            return redirect(route('ville.index'));
        }
        return view('ville.edit', compact('ville'));
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

        Flash::success('Le pays'. $ville->nom. ' a été mis à jour avec succès.');

        return redirect(route('ville.index'));
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

        $ville = $this->villeRepository->delete($id);
        Flash::success('Le pays'. $ville->nom. ' a été supprimé avec succès.');

        return redirect(route('ville.index'));
    }
}
