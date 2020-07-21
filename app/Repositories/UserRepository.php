<?php

namespace App\Repositories;

use App\User;
use InfyOm\Generator\Common\BaseRepository;
use PhpParser\Node\Stmt\Class_;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace App\Repositories;
 */
Class UserRepository extends BaseRepository
{
    public function model()
    {
        // TODO: Implement model() method.
        return User::class;
    }
}
