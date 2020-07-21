<?php
/**
 * Created by PhpStorm.
 * User: Christian HESSI
 * Date: 04/04/2019
 * Time: 20:34
 */

namespace App\Repositories;

use App\Models\Note;
use InfyOm\Generator\Common\BaseRepository;

class NoteRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return Note::class;
    }
}