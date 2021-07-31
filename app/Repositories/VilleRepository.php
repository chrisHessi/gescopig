<?php
/**
 * Created by PhpStorm.
 * User: ChristianKevineHESSI
 * Date: 28/07/2021
 * Time: 11:09
 */

namespace App\Repositories;


use App\Models\Ville;
use InfyOm\Generator\Common\BaseRepository;

class VilleRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.

        return Ville::class;
    }
}