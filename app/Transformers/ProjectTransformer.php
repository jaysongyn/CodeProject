<?php

namespace CodeProject\Transformers;

use League\Fractal\TransformerAbstract;
use CodeProject\Entities\Project;

/**
 * Class ProjectTransformer
 * @package namespace CodeProject\Transformers;
 */
class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'members',
        'client',
        'notes',
        'files',
        'tasks'
    ];

    /**
     * Transform the \Project entity
     * @param \Project $model
     *
     * @return array
     */
    public function transform(Project $model) {
        return [
            'id' => $model->id,
            'owner_id' => $model->owner_id,
            'client_id' => $model->client_id,
            'name' => $model->name,
            'members' => $model->members,
            'description' => $model->description,
            'progress' => $model->progress,
            'status' => $model->status,
            'due_date' => $model->due_date,

        ];
    }

    public function includeMembers(Project $project){

        return $this->collection($project->members, new ProjectMemberTransformer());
    }

    public function includeClient(Project $project){

        return $this->item($project->client, new ClientTransformer());
    }

    public function includeNotes(Project $projct)
    {
        return $this->collection($projct->notes, new ProjectNoteTransformer());
    }

    public function includeFiles(Project $projct)
    {
        return $this->collection($projct->files, new ProjectFileTransformer());
    }

    public function includeTasks(Project $projct)
    {
        return $this->collection($projct->tasks, new ProjectTaskTransformer());
    }
}