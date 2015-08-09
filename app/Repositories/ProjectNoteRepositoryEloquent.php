<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\ProjectNote;

use CodeProject\Presenters\ProjectNotePresenter;
use Prettus\Repository\Eloquent\BaseRepository;



/**
 * Class ProjectNoteRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProjectNote::class;
    }

    public function presenter(){

        return ProjectNotePresenter::class;
    }
}