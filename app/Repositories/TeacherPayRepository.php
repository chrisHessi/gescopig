<?php

namespace App\Repositories;

use App\Models\TeacherPay;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TeacherPayRepository
 * @package App\Repositories
 * @version December 1, 2017, 11:22 pm UTC
 *
 * @method TeacherPay findWithoutFail($id, $columns = ['*'])
 * @method TeacherPay find($id, $columns = ['*'])
 * @method TeacherPay first($columns = ['*'])
*/
class TeacherPayRepository extends BaseRepository{

	public function model(){
		return TeacherPay::class;
	}

}