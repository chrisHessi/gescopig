<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUeRequest;
use App\Repositories\CatUeRepository;
use App\Repositories\UeRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class UeController extends Controller
{

    protected $ueRepository, $catUeRepository;

    public function __construct(UeRepository $ueRepository, CatUeRepository $catUeRepository)
    {
        $this->ueRepository = $ueRepository;
        $this->catUeRepository = $catUeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ues = $this->ueRepository->all();

        return view('ues.index', compact('ues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cues = $this->catUeRepository->all();
        $ues = $this->ueRepository->all();

        $catUes = [];

        foreach($cues as $cue){
            $catUes[$cue->id] = $cue->title;
        }

        return view('ues.create', compact('catUes', 'ues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUeRequest $request)
    {
        $this->ueRepository->create($request->all());

        Flash::success('Unité d\'enseignement créée avec succès');

        return redirect(route('ues.index'));
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
        $ue = $this->ueRepository->findWithoutFail($id);
        $ues = $this->ueRepository->all();
        $cues = $this->catUeRepository->all();

        $catUes = [];

        foreach($cues as $cue){
            $catUes[$cue->id] = $cue->title;
        }

        return view('ues.edit', compact('ue', 'catUes', 'ues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUeRequest $request, $id)
    {
        $ue = $this->ueRepository->findWithoutFail($id);

        if (empty($ue)) {
            Flash::error('Uniite d\'enseignement demandée n\'existe pas');

            return redirect(route('ues.index'));
        }

        $ue= $this->ueRepository->update($request->all(), $id);
        Flash::success('Uniite d\'enseignement mise à jour qvec succès');
        return redirect(route('ues.index'));
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
