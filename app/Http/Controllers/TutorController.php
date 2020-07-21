<?php

namespace App\Http\Controllers;

use App\Repositories\ApprenantRepository;
use App\Repositories\TutorRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class TutorController extends Controller
{
    protected $apprenantRepository;
    protected $tutorRepository;

    public function __construct(ApprenantRepository $apprenantRepository, TutorRepository $tutorRepository){
        $this->apprenantRepository = $apprenantRepository;
        $this->tutorRepository = $tutorRepository;
    }

    public function index($id){
        $apprenant = $this->apprenantRepository->findWithoutFail($id);
        $tutors = $this->tutorRepository->findWhere(['apprenant_id' => $apprenant->id]);
        return view('tutors.index', compact('tutors'));
    }

    public function create($id){
        $apprenant = $this->apprenantRepository->findWithoutFail($id);
        return view('tutors.create', compact('apprenant'));
    }

    public function store(Request $request, $id){
        $apprenant = $this->apprenantRepository->findWithoutFail($id);
        $tutor = $this->tutorRepository->create([$request->all(), 'apprenant_id'=>$id]);
        return redirect()->route('tutors.index', [$apprenant->id]);
    }

    public function edit($id){
        $tutor = $this->tutorRepository->findWithoutFail($id);

        if (empty($tutor)){
            Flash::error('Parent inexistant');

            return redirect(route('tutors.index'));
        }
        return view('tutors.edit', compact('tutor'));
    }

    public function update($id, Request $request){
        $tutor = $this->tutorRepository->findWithoutFail($id);

        if (empty($tutor)){
            Flash::error('Parent inexistant');

            return redirect(route('tutors.index'));
        }

        $tutor = $this->tutorRepository->update($request->all(), $id);
        Flash::success('Parent modifié avec succès');
        return redirect(route('tutors.index', [$tutor->apprenant->id]));
    }

    public function destroy($id){
        $tutor = $this->tutorRepository->findWithoutFail($id);

        if (empty($tutor)) {
            Flash::error('Parent non existant');

            return redirect(route('tutors.index', [$tutor->apprenant->id]));
        }
        $this->tutorRepository->delete($id);
        Flash::success('Parent effacé avec succès.');
        return redirect(route('tutors.index', [$tutor->apprenant->id]));
    }
}
