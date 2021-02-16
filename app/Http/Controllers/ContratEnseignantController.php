<?php

namespace App\Http\Controllers;

use App\Helpers\AcademicYear;
use App\Models\Enseignement;
use App\Models\TeacherPay;
use App\Models\TroncCommun;
use App\Repositories\ContratEnseignantRepository;
use App\Repositories\EnseignantRepository;
use App\Repositories\EnseignementRepository;
use App\Repositories\TeacherPayRepository;
use App\Repositories\EcueRepository;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ContratEnseignantController extends Controller
{

    protected $contratEnseignantRepository;
    protected $academicYear;
    protected $enseignantRepository;
    protected $teacherPayRepository;
    protected $ecueRepository;
    protected $enseignementRepository;

    public function __construct(ContratEnseignantRepository $contratEnseignantRepository, EcueRepository $ecueRepository,
     TeacherPayRepository $teacherPayRepository, EnseignantRepository $enseignantRepository, AcademicYear $ay, EnseignementRepository $enseignementRepository)
    {
        $this->contratEnseignantRepository = $contratEnseignantRepository;
        $this->academicYear = $ay::getCurrentAcademicYear();
        $this->enseignantRepository = $enseignantRepository;
        $this->teacherPayRepository = $teacherPayRepository;
        $this->ecueRepository = $ecueRepository;
        $this->enseignementRepository = $enseignementRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contrats = $this->contratEnseignantRepository->all();

//        foreach($contrats as $contrat){
//            foreach ($contrat->payments as $payment){
//                if($payment->enseignements->count() > 1){
//                    if(!$payment->tronc_commun){
//
//                        if ($payment->enseignements->where('tronc_commun_id', '<>', null)->count()){
//                            $tronc_commun = $payment->enseignements->where('tronc_commun_id', '<>', null)->first()->tronc_commun_id;
//                        }
//                        else {
//                            $tronc_commun = TroncCommun::create();
//                            $tronc_commun = $tronc_commun->id;
//                        }
//
//                        foreach ($payment->enseignements as $enseignement){
//                            $enseignement->tronc_commun_id = $tronc_commun;
//                            $enseignement->save();
//                        }
//
//                        $payment->tronc_commun = true;
//                        $payment->teachable_id = $tronc_commun;
//                        $payment->teachable_type = TroncCommun::class;
//                        $payment->save();
//                    }
//                }
//                else{
//                    if ($payment->enseignements->first()) {
//                        $payment->teachable_id = $payment->enseignements->first()->id;
//                        $payment->teachable_type = Enseignement::class;
//                        $payment->save();
//                    }
//                }
//            }
//        }

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

    public function store(Request $request){
        $input = $request->except('_token');
        $input['academic_year_id'] = $this->academicYear;
        $last_range = $this->contratEnseignantRepository->findWhere(['academic_year_id' => $this->academicYear])->last()->rang;
        $input['rang'] = $last_range + 1;
        $contrat = $this->contratEnseignantRepository->create($input);

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
        $contrat = $this->contratEnseignantRepository->findWithoutFail($id);
        if(empty($contrat)){
            Flash::error('Contrat inexistant');

            return redirect(route('contratEnseignants.index'));
        }
        return view('contratEnseignants.edit', compact('contrat'));
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
        $input = $request->only(['mh_licence', 'mh_master']);
        // dd($input);
        $contrat = $this->contratEnseignantRepository->findWithoutFail($id);

        if(empty($contrat)){
            Flash::error('Contrat inexistant');

            return redirect(route('contratEnseignants.index'));
        }
        $contrat->mh_licence = $input['mh_licence'];
        $contrat->mh_master = $input['mh_master'];
        $contrat->save();
        return redirect(route('contratEnseignants.index'));
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

    public function versements($id, Request $request){
//        $contrat = $this->contratEnseignantRepository->findWithoutFail($id);
        $type = $request->type;
        if($type){
            $teachable = TroncCommun::find($id);
            $contrat = $teachable->enseignements->first()->contratEnseignant;
        }
        else{
            $teachable = $this->enseignementRepository->findWithoutFail($id);
            $contrat = $teachable->contratEnseignant;
        }
        if(empty($teachable)){
            Flash::error('Ecue Incorect Veuillez choiser la bonne ecue');

            return redirect(route('contratEnseignants.index'));
        }

//        $ecues = [];
//
//        foreach ($contrat->enseignements as $enseignement) {
//            $ecues[$enseignement->ecue->id] = $enseignement->ecue;
//        }

        return view('contratEnseignants.versements', compact('teachable', 'type', 'contrat'));
    }

    public function save(Request $request, $id){
        $payment_input = $request->except('type');
        $teachable = $request->input('type') ? TroncCommun::find($id) : $this->enseignementRepository->findWithoutFail($id);

        $contrat = (int)$request->input('type') ? $teachable->enseignements->first()->contratEnseignant : $teachable->contratEnseignant;
        $payment_input['contrat_enseignant_id'] = $contrat->id;

        $payment = $this->teacherPayRepository->makeModel()->fill($payment_input);
        $t = $teachable->payments()->save($payment);

        Flash::success('Paiement enregistré avec succes.');

        return redirect(route('contratEnseignants.index'));
    }

    public function rapport($id){
        $contrat = $this->contratEnseignantRepository->findWithoutFail($id);

        if(empty($contrat)){
            Flash::error('Contrat inexistant');

            return redirect(route('contratEnseignants.index'));
        }
        $tronc_communs = [];
        foreach ($contrat->enseignements as $enseignement){
            if ($enseignement->tronc_commun_id != null)
                $tronc_communs[$enseignement->tronc_commun_id] = $enseignement->tronc_commun;
        }

        $payments = $this->teacherPayRepository->findWhere(['contrat_enseignant_id' => $contrat->id]);
        return view('contratEnseignants.rapport', compact('payments', 'contrat', 'tronc_communs'));
    }

    public function details($id, Request $request){
        $type = $request->type;
        $teachable = ($type) ? TroncCommun::find($id) : $this->enseignementRepository->findWithoutFail($id);

        return view('contratEnseignants.details', compact('teachable', 'type'));
    }

    public function contrat($id, Request $request){
        $contrat = $this->contratEnseignantRepository->findWithoutFail($id);
        $rang = 0;

        if ($contrat->rang == null){
            $last_range = $this->contratEnseignantRepository->findWhere(['academic_year_id' => $this->academicYear])->last()->rang;
            $rang = $last_range + 1;
        }

        if($rang != 0){
            $contrat->rang = $rang;
            $contrat->save();
        }

        if(empty($contrat)){
            Flash::error('Contrat inexistant');

            return redirect(route('contratEnseignants.index'));
        }
        $ecues = [];
        $signataire = $request->get('signataire');
//        dd($signataire);

        foreach ($contrat->enseignements as $enseignement) {
            $ecues[$enseignement->ecue->id] = $enseignement->ecue;
        }
        return view('contratEnseignants.contrat', compact('contrat', 'ecues', 'signataire'));
    }

    public function edit_payment($id){
        $payment = $this->teacherPayRepository->findWithoutFail($id);
        if (empty($payment)){
            Flash::error('Paiement inexistant');

            return redirect()-back();
        }
        return view('contratEnseignants.edit_payment', compact('payment'));
    }

    public function update_payment($id, Request $request){
        $payment = $this->teacherPayRepository->findWithoutFail($id);
        if (empty($payment)){
            Flash::error('Paiement inexistant');

            return redirect()-back();
        }
        $payment = $this->teacherPayRepository->update($request->all(), $id);

        return redirect(route('contratEnseignants.index'));
    }

    public function delete_payment($id){
        $payment = $this->teacherPayRepository->findWithoutFail($id);
        if (empty($payment)){
            Flash::error('Paiement inexistant');

            return redirect()-back();
        }
        $this->teacherPayRepository->delete($id);
        return redirect(route('contratEnseignants.index'));
    }
}
