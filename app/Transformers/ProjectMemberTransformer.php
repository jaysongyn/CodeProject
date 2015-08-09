<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;


/**
 * Class ProjectMemberTransformer
 * @package namespace CodeProject\Transformers;
 */
class ProjectMemberTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProjectMember entity
     * @param \ProjectMember $model
     *
     * @return array
     */
    public function transform( $model) {
        return [
            'id'   => (int)$model->id,
            'name' => $model->name,

        ];
    }
}