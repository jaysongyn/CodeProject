<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 28/07/2015
 * Time: 06:04
 */

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;



class ProjectService extends Service
{
    public function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        parent::__construct($repository, $validator);
    }




}