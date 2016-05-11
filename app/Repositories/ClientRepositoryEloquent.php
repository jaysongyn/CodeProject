<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 27/07/2015
 * Time: 18:02
 */

namespace CodeProject\Repositories;


use CodeProject\Entities\Client;
use CodeProject\Presenters\ClientPresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    protected $fieldSearchable = [
        'name'
    ];
    public function model()
    {
        return Client::class;
    }

    public function presenter(){

        return ClientPresenter::class;
    }

    public function boot(){
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }
}