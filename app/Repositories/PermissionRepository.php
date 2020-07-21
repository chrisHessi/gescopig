<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 12/12/2018
 * Time: 18:13
 */

namespace App\Repositories;


use App\Models\Permission;
use InfyOm\Generator\Common\BaseRepository;

class PermissionRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.

        return Permission::class;
    }
}