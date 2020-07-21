<?php

namespace App\Repositories;

use App\Models\Specialite;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SpecialiteRepository
 * @package App\Repositories
 * @version December 4, 2017, 12:42 pm UTC
 *
 * @method Specialite findWithoutFail($id, $columns = ['*'])
 * @method Specialite find($id, $columns = ['*'])
 * @method Specialite first($columns = ['*'])
*/
class SpecialiteRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'slug',
        'temp'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Specialite::class;
    }
}
