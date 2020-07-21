<?php

namespace App\Repositories;

use App\Helpers\AcademicYear;
use App\Models\AcademicYear as AcademicYearModel;
use App\Models\Apprenant;
use App\Models\Tutor;
use Illuminate\Support\Facades\DB;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ApprenantRepository
 * @package App\Repositories
 * @version December 1, 2017, 10:57 pm UTC
 *
 * @method Apprenant findWithoutFail($id, $columns = ['*'])
 * @method Apprenant find($id, $columns = ['*'])
 * @method Apprenant first($columns = ['*'])
*/
class ApprenantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'tel',
        'specialite_id',
        'tel_parent'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Apprenant::class;
    }

    public function store($request){

        $apprenant = $this->create($this->getApprenantInput($request));
        $n = $request->input('number');
        for($i = 1; $i<=$n; $i++ ){
            Tutor::create([
                'name'  => $request->input('name'.$i),
                'profession' => $request->input('profession'.$i),
                'addresse' => $request->input('addresse'.$i),
                'tel_mobile' => $request->input('tel_mobile'.$i),
                'tel_bureau' => $request->input('tel_bureau'.$i),
                'tel_fixe' => $request->input('tel_fixe'.$i),
                'type' => $request->input('type'.$i),
                'apprenant_id' => $apprenant->id,
            ]);
        }
        return $apprenant;
    }

    private function getInputTutor($request, $apprenant){

//        $inputParent = $request->only('name', 'profession', 'addresse', 'tel_mobile', 'tel_bureau', 'tel_fixe', 'type');
//        return $inputParent;
    }

    private function getApprenantInput($request)
    {
        $inscrip = AcademicYear::getCurrentAcademicYear();
        $anneeInscrip = AcademicYearModel::find($inscrip);
        $suffixe = $anneeInscrip->apprenants()->withTrashed()->count() + 1;
        $matricule = $anneeInscrip->fin. 'PIG'. str_pad($suffixe,3,0,STR_PAD_LEFT);
        $inputApprenant = $request->only('nom', 'prenom', 'sexe', 'addresse', 'tel', 'matricule', 'dateNaissance', 'lieuNaissance', 'nationalite', 'civilite', 'email', 'quartier', 'academic_year_id', 'etablissement_provenance', 'academic_mail', 'diplome', 'situation_professionnelle');
        $inputApprenant['matricule'] = $matricule;
        $inputApprenant['academic_year_id'] = $inscrip;
//        $inputApprenant['tutor_id'] = $tutor;

        return $inputApprenant;
    }

    public function saveChanges($request, $apprenant){
        $tutor = $apprenant->tutor;
        $tutor->update($this->getInputTutor($request));
        $inputApprenant = $request->except('name', 'profession', 'addresse', 'tel_mobile', 'tel_bureau', 'tel_fixe', 'type');
        $apprenant->update($inputApprenant);
    }
}
