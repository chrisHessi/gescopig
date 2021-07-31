<?php
/**
 * Created by PhpStorm.
 * User: ChristianKevineHESSI
 * Date: 28/07/2021
 * Time: 11:09
 */

namespace App\Repositories;


use App\Models\Pays;
use InfyOm\Generator\Common\BaseRepository;

class PaysRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.

        return Pays::class;
    }
}