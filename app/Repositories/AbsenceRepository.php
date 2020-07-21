<?php

namespace App\Repositories;

use App\Models\Absence;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class AbsenceRepository
 * @package App\Repositories
 * @version December 1, 2017, 11:22 pm UTC
 *
 * @method Absence findWithoutFail($id, $columns = ['*'])
 * @method Absence find($id, $columns = ['*'])
 * @method Absence first($columns = ['*'])
*/
class AbsenceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date',
        'justify',
        'justification',
        'ecue_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Absence::class;
    }
}
