<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;
use CodeProject\Entities\ProjectNote;


/**
 * Class ProjectNoteTransformer
 * @package namespace CodeProject\Transformers;
 */
class ProjectNoteTransformer extends TransformerAbstract
{

    /**
     * @param ProjectNote $model
     * @return array
     */
    public function transform(ProjectNote $model)
    {
        return [
            'id' => (int)$model->id,
            'project_id' => $model->project_id,
            'title' => $model->title,
            'note' => $model->note,
        ];
    }



}