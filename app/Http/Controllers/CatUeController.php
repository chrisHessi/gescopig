<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCatUeRequest;
use App\Repositories\CatUeRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class CatUeController extends Controller
{
    protected  $catUeRepository;

    public function __construct(CatUeRepository $catUeRepository)
    {
        $this->catUeRepository = $catUeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catUes = $this->catUeRepository->all();

        return view('categoriesUe.index', compact('catUes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoriesUe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCatUeRequest $request)
    {
        $this->catUeRepository->create($request->all());

        Flash::success('Categorie Unité d\'enseignement créée avec succes');

        return redirect(route('catUes.index'));
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
        $catUe = $this->catUeRepository->findWithoutFail($id);

        if(empty($catUe)){
            Flash::error('Categorie UE non existante');
            return redirect(route('catUes.index'));
        }

        return view('categoriesUe.edit', compact('catUe'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCatUeRequest $request, $id)
    {
        $catUe = $this->catUeRepository->findWithoutFail($id);

        if(empty($catUe)){
            Flash::error('Categorie unite d\enseignement non existante');
            return redirect(route('catUes.index'));
        }

        $catUe = $this->catUeRepository->update($request, $id);
        Flash::success('Categorie Unité d\'enseignement mise a jour correctement');
        return redirect(route('categoriesUe.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
