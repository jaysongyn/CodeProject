<?php

namespace CodeProject\Transformers;

use CodeProject\Entities\Project;
use League\Fractal\TransformerAbstract;
use CodeProject\Entities\Client;

/**
 * Class ClientTransformer
 * @package namespace CodeProject\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{

    public function transform(Client $model) {
        return [

            'id'            => $model->id,
            'name'          => $model->name,
            'responsable'   => $model->responsable,
            'email'         => $model->email,
            'phone'         => $model->phone,
            'address'       => $model->address,
            'obs'           => $model->obs,

        ];
    }

}