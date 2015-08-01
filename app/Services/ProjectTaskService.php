<?php
/**
 * Created by PhpStorm.
 * User: jayson.inf
 * Date: 28/07/2015
 * Time: 06:04
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Validators\ProjectTaskValidator;

class ProjectTaskService extends Service
{

    /**
     * @param ProjectTaskRepository $repository
     * @param ProjectTaskValidator $validator
     */
    public function __construct(ProjectTaskRepository $repository, ProjectTaskValidator $validator)
    {
        parent::__construct($repository, $validator);
    }




}