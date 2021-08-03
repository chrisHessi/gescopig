<?php

namespace App\Http\Controllers;

use App\Repositories\PaysRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class PaysController extends Controller
{
    protected $paysRepository;

    public function __construct(PaysRepository $paysRepository)
    {
        $this->paysRepository = $paysRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pays = $this->paysRepository->all();

        return view('pays.index', compact('pays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pays.create');
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

        $pays = $this->paysRepository->create($input);

        Flash::success('Le pays ' . $pays->nom . ' a été créé avec succès');

        return redirect(route('pays.index'));
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
        $pays = $this->paysRepository->find($id);
        if (empty($pays)) {
            Flash::error('Ce pays n\'existe plus en base de données');

            return redirect(route('pays.index'));
        }
        return view('pays.edit', compact('pays'));
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
        $pays = $this->paysRepository->find($id);
        if (empty($pays)) {
            Flash::error('Ce pays n\'existe plus en base de données');

            return redirect(route('pays.index'));
        }

        $pays = $this->paysRepository->update($request->all(), $id);

        Flash::success('Ce pays a été mis à jour avec succès.');

        return redirect(route('pays.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pays = $this->paysRepository->find($id);
        if (empty($pays)) {
            Flash::error('Ce pays n\'existe plus en base de données');

            return redirect(route('pays.index'));
        }

        $paysName = $pays->nom;
        $pays = $this->paysRepository->delete($id);

        Flash::success('Le pays "' . $paysName . '" a été supprimé avec succès.');

        return redirect(route('pays.index'));
    }
}
