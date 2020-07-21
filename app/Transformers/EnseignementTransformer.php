<?php
namespace App\Transformers;

use App\Models\Enseignement;
use League\Fractal\TransformerAbstract;


class EnseignementTransformer extends TransformerAbstract{
    protected $availableIncludes = [
        'enseignements',
        'specialites',
        'ecues'
    ];

    public function transform(Enseignement $enseignement){
        return[
            'enseignement_id' => $enseignement->enseignant->name,
            'ecue_id' => $enseignement->ecue->title,
            'specialite_id' => $enseignement->specialite->slug. ' ' .$enseignement->ecue->semestre->cycle->niveau,
            'dateDebutPrevue' => $enseignement->dateDebutPrevue->format('d/m/y'),
            'dateDebutEff' => $enseignement->dateDebutEff->format('d/m/y'),
            'dateFinPrevue' => $enseignement->dateFinPrevue->format('d/m/y'),
            'dateFinEff' => $enseignement->dateFinEff->format('d/m/y'),
            'mhTotal' => (int)$enseignement->mhTotal,
            'mhEff' => (int)$enseignement->mhEff,
            'mhSemaine' => (int) $enseignement->mhSemaine,
        ];
    }
}