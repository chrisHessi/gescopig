<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSpecialiteRequest;
use App\Http\Requests\UpdateSpecialiteRequest;
use App\Repositories\CycleRepository;
use App\Repositories\SpecialiteRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class  SpecialiteController extends AppBaseController
{
    /** @var  SpecialiteRepository */
    private $specialiteRepository;
    protected $cycleRepository;

    public function __construct(SpecialiteRepository $specialiteRepo, CycleRepository $cycleRepository)
    {
        $this->specialiteRepository = $specialiteRepo;
        $this->cycleRepository = $cycleRepository;
    }

    /**
     * Display a listing of the Specialite.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->specialiteRepository->pushCriteria(new RequestCriteria($request));
        $specialites = $this->specialiteRepository->all();

        return view('specialites.index')
            ->with('specialites', $specialites);
    }

    public function getData(){
        $specialites = json_encode($this->specialiteRepository->all());

        return $specialites;

    }

    /**
     * Show the form for creating a new Specialite.
     *
     * @return Response
     */
    public function create()
    {
        $cycle = $this->cycleRepository->all();
//        $cycle = array();
//        foreach($c as $cycles){
//            $cycle[$cycles->id] = $cycles->label;
//        }
        return view('specialites.create',compact('cycle'));
    }

    /**
     * Store a newly created Specialite in storage.
     *
     * @param CreateSpecialiteRequest $request
     *
     * @return Response
     */
    public function store(CreateSpecialiteRequest $request)
    {
        $input = $request->only(['title','slug']);
        $cycles = $request->input('cycle');

        $specialite = $this->specialiteRepository->create($input);
        foreach($cycles as $cycle){
            $specialite->cycles()->attach($cycle);
        }

        Flash::success('Specialite saved successfully.');

        return redirect(route('specialites.index'));
    }

    /**
     * Display the specified Specialite.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $specialite = $this->specialiteRepository->findWithoutFail($id);

        if (empty($specialite)) {
            Flash::error('Specialite not found');

            return redirect(route('specialites.index'));
        }

        return view('specialites.show')->with('specialite', $specialite);
    }

    /**
     * Show the form for editing the specified Specialite.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $specialite = $this->specialiteRepository->findWithoutFail($id);
        $cycle = $this->cycleRepository->all();
        $cycleSpecialite = array();
        $i=0;

        foreach($specialite->cycles as $c) {
            $cycleSpecialite[$i] = $c->slug;
            $i++;
        }


        if (empty($specialite)) {
            Flash::error('Specialite not found');

            return redirect(route('specialites.index'));
        }

        return view('specialites.edit', compact('specialite', $specialite))->with(['cycle' => $cycle, 'cycleSpecialite' => $cycleSpecialite]);
    }

    /**
     * Update the specified Specialite in storage.
     *
     * @param  int              $id
     * @param UpdateSpecialiteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSpecialiteRequest $request)
    {
        $specialite = $this->specialiteRepository->findWithoutFail($id);
        $cycles = $request->input('cycle');
        $input = $request->only(['title', 'slug']);

        if (empty($specialite)) {
            Flash::error('Specialite not found');

            return redirect(route('specialites.index'));
        }

            $specialite->cycles()->sync($cycles);

        $specialite = $this->specialiteRepository->update($input, $id);

        Flash::success('Specialite updated successfully.');

        return redirect(route('specialites.index'));
    }

    /**
     * Remove the specified Specialite from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $specialite = $this->specialiteRepository->findWithoutFail($id);

        if (empty($specialite)) {
            Flash::error('Specialite not found');

            return redirect(route('specialites.index'));
        }

        $this->specialiteRepository->delete($id);

        Flash::success('Specialite deleted successfully.');

        return redirect(route('specialites.index'));
    }
}
