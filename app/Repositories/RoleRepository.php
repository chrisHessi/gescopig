<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 12/12/2018
 * Time: 18:19
 */

namespace App\Repositories;


use App\Models\Role;
use InfyOm\Generator\Common\BaseRepository;

class RoleRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Role::class;
    }
}