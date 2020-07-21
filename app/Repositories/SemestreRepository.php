<?php

namespace App\Repositories;

use App\Models\Semestre;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SemestreRepository
 * @package App\Repositories
 * @version November 28, 2017, 9:48 am UTC
 *
 * @method Semestre findWithoutFail($id, $columns = ['*'])
 * @method Semestre find($id, $columns = ['*'])
 * @method Semestre first($columns = ['*'])
*/
class SemestreRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'cycle_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Semestre::class;
    }
}
