<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 28/07/2015
 * Time: 06:04
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;


class ClientService extends Service
{
    public function __construct(ClientRepository $repository, ClientValidator $validator)
    {
        parent::__construct($repository, $validator);
    }
}