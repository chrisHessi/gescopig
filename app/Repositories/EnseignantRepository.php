<?php

namespace App\Repositories;

use App\Models\Enseignant;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EnseignantRepository
 * @package App\Repositories
 * @version March 7, 2018, 7:24 pm UTC
 *
 * @method Enseignant findWithoutFail($id, $columns = ['*'])
 * @method Enseignant find($id, $columns = ['*'])
 * @method Enseignant first($columns = ['*'])
*/
class EnseignantRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'tel',
        'mail'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Enseignant::class;
    }
}
