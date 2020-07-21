<?php

namespace App\Repositories;

use App\Models\Enseignement;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EnseignementRepository
 * @package App\Repositories
 * @version March 8, 2018, 5:15 pm UTC
 *
 * @method Enseignement findWithoutFail($id, $columns = ['*'])
 * @method Enseignement find($id, $columns = ['*'])
 * @method Enseignement first($columns = ['*'])
*/
class EnseignementRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'enseignant_id',
        'ecue_id',
        'specialite_id',
        'dateDebutPrevue',
        'dateDebutEff',
        'dateFinPrevue',
        'dateFinEff',
        'mhTotal',
        'mhEff',
        'mhSemaine'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Enseignement::class;
    }
}
