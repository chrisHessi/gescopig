<?php

namespace App\Repositories;

use App\Models\Cycle;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class CycleRepository
 * @package App\Repositories
 * @version November 30, 2017, 3:24 pm UTC
 *
 * @method Cycle findWithoutFail($id, $columns = ['*'])
 * @method Cycle find($id, $columns = ['*'])
 * @method Cycle first($columns = ['*'])
*/

class CycleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'label',
        'niveau',
        'slug'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Cycle::class;
    }
}
