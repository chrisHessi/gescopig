<?php

namespace App\Repositories;

use App\Models\Ecue;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EcueRepository
 * @package App\Repositories
 * @version November 28, 2017, 10:58 am UTC
 *
 * @method Ecue findWithoutFail($id, $columns = ['*'])
 * @method Ecue find($id, $columns = ['*'])
 * @method Ecue first($columns = ['*'])
*/
class EcueRepository extends BaseRepository

{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'semestre_id',
        'slug'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Ecue::class;
    }
}
