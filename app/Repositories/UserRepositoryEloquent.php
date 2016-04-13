<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 27/07/2015
 * Time: 18:02
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\User;

use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model()
    {
        return User::class;
    }


}