<?php

namespace CodeProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ProjectTaskPresenter;
use CodeProject\Entities\ProjectTask;

/**
 * Class ProjectTaskRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectTaskRepositoryEloquent extends BaseRepository implements ProjectTaskRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectTask::class;
    }

    public function  presenter(){

        return ProjectTaskPresenter::class;
    }
}